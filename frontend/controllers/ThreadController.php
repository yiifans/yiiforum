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
use base\YiiForum;
use common\helpers\TTimeHelper;

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
    	$boardId=YiiForum::getGetValue('boardid');
    	
    	$query=Thread::find()->where(['board_id'=>$boardId,'status'=>1]);
    	
		$locals=YiiForum::getPagedRows($query,['order'=>'last_modify_time desc']);
		
		$locals['currentBoard'] = $this->getBoard($boardId);
		$locals['boards'] = $this->buildSubBoards($boardId);
		
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
    	
    	$locals=YiiForum::getPagedRows($query,['order'=>'create_time asc','pageSize'=>10]);
    	
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
    public function actionNewThread()
    {
    	YiiForum::checkIsGuest();
    	
    	$boardId=YiiForum::getGetValue('boardid');
    	
        $model = new Thread;

        if ($model->load(Yii::$app->request->post())) {
        	$model->board_id=$boardId;
        	$model->user_id=$model->last_user_id=YiiForum::getIdentity()->id;
        	$model->user_name=$model->last_user_name=YiiForum::getIdentity()->username;
        	$model->create_time=$model->modify_time=$model->last_modify_time=TTimeHelper::getCurrentTime();
        	
        	if($model->save())
        	{
        		$this->savePostForThread($model);
        	}
        	
        	Board::updateLastData($boardId, $model['id'], $model['title']);
        	
            return $this->redirect(['view', 'id' => $model->id, 'boardid'=>$boardId]);
        } else {
        	$locals=[];
        	$locals['model']=$model;
        	$locals['currentBoard']=$this->getBoard($boardId);
            return $this->render('new-thread', $locals);
        }
    }
    
    
    
	private function savePostForThread($thread,$post=null)
	{
		$data=YiiForum::getPostValue('Thread');
		
		if($post==null)
		{
			$post = new Post;
			$post->thread_id=$thread['id'];
			$post->user_id=$thread['user_id'];
			$post->user_name=$thread['user_name'];
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
		
		$post->save();
		
	}
	


    /**
     * Updates an existing Thread model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionEditThread($id)
    {
    	YiiForum::checkIsGuest();
    	
        $model = $this->findModel($id);
        $boardId=$model['board_id'];
        
        $post=Post::findOne(['thread_id'=>$model['id']],'create_time asc');
		
        if ($model->load(Yii::$app->request->post())) {
        	//$model->board_id=$boardId;
        	//$model->user_id=0;
        	//$model->user_name='admin';
        	//$model->create_time=$this->getCurrentTime();
        	$model->modify_time=TTimeHelper::getCurrentTime();
        	if($model->save())
        	{
        		YiiForum::info($post);
        		$this->savePostForThread($model,$post);
        	}
        	YiiForum::info($model,__METHOD__);
        	 
        	return $this->redirect(['view', 'id' => $model->id, 'boardid'=>$boardId]);
        } else {
        	if($post)
        	{
        		$model->body=$post['body'];
        	}
        	
        	$locals=[];
        	$locals['currentBoard']=$this->getBoard($boardId);
        	$locals['model']=$model;
            return $this->render('edit-thread', $locals);
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
    	YiiForum::checkIsGuest();
    	
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
    
    public function actionNewPost()
    {
    	YiiForum::checkIsGuest();
    
    	$post = new Post;
    	
    	$threadId=YiiForum::getGetValue('threadid');
    	
    	$data=YiiForum::getPostValue('Post');
    
    	if($data==null)
    	{
    		$thread = Thread::findOne(['id' => $threadId]);
    		
    		$locals=[];
    		$locals['thread']=$thread;
    		$locals['currentBoard']=$this->getBoard($thread['board_id']);
    		$locals['model']=$post;
    		return $this->render('new-post',$locals);
    	}
    	
    	$boardId=$data['board_id'];
    	$threadId=$data['thread_id'];
    	$threadTitle=$data['thread_title'];
    
    	
    	$post->thread_id=$threadId;
    	$post->user_id=YiiForum::getIdentity()->id;
    	$post->user_name=YiiForum::getIdentity()->username;
    	$post->title=isset($data['title'])?$data['title']:'';
    	$post->body=$data['body'];
    	$post->create_time=TTimeHelper::getCurrentTime();
    	$post->modify_time=TTimeHelper::getCurrentTime();
    	$post->supports=0;
    	$post->againsts=0;
    	$post->floor=0;
    	$post->note='';
    	if($post->save())
    	{
    		Thread::updateLastData($threadId);
    		Board::updateLastData($boardId, $threadId, $threadTitle,false);
    	}
    
    	return $this->redirect(['view', 'id' => $threadId]);
    }
    
    
    public function actionEditPost($id)
    {
    	YiiForum::checkIsGuest();
    
    	$boardId=YiiForum::getGetValue('boardid');
    	
    	$model = Post::findOne(['id'=>$id]);
    	
    	$data=YiiForum::getPostValue('Post');
    
    	if($data == null)
    	{
    		$thread = Thread::findOne(['id' => $model['thread_id']]);
    		
    		$locals=[];
    		$locals['thread']=$thread;
    		$locals['currentBoard']=$this->getBoard($boardId);
    		$locals['model']=$model;
    		return $this->render('edit-post',$locals);
    	}
    	else 
    	{
    		$model->load(Yii::$app->request->post());
    		$model->modify_time=TTimeHelper::getCurrentTime();
    		$model->save();
    		return $this->redirect(['view', 'id' => $model->thread_id]);
    	
    	}
    }
    
}
