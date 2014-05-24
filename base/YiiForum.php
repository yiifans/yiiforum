<?php
namespace base;

use Yii;
use common\models\LoginForm;
use yii\data\Pagination;
use yii\helpers\VarDumper;

/**
 * Site controller
 */
class YiiForum
{
	public static function getApp()
	{
		return \Yii::$app;
	}
	
	public static function getView()
	{
		$view = \Yii::$app->getView();
		return $view;
	}
	
	public static function getHomeUrl($url=null)
	{
		$homeUrl = \Yii::$app->getHomeUrl();
		if($url!==null)
		{
			$homeUrl.=$url;
		}
		return $homeUrl;
	}
	public static function getWebUrl($url=null)
	{
		return \Yii::getAlias('@web');
	}
	
	public static function getWebPath()
	{
		return \Yii::getAlias('@webroot');
	}
	
	public static function getAppParam($key,$defaultValue=null)
	{
		$params = \Yii::$app->params;
		if(isset($params[$key]))
		{
			return $params[$key];
		}
		return $defaultValue;
	}
	
	public static function setAppParam($array)
	{
		foreach ($array as $key=>$value)
		{
			\Yii::$app->params[$key]=$value;
		}
	}
	
	public static function getViewParam($key,$defaultValue=null)
	{
		$view = \Yii::$app->getView();
		if(isset($view->params[$key]))
		{
			return $view->params[$key];
		}
		return $defaultValue;
	}
	
	public static function setViewParam($array)
	{
		$view = \Yii::$app->getView();
		foreach ($array as $name=>$value)
		{
			$view->params[$name] =$value;
		}
	}
	
	public static function hasGetValue($key)
	{
		return isset($_GET[$key]);
	}
	
	public static function getGetValue($key,$default=NULL)
	{
		if(self::hasGetValue($key))
		{
			return $_GET[$key];
		}
		return $default;
	}
	
	public static function hasPostValue($key)
	{
		return isset($_POST[$key]);
	}
	
	public static function getPostValue($key,$default=NULL)
	{
		if(self::hasPostValue($key))
		{
			return $_POST[$key];
		}
		return $default;
	}
	
	public static function getUser()
	{
		return Yii::$app->user;
	}
	
	public static  function getIdentity()
	{
		return Yii::$app->user->getIdentity();
	}
	
	public static function getIsGuest()
	{
		return Yii::$app->user->isGuest;
	}
	
	public static function checkIsGuest()
	{
		$isGuest = Yii::$app->user->isGuest;
		if($isGuest)
		{
			return $this->redirect(['site/login']);
		}
		return true;
	}
	
	public static function info($var,$category = 'application')
	{
		$dump=VarDumper::dumpAsString($var);
		Yii::info($category.$dump,$category);
	}
	
	public static function execute($sql)
	{
		//Yii::info($sql,__METHOD__);
		$db=\Yii::$app->db;
		$command=$db->createCommand($sql);
		return $command->execute();
	}
	
	public static function getPagedRows($query,$config=[])
	{
		$countQuery = clone $query;
		$pages=new Pagination(['totalCount' => $countQuery->count()]);
		if(isset($config['pageSize']))
		{
			$pages->setPageSize($config['pageSize'],true);
		}
	
		$rows = $query->offset($pages->offset)->limit($pages->limit);
		if(isset($config['order']))
		{
			$rows = $rows->orderBy($config['order']);
		}
		$rows = $rows->all();
	
	
		$rowsLable='rows';
		$pagesLable='pages';
	
		if(isset($config['rows']))
		{
			$rowsLable=$config['rows'];
		}
		if(isset($config['pages']))
		{
			$pagesLable=$config['pages'];
		}
	
		$ret=[];
		$ret[$rowsLable]=$rows;
		$ret[$pagesLable]=$pages;
	
		return $ret;
	}
}
