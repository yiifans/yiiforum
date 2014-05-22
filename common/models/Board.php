<?php

namespace common\models;

use Yii;
use base\BaseActiveRecord;

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
}
