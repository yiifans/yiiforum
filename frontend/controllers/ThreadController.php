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
use yii\data\Pagination;

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
    	
    	$query=Thread::find()->where(['board_id'=>$boardId]);
    	
		$locals=$this->getPagedRows($query,['order'=>'create_time desc']);
		
		$locals['currentBoard'] = $this->getBoard($boardId);
		
        return $this->render('index', $locals);
    }

    /**
     * Displays a single Thread model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	$thread = $this->findModel($id);
    	$thread->updateCounters(['views'=>1]);
    	
    	
    	$query=Post::find()->where(['thread_id'=>$thread['id']]);
    	
    	$locals=$this->getPagedRows($query,['order'=>'create_time asc','pageSize'=>10]);
    	
    	$locals['currentBoard']=$this->getBoard($thread['board_id']);
    	$locals['thread']=$thread;
    	$locals['newPost']=new Post;
    	
        return $this->render('view', $locals);
    }

    /**
     * Creates a new Thread model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	$boardId=$this->getGetValue('boardid');
    	
        $model = new Thread;

        if ($model->load(Yii::$app->request->post())) {
        	//$model->board_id=$boardId;
        	$model->user_id=0;
        	$model->user_name='admin';
        	$model->create_time=$this->getCurrentTime();
        	$model->modify_time=$this->getCurrentTime();
        	if($model->save())
        	{
        		$this->savePostForThread($model);
        	}
        	//$this->info($model,__METHOD__);
        	
            return $this->redirect(['view', 'id' => $model->id, 'boardid'=>$boardId]);
        } else {
        	$locals=[];
        	$locals['model']=$model;
        	$locals['currentBoard']=$this->getBoard($boardId);
            return $this->render('create', $locals);
        }
    }
    
    
    
	private function savePostForThread($thread,$post=null)
	{
		$data=$this->getPostValue('Thread');
		
		if($post==null)
		{
			$post = new Post;
			$post->thread_id=$thread['id'];
			$post->user_id=0;
			$post->user_name='admin';
			$post->title=$thread['title'];
			$post->body=$data['body'];
			$post->create_time=$thread['create_time'];
			$post->modify_time=$thread['modify_time'];
			$post->supports=0;
			$post->againsts=0;
			$post->floor=0;
			$post->note='';
		}
		else 
		{
			//$post->thread_id=$thread['id'];
			//$post->user_id=0;
			//$post->user_name='admin';
			$post->title=$thread['title'];;
			$post->body=$data['body'];
			//$post->create_time=$thread['create_time'];
			$post->modify_time=$thread['modify_time'];
			//$post->supports=0;
			//$post->againsts=0;
			//$post->floor=0;
			//$post->note='';
		}
		$this->info($post);
		$post->save();
		$this->info($post);
	}
	
	public function actionNewPost()
	{
		$data=$this->getPostValue('Post');
		$threadId=$data['thread_id'];
	
		$post = new Post;
		$post->thread_id=$threadId;
		$post->user_id=0;
		$post->user_name='admin';
		$post->title=isset($data['title'])?$data['title']:'';
		$post->body=$data['body'];
		$post->create_time=$this->getCurrentTime();
		$post->modify_time=$this->getCurrentTime();
		$post->supports=0;
		$post->againsts=0;
		$post->floor=0;
		$post->note='';
		if($post->save())
		{
			Thread::updateAllCounters(['posts'=>1],['id'=>$threadId]);
		}
	
		return $this->redirect(['view', 'id' => $post->thread_id]);
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
        $boardId=$model['board_id'];
        
        $post=Post::find()->where(['thread_id'=>$model['id']])->orderBy('create_time asc')->one();
		
        if ($model->load(Yii::$app->request->post())) {
        	//$model->board_id=$boardId;
        	//$model->user_id=0;
        	//$model->user_name='admin';
        	//$model->create_time=$this->getCurrentTime();
        	$model->modify_time=$this->getCurrentTime();
        	if($model->save())
        	{
        		$this->info($post);
        		$this->savePostForThread($model,$post);
        	}
        	$this->info($model,__METHOD__);
        	 
        	return $this->redirect(['view', 'id' => $model->id, 'boardid'=>$boardId]);
        } else {
        	if($post)
        	{
        		$model->body=$post['body'];
        	}
        	
        	$locals=[];
        	$locals['currentBoard']=$this->getBoard($boardId);
        	$locals['model']=$model;
            return $this->render('update', $locals);
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
    	$thread=$this->findModel($id);
    	$thread->delete();
    	
    	Post::deleteAll(['thread_id'=>$thread['id']]);

        return $this->redirect(['index','boardid'=>$thread['board_id']]);
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
