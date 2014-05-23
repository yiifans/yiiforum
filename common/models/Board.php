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
 * @property integer $columns
 * @property integer $sort_num
 * @property string $redirect_url
 * @property string $target
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
            [['parent_id', 'name', 'description','columns', 'sort_num'], 'required'],
            [['parent_id', 'columns', 'sort_num', 'threads', 'posts'], 'integer'],
            [['name', 'target'], 'string', 'max' => 32],
            [['description', 'redirect_url'], 'string', 'max' => 128]
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
            'columns' => '子板块列数',
            'sort_num' => '排序',
            'redirect_url' => '转向URL',
            'target' => '打开方式',
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
    
    	$dataList=Board::findAll(['parent_id'=>$parentId],'sort_num desc');
    	
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
    		$content.=Board::getCacheItem('description',$row);
    		$content.=Board::getCacheItem('columns',$row,true);
    		$content.=Board::getCacheItem('sort_num',$row,true);
    		$content.=Board::getCacheItem('redirect_url',$row);
    		$content.=Board::getCacheItem('target',$row);
    		$content.=Board::getCacheItemValue('level',count($parentIds)-1,true);
    		
    
    		$content.="];".$newLine;
    	}
    
    
    	$dataRoot = \Yii::getAlias('@data');
    
    	TFileHelper::writeFile([$dataRoot,'cache','cachedBoards.php'], $content);
    	
    }
    
    public static function getCacheItem($name,$row,$isInt=false)
    {
    	return self::getCacheItemValue($name,$row[$name],$isInt);
    }
    
    public static function getCacheItemValue($name,$value,$isInt=false)
    {
    	$newLine="\r\n";
    
    	if($isInt)
    	{
    		$value = intval($value);
    	}
    	else 
    	{
    		$value='\''.$value.'\'';
    	}
    
    	return '	\''.$name.'\' => '.$value.','.$newLine;
    }
}
