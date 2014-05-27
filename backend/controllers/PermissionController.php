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
    	$items = $this->auth->getPermissions();
    	
        $locals = [];
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
    	$model = new AuthItem();
    	
    	if ($model->load(Yii::$app->request->post())) {
    		$item = $this->model2Item($model,new Permission());
    		$this->auth->add($item);
    		
    		return $this->redirect(['index']);
    	} else {
    		$locals = [];
    		$locals['model'] =$model;
    		return $this->render('create',$locals);
    	}
    }
    
    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	$model = $this->findModel($id);
    
    	if ($model->load(Yii::$app->request->post())) {
    		$item = $this->model2Item($model,new Permission());
    		$this->auth->update($id, $item);
    		
    		return $this->redirect(['index']);
    	} else {
    		$locals = [];
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
    	$item = new Permission();
    	$item->name=$id;
    	$this->auth->remove($item);
        

        return $this->redirect(['index']);
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
