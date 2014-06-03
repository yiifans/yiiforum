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
class RoleController extends AuthController
{
    /**
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$groupName = YiiForum::getGetValue('group');
    	
    	$groups = $this->auth->getChildren('root_role');
    	
    	if($groupName !== null)
    	{
    		$items = $this->auth->getChildren($groupName);
    	}
    	else 
    	{
    		$items = $this->auth->getRoles();
    		foreach ($groups as $group)
    		{
    			unset($items[$group->name]);
    		}
    		unset($items['root_role']);
    	}
    	
        $locals = [];
        $locals['currentGroup']=$groupName;
        $locals['groups'] = $groups;
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
    	$model->group = YiiForum::getGetValue('group','');
    	
    	if ($model->load(Yii::$app->request->post())) {
    		$item = $this->model2Item($model,new Role());
    		$this->auth->add($item);
    		
    		$groupName = YiiForum::getPostValue('AuthItem')['group'];
    		$group = new Role();
    		$group->name=$groupName;
    		
    		$this->auth->addChild($group, $item);
    		
    		return $this->redirect(['index','group'=>$groupName]);
    	} else {
    		$locals = [];
    		$locals['groups'] =  $this->auth->getChildren('root_role');
    		$locals['model'] =$model;
    		return $this->render('create',$locals);
    	}
    }
    public function actionRefresh()
    {
    	$groupName = YiiForum::getGetValue('group');
    	AuthItem::createCachedRoles();
    	return $this->redirect(['index','group'=>$groupName]);
    }
    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
    	$groupName = YiiForum::getGetValue('group');
    	
    	$model = $this->findModel($id);
    
    	if ($model->load(Yii::$app->request->post())) {
    		$item = $this->model2Item($model,new Role());
    		$this->auth->update($id, $item);
    		
    		return $this->redirect(['index','group'=>$groupName]);
    	} else {
    		$model->group = $this->auth->getParent($model->name)->name;
    		
    		$locals = [];
    		$locals['groups'] =  $this->auth->getChildren('root_role');
    		$locals['model'] =$model;
    	
    		return $this->render('update', $locals);
    	}
    }
    
    public function updateChildrenItems($allItems,$selectedItems,$existedItems,$parent,$child)
    {
    	if($selectedItems==null)
    	{
    		$selectedItems=[];
    	}
    	
    	foreach ($allItems as $item)
    	{
    		$itemName=$item->name;
    		
    		$child->name=$itemName;
    		
    		//the selected  permission
    		if(in_array($itemName,$selectedItems))
    		{
    			//check if exists in db
    			if(isset($existedItems[$itemName]))
    			{
    				YiiForum::info('exist:'.$itemName);
    				continue;
    			}
    			else
    			{
    				//add new permission
    				YiiForum::info('add:'.$itemName);
    				$this->auth->addChild($parent, $child);
    			}
    		}
    		else //unselected permission
    		{
    			//check if exists in db
    			if(isset($existedItems[$itemName]))
    			{
    				//need to be deleted
    				YiiForum::info('delete:'.$itemName);
    				$this->auth->removeChild($parent, $child);
    			}
    		}
    	}
    }
    public function actionPermission($id)
    {
    	$groupName = YiiForum::getGetValue('group');
    	
    	$model = $this->findModel($id);
   
    	if (YiiForum::hasPostValue('submit')) {
    		
    		$parent=new Role();
    		$parent->name=$id;
    		
    		$existPermissions = $this->auth->getPermissionsByRole($id);
    		
    		$allPermissions=$this->auth->getPermissions();
    		$selectedPermissions = YiiForum::getPostValue('selectedPermissions');
    		$this->updateChildrenItems($allPermissions,$selectedPermissions,$existPermissions,$parent,new Permission());
    	
    		return $this->redirect(['index', 'group'=>$groupName]);
    	} else {
    		
    		$locals = [];
    		$locals['model'] =$model;
    		
    		$categories = $this->auth->getChildren('root_permission');
    		foreach ($categories as $category)
    		{
    			$permissions = $this->auth->getChildren($category->name);
    			$locals['allPermissions'][$category->description]=$permissions;
    		}
    		
    		$locals['existPermissions']=$this->auth->getPermissionsByRole($id);
    		 
    		return $this->render('permission', $locals);
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
    	$groupName = YiiForum::getGetValue('group');
    	
    	$item = new Role();
    	$item->name=$id;
    	$this->auth->remove($item);
        

        return $this->redirect(['index', 'group'=>$groupName]);
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
