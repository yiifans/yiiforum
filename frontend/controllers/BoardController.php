<?php
namespace frontend\controllers;
use Yii;
use common\models\Board;
use common\models\search\BoardSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\base\BaseFrontController;
use base\YiiForum;

/**
 * BoardController implements the CRUD actions for Board model.
 */
class BoardController extends BaseFrontController
{

    public function behaviors ()
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
    public function actionIndex ()
    {
        $boardId = YiiForum::getGetValue('boardid');
        
        $locals = [];
        $locals['currentBoard'] = $this->getBoard($boardId);
        $locals['boards'] = $this->buildSubBoards($boardId, null);
        
        return $this->render('index', $locals);
    }

    /**
     * Displays a single Board model.
     *
     * @param integer $id            
     * @return mixed
     */
    public function actionView ($id)
    {
        return $this->render('view', 
                [
                        'model' => $this->findModel($id)
                ]);
    }

    /**
     * Creates a new Board model.
     * If creation is successful, the browser will be redirected to the 'view'
     * page.
     *
     * @return mixed
     */
    public function actionCreate ()
    {
        $model = new Board();
        
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect(
                    [
                            'view',
                            'id' => $model->id
                    ]);
        }
        else
        {
            return $this->render('create', 
                    [
                            'model' => $model
                    ]);
        }
    }

    /**
     * Updates an existing Board model.
     * If update is successful, the browser will be redirected to the 'view'
     * page.
     *
     * @param integer $id            
     * @return mixed
     */
    public function actionUpdate ($id)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect(
                    [
                            'view',
                            'id' => $model->id
                    ]);
        }
        else
        {
            return $this->render('update', 
                    [
                            'model' => $model
                    ]);
        }
    }

    /**
     * Deletes an existing Board model.
     * If deletion is successful, the browser will be redirected to the 'index'
     * page.
     *
     * @param integer $id            
     * @return mixed
     */
    public function actionDelete ($id)
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
    protected function findModel ($id)
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
