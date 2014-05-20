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
            [['board_id', 'user_id', 'user_name', 'title', 'create_time'], 'required'],
            [['board_id', 'user_id', 'views', 'posts', 'status'], 'integer'],
            [['create_time', 'modify_time'], 'safe'],
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
            'user_id' => 'User ID',
            'user_name' => 'User Name',
            'title' => 'Title',
            'create_time' => 'Create Time',
            'modify_time' => 'Modify Time',
            'views' => 'Views',
            'posts' => 'Posts',
            'status' => 'Status',
            'note1' => 'Note1',
            'note2' => 'Note2',
        ];
    }
}
