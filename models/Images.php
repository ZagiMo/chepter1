<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_images".
 *
 * @property integer $image_id
 * @property integer $user_id
 * @property string $image_name
 * @property integer $is_private
 *
 * @property Members $user
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'image_name', 'is_private'], 'required'],
            [['user_id', 'is_private'], 'integer'],
            [['image_name'], 'string', 'max' => 20],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Members::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'image_id' => 'Image ID',
            'user_id' => 'User ID',
            'image_name' => 'Image Name',
            'is_private' => 'Is Private',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Members::className(), ['user_id' => 'user_id']);
    }
}
