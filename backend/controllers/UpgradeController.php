<?php
namespace backend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\base\BaseFrontController;
use common\models\Board;
use common\helpers\TFileHelper;
use frontend\base\BaseBackController;

/**
 * Site controller
 */
class UpgradeController extends BaseBackController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function getUpgradeInfo()
    {
    	$sqlPath=\Yii::getAlias('@data').TFileHelper::buildPath(['sql']);
    	 
    	$upgradeData=TFileHelper::readFile([$sqlPath,'upgrade.txt']);
    	$lastSql=intval($upgradeData);
    	 
    	$sqls=TFileHelper::getFile($sqlPath,'yiiforum_');
    	 
    	$sqlVersions=[];
    	foreach ($sqls as $sql)
    	{
    		$sqlNum=ltrim($sql,'yiiforum_');
    		$sqlNum=rtrim($sqlNum,'.sql');
    	
    		$sqlVersions[]=intval($sqlNum);
    	}
    	sort($sqlVersions);
    	 
    	$needUpgradeFiles=[];
    	foreach ($sqlVersions as $sqlVersion)
    	{
    		if($sqlVersion <= $lastSql)
    		{
    			continue;
    		}
    		$needUpgradeFiles[]='yiiforum_'.$sqlVersion.'.sql';
    	}
    	return ['lastSql'=>$lastSql,'needUpgradeSqls'=>$needUpgradeFiles];
    }
    
    public function actionIndex()
    {
    	
    	$upgradeInfo=$this->getUpgradeInfo();
    	
    	
    	$params=$upgradeInfo;
    	
    	
        return $this->render('index',$upgradeInfo);
    }

    public function actionDo()
    {
    	$sqlPath=\Yii::getAlias('@data').TFileHelper::buildPath(['sql']);
    	
    	$upgradeInfo=$this->getUpgradeInfo();
    	
    	$lastSql=$upgradeInfo['lastSql'];
    	$needUpgradeSqls=$upgradeInfo['needUpgradeSqls'];
    	$message='';
    	if(empty($needUpgradeSqls))
    	{
    		$message='没有要升级的文件';
    	}
    	else 
    	{
    		foreach ($needUpgradeSqls as $sql)
    		{
    			$sqlData=TFileHelper::readFile([$sqlPath,$sql]);
    			$this->execute($sqlData);
    		}
    		
    		$lastSql=end($needUpgradeSqls);
    		$lastSql=ltrim($lastSql,'yiiforum_');
    		$lastSql=rtrim($lastSql,'.sql');
    		
    		TFileHelper::writeFile([$sqlPath,'upgrade.txt'], $lastSql);
    		
    		$message='升级成功，当前sql为：yiiforum_'.$lastSql.'.sql';
    	}
    	
    	
    	
        return $this->render('do', [
        		'message' => $message,
        		]);
        
        
    }

   
}
