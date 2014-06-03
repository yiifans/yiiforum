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
class PermissionController extends AuthController
{
    /**
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$categoryName = YiiForum::getGetValue('category');
    	 
    	$categories = $this->auth->getChildren('root_permission');
    	 
    	if($categoryName !== null)
    	{
    		$items = $this->auth->getChildren($categoryName);
    	}
    	else 
    	{
    		$items = $this->auth->getPermissions();
    		foreach ($categories as $category)
    		{
    			unset($items[$category->name]);
    		}
    		unset($items['root_permission']);
    		
    	}
    	
    	$locals = [];
    	$locals['currentCategory'] = $categoryName;
    	$locals['categories'] = $categories;
    	$locals['items']=$items;
    	
        return $this->render('index', $locals);
    }


    /**
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	$categoryName = YiiForum::getGetValue('category');
    	
    	$model = new AuthItem();
    	$model->category=YiiForum::getGetValue('category');
    	
    	if ($model->load(Yii::$app->request->post())) {
    		$item = $this->model2Item($model,new Permission());
    		$this->auth->add($item);
    		
    		$categoryName = YiiForum::getPostValue('AuthItem')['category'];
    		$category = new Permission();
    		$category->name=$categoryName;
    		
    		$this->auth->addChild($category, $item);
    		
    		return $this->redirect(['index','category'=>$categoryName]);
    	} else {
    		$locals = [];
    		$locals['categories'] = $this->auth->getChildren('root_permission');
    		$locals['model'] =$model;
    		return $this->render('create',$locals);
    	}
    }
    public function actionRefresh()
    {
    	$categoryName = YiiForum::getGetValue('category');
    	AuthItem::createCachedPermissions();
    	return $this->redirect(['index','category'=>$categoryName]);
    }
    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	$categoryName = YiiForum::getGetValue('category');
    	
    	$model = $this->findModel($id);
    
    	if ($model->load(Yii::$app->request->post())) {
    		$item = $this->model2Item($model,new Permission());
    		$this->auth->update($id, $item);
    		
    		return $this->redirect(['index', 'category'=>$categoryName]);
    	} else {
    		
    		$model->category = $this->auth->getParent($model->name)->name;
    		
    		$locals = [];
    		$locals['categories'] = $this->auth->getChildren('root_permission');
    		$locals['model'] =$model;
    	
    		return $this->render('update', $locals);
    	}
    }
    
    /**
     * Displays a single AuthItem model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
    	return $this->render('view', [
    			'model' => $this->findModel($id),
    			]);
    }
    
   

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	$categoryName = YiiForum::getGetValue('category');
    	
    	$item = new Permission();
    	$item->name=$id;
    	$this->auth->remove($item);
        

        return $this->redirect(['index', 'category'=>$categoryName]);
    }

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
    	if (($model = AuthItem::findOne($id)) !== null) {
    		return $model;
    	} else {
    		throw new NotFoundHttpException('The requested page does not exist.');
    	}
    }
}
