<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\search\UserSearch;
use backend\base\BaseBackController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use base\YiiForum;
use yii\rbac\Role;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends BaseBackController
{

	public function behaviors()
	{
		return [
				'verbs' => [
						'class' => VerbFilter::className(),
						'actions' => [
								'delete' => [
										'post' 
								] 
						] 
				] 
		];
	}

	/**
	 * Lists all User models.
	 *
	 * @return mixed
	 */
	public function actionIndex()
	{
		$query = User::find();
		$locals = YiiForum::getPagedRows($query);
		
		return $this->render('index', $locals);
	}

	/**
	 * Displays a single User model.
	 *
	 * @param integer $id        	
	 * @return mixed
	 */
	public function actionView($id)
	{
		return $this->render('view', [
				'model' => $this->findModel($id) 
		]);
	}

	/**
	 * Creates a new User model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new User();
		
		if ($model->load(Yii::$app->request->post()) && $model->save())
		{
			return $this->redirect([
					'index' 
			]);
		}
		else
		{
			return $this->render('create', [
					'model' => $model 
			]);
		}
	}

	/**
	 * Updates an existing User model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id        	
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		
		if ($model->load(Yii::$app->request->post()) && $model->save())
		{
			return $this->redirect([
					'index' 
			]);
		}
		else
		{
			return $this->render('update', [
					'model' => $model 
			]);
		}
	}

	/**
	 * Deletes an existing User model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id        	
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();
		
		return $this->redirect([
				'index' 
		]);
	}

	/**
	 * Finds the User model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id        	
	 * @return User the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = User::findOne($id)) !== null)
		{
			return $model;
		}
		else
		{
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	public function updateAssignments($allItems, $selectedItems, $existedItems, $id)
	{
		$auth = \Yii::$app->authManager;
		
		if ($selectedItems == null)
		{
			$selectedItems = [];
		}
		
		$role = new Role();
		foreach ( $allItems as $item )
		{
			$itemName = $item['name'];
			
			$role->name = $itemName;
			
			// the selected role
			if (in_array($itemName, $selectedItems))
			{
				// check if exists in db
				if (isset($existedItems[$itemName]))
				{
					YiiForum::info('exist:' . $itemName);
					continue;
				}
				else
				{
					// add new role
					YiiForum::info('add:' . $itemName);
					$auth->assign($role, $id);
				}
			}
			else // unselected role
			{
				// check if exists in db
				if (isset($existedItems[$itemName]))
				{
					// need to be deleted
					YiiForum::info('delete:' . $itemName);
					$auth->revoke($role, $id);
				}
			}
		}
	}

	public function actionRole($id)
	{
		$auth = \Yii::$app->authManager;
		$existItems = $auth->getAssignments($id);
		
		$model = [];
		
		if (YiiForum::hasPostValue('submit'))
		{
			$allRoles = $this->getCachedRoles();
			$selectedRoles = YiiForum::getPostValue('selectedRoles');
			$this->updateAssignments($allRoles, $selectedRoles, $existItems, $id);
			
			return $this->redirect([
					'index' 
			]);
		}
		else
		{
			$allRoles = [];
			$groups = $this->getCachedRoleGroups();
			foreach ( $groups as $group )
			{
				$allRoles[$group['description']] = $this->getCachedRolesByGroup($group['name']);
			}
			
			$locals = [];
			$locals['model'] = $model;
			$locals['allRoles'] = $allRoles;
			$locals['existRoles'] = $existItems;
			
			return $this->render('role', $locals);
		}
	}
}
