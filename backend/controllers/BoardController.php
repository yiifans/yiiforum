<?php

namespace backend\controllers;

use Yii;
use common\models\Board;
use common\models\search\BoardSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\base\BaseFrontController;
use backend\base\BaseBackController;

/**
 * BoardController implements the CRUD actions for Board model.
 */
class BoardController extends BaseBackController
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
	 * Lists all Board models.
	 * 
	 * @return mixed
	 */
	public function actionIndex()
	{
		$locals = [];
		$locals['boardArrayTree'] = Board::getBoardArrayTree();
		
		return $this->render('index', $locals);
	}

	/**
	 * Displays a single Board model.
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
	 * Creates a new Board model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * 
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Board();
		$model->loadDefaultValues();
		if ($model->load(Yii::$app->request->post()) && $model->save())
		{
			Board::createCache();
			return $this->redirect([
					'index' 
			]);
		}
		else
		{
			$locals = [];
			$locals['boardArrayTree'] = Board::getBoardArrayTree();
			$locals['model'] = $model;
			return $this->render('create', $locals);
		}
	}

	/**
	 * Updates an existing Board model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * 
	 * @param integer $id        	
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		
		if ($model->load(Yii::$app->request->post()))
		{
			
			$parentIds = Board::getParentIds($model['parent_id']);
			
			if (in_array($model['id'], $parentIds))
			{
				return $this->redirect([
						'update',
						'id' => $id,
						'message' => 1 
				]);
			}
			
			$model->save();
			
			Board::createCache();
			return $this->redirect([
					'index' 
			]);
		}
		else
		{
			$locals = [];
			$locals['boardArrayTree'] = Board::getBoardArrayTree();
			$locals['model'] = $model;
			return $this->render('update', $locals);
		}
	}

	public function actionRefresh()
	{
		Board::createCache();
		return $this->redirect([
				'index' 
		]);
	}

	/**
	 * Deletes an existing Board model.
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
	 * Finds the Board model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * 
	 * @param integer $id        	
	 * @return Board the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Board::findOne($id)) !== null)
		{
			return $model;
		}
		else
		{
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
