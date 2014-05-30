<?php
namespace base;
use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\data\Pagination;
use common\models\Board;
use yii\rbac\DbManager;
use yii\db\Query;
use yii\db\Expression;

/**
 * Site controller
 */
class AuthManager extends DbManager
{
	public function updateItemParent($parentName,$childName,$newParentName) 
	{
		$this->db->createCommand()
		->update($this->itemChildTable, ['parent' => $newParentName], ['parent' => $parentName,'child' => $childName])
		->execute();
	}

	public function getParent($name)
	{
		$query = (new Query)
		->select(['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at'])
		->from([$this->itemTable, $this->itemChildTable])
		->where(['child' => $name, 'name' => new Expression('parent')]);
		
		$row = $query->one($this->db);
		
		return $this->populateItem($row);
	
	}
	
}
