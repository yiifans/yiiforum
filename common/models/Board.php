<?php

namespace common\models;

use Yii;
use base\BaseActiveRecord;
use common\helpers\TFileHelper;
use yii\db\Expression;
use common\helpers\TTimeHelper;
use base\YiiForum;

/**
 * This is the model class for table "board".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $icon
 * @property string $description
 * @property string $rule
 * @property integer $columns
 * @property integer $sort_num
 * @property string $redirect_url
 * @property string $target
 * @property integer $threads
 * @property integer $posts
 * @property string $modify_time
 * @property integer $user_id
 * @property string $user_name
 * @property integer $thread_id
 * @property string $thread_title
 */
class Board extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'board';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'name', 'columns', 'sort_num'], 'required'],
            [['parent_id', 'columns', 'sort_num', 'threads', 'posts', 'user_id', 'thread_id'], 'integer'],
            [['modify_time'], 'safe'],
            [['name', 'target', 'user_name'], 'string', 'max' => 32],
            [['icon', 'description', 'redirect_url', 'thread_title'], 'string', 'max' => 128],
            [['rule'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '标号',
            'parent_id' => '父级',
            'name' => '板块名称',
            'icon' => '板块图标',
            'description' => '板块描述',
            'rule' => '板块规则',
            'columns' => '子板块列数',
            'sort_num' => '排序',
            'redirect_url' => '转向URL',
            'target' => '打开方式',
            'threads' => '主题数',
            'posts' => '回帖数',
            'modify_time' => '更新时间',
            'user_id' => '用户ID',
            'user_name' => '用户',
            'thread_id' => '主题ID',
            'thread_title' => '主题',
        ];
    }
    private $_level;
    public function getLevel()
    {
    	return $this->_level;
    }
    public function setLevel($value)
    {
    	$this->_level=$value;
    }

    public static  function updateLastData($boardId,$threadId,$threadTitle,$isThread=True)
    {
    	$attributes=[];
    	$attributes['modify_time']=TTimeHelper::getCurrentTime();
    	if($isThread)
    	{
    		$attributes['threads'] = new Expression("[[threads]]+:bp0", [":bp0" => 1]);
    	}
    	else 
    	{
    		$attributes['posts'] = new Expression("[[posts]]+:bp0", [":bp0" => 1]);
    	}
    	
    	$attributes['user_id']=YiiForum::getIdentity()->id;
    	$attributes['user_name']=YiiForum::getIdentity()->username;
    	$attributes['thread_id']=$threadId;
    	$attributes['thread_title']=$threadTitle;
   
    	YiiForum::info($attributes);
    	
    	Board::updateAll($attributes,['id'=>intval($boardId)]);
    	
    }
    
    
    
    
    
    private static function  _getBoardArrayTree($parentId=0,$level=0)
    {
    	$ret=[];
    
    	$dataList=Board::findAll(['parent_id'=>$parentId],'sort_num desc');
    	
    	if($dataList==null || empty($dataList)){
    		return $ret;
    	}
    	
    	foreach ($dataList as $key=>$value){
    		$value->level=$level;
    		$ret[]=$value;
    
    		$temp=self::_getBoardArrayTree($value['id'],$level+1);
    		$ret=array_merge($ret,$temp);
    	}
    	return $ret;
    }
    
    private static $_boardArrayTree;
    public static function  getBoardArrayTree($parentId=0,$level=0)
    {
    	if(self::$_boardArrayTree==null)
    	{
    		self::$_boardArrayTree=self::_getBoardArrayTree($parentId,$level);
    	}
    	return  self::$_boardArrayTree;
    }
    
    public static function getParentIds($id)
    {
    	$ret=[];
    
    	$current = Board::findOne(['id'=>$id]);
    
    	$parent = Board::findOne(['id'=>$current['parent_id']]);
    	while ($parent != null)
    	{
    		array_unshift($ret,$parent->id);
    		
    		$parent = Board::findOne(['id'=>$parent['parent_id']]);
    	}
    	array_unshift($ret,0);
    	return $ret;
    }
    
    public static function createCache()
    {
    	$newLine="\r\n";
    
    	$content='<?php'.$newLine;
    	
    
    	$channels=Board::find()->all();
    
    	foreach ($channels as $row)
    	{
    		$id=$row['id'];
    			
    		$content.='$cachedBoards['.$row['id'].']=['.$newLine;
    
    		$content.=Board::getCacheItem('id', $row, true);
    		$content.=Board::getCacheItem('parent_id', $row,true);
    		$parentIds=Board::getParentIds($id);
    		$content.=Board::getCacheItemValue('parent_ids',implode(',', $parentIds));
    		$content.=Board::getCacheItem('name',$row);
    		$content.=Board::getCacheItem('icon',$row);
    		$content.=Board::getCacheItem('description',$row);
    		$content.=Board::getCacheItem('rule',$row);
    		$content.=Board::getCacheItem('columns',$row,true);
    		$content.=Board::getCacheItem('sort_num',$row,true);
    		$content.=Board::getCacheItem('redirect_url',$row);
    		$content.=Board::getCacheItem('target',$row);
    		$content.=Board::getCacheItemValue('level',count($parentIds)-1,true);
    		
    
    		$content.="];".$newLine;
    	}
    
    
    	$dataRoot = \Yii::getAlias('@data');
    
    	TFileHelper::writeFile([$dataRoot,'cache','cachedBoards.php'], $content);
    	
    }
    
    public static function getCacheItem($name,$row,$isInt=false)
    {
    	return self::getCacheItemValue($name,$row[$name],$isInt);
    }
    
    public static function getCacheItemValue($name,$value,$isInt=false)
    {
    	$newLine="\r\n";
    
    	if($isInt)
    	{
    		$value = intval($value);
    	}
    	else 
    	{
    		$value='\''.$value.'\'';
    	}
    
    	return '	\''.$name.'\' => '.$value.','.$newLine;
    }
}
