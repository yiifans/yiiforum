<?php

namespace common\models;

use Yii;
use base\BaseActiveRecord;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property integer $thread_id
 * @property integer $user_id
 * @property string $user_name
 * @property string $title
 * @property string $body
 * @property string $create_time
 * @property string $modify_time
 * @property integer $supports
 * @property integer $againsts
 * @property integer $floor
 * @property string $note
 */
class Post extends BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['thread_id', 'user_id', 'user_name', 'title', 'body', 'create_time'], 'required'],
            [['thread_id', 'user_id', 'supports', 'againsts', 'floor'], 'integer'],
            [['body'], 'string'],
            [['create_time', 'modify_time'], 'safe'],
            [['user_name'], 'string', 'max' => 32],
            [['title'], 'string', 'max' => 128],
            [['note'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'thread_id' => 'Thread ID',
            'user_id' => 'User ID',
            'user_name' => 'User Name',
            'title' => 'Title',
            'body' => 'Body',
            'create_time' => 'Create Time',
            'modify_time' => 'Modify Time',
            'supports' => 'Supports',
            'againsts' => 'Againsts',
            'floor' => 'Floor',
            'note' => 'Note',
        ];
    }
}
