<?php

namespace common\models;

use Yii;
use yii\filters\auth\AuthInterface;
use common\helpers\TFileHelper;

/**
 * This is the model class for table "auth_item".
 *
 * @property string $name
 * @property integer $type
 * @property string $description
 * @property string $rule_name
 * @property string $data
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property AuthAssignment $authAssignment
 * @property AuthRule $ruleName
 * @property AuthItemChild $authItemChild
 */
class AuthItem extends \base\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type', 'description'], 'required'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['description', 'data'], 'string'],
            [['name', 'rule_name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => '名称',
            'type' => '类型',
            'description' => '描述',
            'rule_name' => '应用规则',
            'data' => '参数',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'group' => '角色组',
            'category' => '权限分类',
        ];
    }
    private $_group;
    public function getGroup()
    {
    	return $this->_group;
    }
    public function setGroup($value)
    {
    	$this->_group=$value;
    }
    private $_category;
    public function getCategory()
    {
    	return $this->_category;
    }
    public function setCategory($value)
    {
    	$this->_category=$value;
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignment()
    {
        return $this->hasOne(AuthAssignment::className(), ['item_name' => 'name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRuleName()
    {
        return $this->hasOne(AuthRule::className(), ['name' => 'rule_name']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItemChild()
    {
        return $this->hasOne(AuthItemChild::className(), ['child' => 'name']);
    }
    
    public function beforeSave($insert)
    {
    	if(parent::beforeSave($insert))
    	{
    		if(empty($this->rule_name))
    		{
    			$this->rule_name=null;
    		}
    		return true;
    	}
    	return false;
    }
    

    
    public static function createItem($row)
    {
    	$content='';
    	$content .= AuthItem::getCacheItem('name', $row);
    	$content .= AuthItem::getCacheItem('type', $row,true);
    	$content .= AuthItem::getCacheItem('description', $row);
    	$content .= AuthItem::getCacheItemValue('rule_name', $row->ruleName);
    	$content .= AuthItem::getCacheItem('data', $row);
    	$content .= AuthItem::getCacheItemValue('created_at', $row->createdAt);
    	$content .= AuthItem::getCacheItemValue('updated_at', $row->updatedAt);
    	return $content;
    }
    public static function createCachedRoles()
    {
    	$auth = \Yii::$app->authManager;
    	$newLine = "\r\n";
    
    	$content = '<?php' . $newLine;
    
    	$rolesContent='';
    	
    	$groups = $auth->getChildren('root_role');
    
    	foreach ($groups as $group)
    	{
    		$content .= '$cachedRoleGroups[\'' . $group->name . '\'] = [' . $newLine;
    		
    		$content .= AuthItem::createItem($group);
    		$content .= "	'roles' => [". $newLine;
    		
    		$roles = $auth->getChildren($group->name);
    		foreach ($roles as $role)
    		{
    			$content .="		'".$role->name."',". $newLine;
    			
    			
    			$rolesContent .= '$cachedRoles[\'' . $role->name . '\'] = [' . $newLine;
    			
    			$rolesContent .= AuthItem::getCacheItemValue('group', $group->name);
    			$rolesContent .= AuthItem::createItem($role);
    			$rolesContent .= "	'permissions' => [". $newLine;
    			
    			$permissions = $auth->getPermissionsByRole($role->name);
    			foreach ($permissions as $permission)
    			{
    				$rolesContent .="		'".$permission->name."',". $newLine;
    			}
    			$rolesContent .= '	],' . $newLine;
    			
    			$rolesContent .= "];" . $newLine;
    		}
    		$content .= '	],' . $newLine;
    		
    		
    		$content .= "];" . $newLine;
    	}
    
    	$content .= $rolesContent;
    	$dataRoot = \Yii::getAlias('@data');
    	
    	TFileHelper::writeFile([$dataRoot, 'cache', 'cachedRoles.php' ], $content);
    }
    
    public static function createCachedPermissions()
    {
    	$auth = \Yii::$app->authManager;
    	$newLine = "\r\n";
    
    	$content = '<?php' . $newLine;
    
    	$permissionContent='';
    	 
    	$categories = $auth->getChildren('root_permission');
    
    	foreach ($categories as $category)
    	{
    		$content .= '$cachedPermissionCategories[\'' . $category->name . '\'] = [' . $newLine;
    
    		$content .= AuthItem::createItem($category);
    		$content .= "	'permissions' => [". $newLine;
    
    		$permissions = $auth->getChildren($category->name);
    		foreach ($permissions as $permission)
    		{
    			$content .="		'".$permission->name."',". $newLine;
    			 
    			 
    			$permissionContent .= '$cachedPermissions[\'' . $permission->name . '\'] = [' . $newLine;
    			 
    			$permissionContent .= AuthItem::getCacheItemValue('category', $category->name);
    			$permissionContent .= AuthItem::createItem($permission);
    			$permissionContent .= "];" . $newLine;
    		}
    		$content .= '	],' . $newLine;
    
    		$content .= "];" . $newLine;
    	}
    
    	$content .= $permissionContent;
    	$dataRoot = \Yii::getAlias('@data');
    	 
    	TFileHelper::writeFile([$dataRoot, 'cache', 'cachedPermissions.php' ], $content);
    }
    
    public static function getCacheItem($name, $row, $isInt = false)
    {
    	return self::getCacheItemValue($name, $row->$name, $isInt);
    }
    
    public static function getCacheItemValue($name, $value, $isInt = false)
    {
    	$newLine = "\r\n";
    
    	if ($isInt)
    	{
    		$value = intval($value);
    	}
    	else
    	{
    		$value = '\'' . $value . '\'';
    	}
    
    	return '	\'' . $name . '\' => ' . $value . ',' . $newLine;
    }
}
