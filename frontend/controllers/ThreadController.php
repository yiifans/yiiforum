<?php

namespace frontend\controllers;

use Yii;
use common\models\Thread;
use common\models\search\ThreadSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\base\BaseFrontController;
use common\models\Board;
use common\models\Post;

/**
 * ThreadController implements the CRUD actions for Thread model.
 */
class ThreadController extends BaseFrontController
{
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

    /**
     * Lists all Thread models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$boardId=$this->getGetValue('boardid');
    	
    	$currentBoard=Board::findOne(['id'=>$boardId]);
    	$threads=Thread::find()->where(['board_id'=>$boardId])->orderBy('create_time desc')->all();
    	
		$params=[];
		$params['currentBoard'] = $currentBoard;
		$params['threads'] = $threads;
		
        return $this->render('index', $params);
    }

    /**
     * Displays a single Thread model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	$model = $this->findModel($id);
    	$posts=Post::findAll(['thread_id'=>$model['id']]);
    	
    	$boardId=$model['board_id'];
    	$currentBoard=Board::findOne(['id'=>$boardId]);
    	
    	
    	$params=[];
    	$params['model']=$model;
    	$params['currentBoard']=$currentBoard;
    	$params['posts']=$posts;
    	
    	
        return $this->render('view', $params);
    }

    /**
     * Creates a new Thread model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	$boardId=$this->getGetValue('boardid');
    	$currentBoard=Board::findOne(['id'=>$boardId]);
    	
        $model = new Thread;

        if ($model->load(Yii::$app->request->post())) {
        	$model->board_id=$boardId;
        	$model->user_id=0;
        	$model->user_name='admin';
        	$model->create_time=$this->getCurrentTime();
        	if($model->save())
        	{
        		
        		$this->savePostForThread($model->id);
        	}
        	$this->info($model,__METHOD__);
        	
            return $this->redirect(['view', 'id' => $model->id, 'boardid'=>$boardId]);
        } else {
            return $this->render('create', [
                'model' => $model,
            	'body' => '',
            	'currentBoard' => $currentBoard,
            ]);
        }
    }
    
    public function actionNewPost()
    {
    	$data=$this->getPostValue('Post');
    	
    	$post = new Post;
    	$post->thread_id=$data['thread_id'];
    	$post->user_id=0;
    	$post->user_name='admin';
    	$post->title=$data['title'];
    	$post->body=$data['body'];
    	$post->create_time=$this->getCurrentTime();
    	$post->modify_time=$this->getCurrentTime();
    	$post->supports=0;
    	$post->againsts=0;
    	$post->floor=0;
    	$post->note='';
    	if($post->save())
    	{
    		
    	}

    	return $this->redirect(['view', 'id' => $post->thread_id]);
    }
    
	private function savePostForThread($threadId)
	{
		$data=$this->getPostValue('Thread');
		
		
		$post = new Post;
		$post->thread_id=$threadId;
		$post->user_id=0;
		$post->user_name='admin';
		$post->title=$data['title'];
		$post->body=$data['body'];
		$post->create_time=$this->getCurrentTime();
		$post->modify_time=$this->getCurrentTime();
		$post->supports=0;
		$post->againsts=0;
		$post->floor=0;
		$post->note='';
		$post->save();
		$this->info($post,__METHOD__);
	}
	

    /**
     * Updates an existing Thread model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Thread model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Thread model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Thread the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Thread::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
