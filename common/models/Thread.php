<?php

namespace common\models;

use Yii;
use base\BaseActiveRecord;

/**
 * This is the model class for table "thread".
 *
 * @property integer $id
 * @property integer $board_id
 * @property integer $user_id
 * @property string $user_name
 * @property string $title
 * @property string $create_time
 * @property string $modify_time
 * @property integer $views
 * @property integer $posts
 * @property integer $status
 * @property string $note1
 * @property string $note2
 */
class Thread extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'thread';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['board_id', 'user_id', 'user_name', 'title', 'body', 'create_time'], 'required'],
            [['board_id', 'user_id', 'views', 'posts', 'status'], 'integer'],
            [['create_time', 'modify_time'], 'safe'],
            [['body'], 'string'],
            [['user_name'], 'string', 'max' => 32],
            [['title'], 'string', 'max' => 256],
            [['note1', 'note2'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'board_id' => 'Board ID',
            'user_id' => '用户ID',
            'user_name' => '用户名',
            'title' => '标题',
            'body' => '内容',
            'create_time' => '创建时间',
            'modify_time' => '修改时间',
            'views' => '浏览数',
            'posts' => '回帖数',
            'status' => '状态',
            'note1' => 'Note1',
            'note2' => 'Note2',
        ];
    }
    
    private $_body;
    public function getBody()
    {
    	if($this->_body==null)
    	{
    		$this->_body='';
    	}
    	return $this->_body;
    }
    public function setBody($value)
    {
    	$this->_body=$value;
    }
}
