<?php

namespace backend\controllers;

use Yii;
use common\models\AuthItem;
use common\models\search\AuthItemSearch;
use base\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rbac\Item;
use base\YiiForum;
use yii\rbac\Role;
use yii\rbac\Permission;

/**
 * AuthItemController implements the CRUD actions for AuthItem model.
 */
class AuthController extends BaseController
{
	protected $auth = null;
	
	public function init()
	{
		parent::init();
		$this->auth=\Yii::$app->authManager;
	}
	
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    
    
    public function model2Item($model,$item)
    {
    	$item->name=$model->name;
    	//$item->type=
    	$item->description=$model->description;
    	$item->ruleName=$model->ruleName==''?null:$model->ruleName;
    	$item->data=$model->data;
    	$item->createdAt=$model->created_at;
    	$item->updatedAt=$model->updated_at;
    	return $item;
    }
    
    public function item2Model($item)
    {
    	$model = new AuthItem();
    	$model->name=$item->name;
    	$model->type=$item->type;
    	$model->description=$item->description;
    	$model->rule_name=$item->rule_name;
    	$model->data=$item->data;
    	$model->created_at=$item->createAt;
    	$model->updated_at=$item->updateAt;
    	return $model;
    	 
    }
}
