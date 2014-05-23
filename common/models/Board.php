<?php

namespace common\models;

use Yii;
use base\BaseActiveRecord;
use common\helpers\TFileHelper;

/**
 * This is the model class for table "board".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $description
 * @property integer $threads
 * @property integer $posts
 */
class Board extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'board';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'name', 'description'], 'required'],
            [['parent_id', 'threads', 'posts'], 'integer'],
            [['name'], 'string', 'max' => 32],
            [['description'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '标号',
            'parent_id' => '父级',
            'name' => '名称',
            'description' => '描述',
            'threads' => '主题数',
            'posts' => '回帖数',
        ];
    }
    private $_level;
    public function getLevel()
    {
    	return $this->_level;
    }
    public function setLevel($value)
    {
    	$this->_level=$value;
    }
    
    private static function  _getBoardArrayTree($parentId=0,$level=0)
    {
    	$ret=[];
    
    	$dataList=Board::findAll(['parent_id'=>$parentId]);
    	
    	if($dataList==null || empty($dataList)){
    		return $ret;
    	}
    	
    	foreach ($dataList as $key=>$value){
    		$value->level=$level;
    		$ret[]=$value;
    
    		$temp=self::_getBoardArrayTree($value['id'],$level+1);
    		$ret=array_merge($ret,$temp);
    	}
    	return $ret;
    }
    
    private static $_boardArrayTree;
    public static function  getBoardArrayTree($parentId=0,$level=0)
    {
    	if(self::$_boardArrayTree==null)
    	{
    		self::$_boardArrayTree=self::_getBoardArrayTree($parentId,$level);
    	}
    	return  self::$_boardArrayTree;
    }
    
    public static function getParentIds($id)
    {
    	$ret=[];
    
    	$current = Board::findOne(['id'=>$id]);
    
    	$parent = Board::findOne(['id'=>$current['parent_id']]);
    	while ($parent != null)
    	{
    		array_unshift($ret,$parent->id);
    		
    		$parent = Board::findOne(['id'=>$parent['parent_id']]);
    	}
    	array_unshift($ret,0);
    	return $ret;
    }
    
    public static function createCache()
    {
    	$newLine="\r\n";
    
    	$content='<?php'.$newLine;
    	
    
    	$channels=Board::find()->all();
    
    	foreach ($channels as $row)
    	{
    		$id=$row['id'];
    			
    		$content.='$cachedBoards['.$row['id'].']=['.$newLine;
    
    		$content.=Board::getCacheItem('id', $row, true);
    		$content.=Board::getCacheItem('parent_id', $row,true);
    			
    		$parentIds=Board::getParentIds($id);
    		$content.=Board::getCacheItemValue('parent_ids',implode(',', $parentIds));
    		
    			
    		$content.=Board::getCacheItem('name',$row);
    		
    		$content.=Board::getCacheItemValue('level',count($parentIds)-1,true);
    		
    
    		$content.="];".$newLine;
    	}
    
    
    	$dataRoot = \Yii::getAlias('@data');
    
    	TFileHelper::writeFile([$dataRoot,'cache','cachedBoards.php'], $content);
    		
    	//$this->info($cachedContent,__METHOD__);
    
    	//return $content;
    }
    
    public static function getCacheItem($name,$row,$isInt=false)
    {
    	$newLine="\r\n";
    
    	$value='\''.$row[$name].'\'';
    
    	if($isInt)
    	{
    		if(isset($row[$name]))
    		{
    			$value=$row[$name];
    		}
    		else
    		{
    			$value=0;
    		}
    	}
    
    	return '	\''.$name.'\' => '.$value.','.$newLine;
    }
    
    public static function getCacheItemValue($name,$value,$isInt=false)
    {
    	$newLine="\r\n";
    
    	if(!$isInt)
    	{
    		$value='\''.$value.'\'';
    	}
    	
    
    	return '	\''.$name.'\' => '.$value.','.$newLine;
    }
}
