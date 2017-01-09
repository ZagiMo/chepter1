<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_users".
 *
 * @property integer $user_id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $oauth_provider
 * @property string $oauth_uid
 *
 * @property TblImages[] $tblImages
 * @property TblPrivileges[] $tblPrivileges
 * @property TblPrivileges[] $tblPrivileges0
 * @property TblUserProfile[] $tblUserProfiles
 * @property TblViews $tblViews
 * @property TblViews[] $tblViews0
 */
class Members extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required'],
            [['username'], 'string', 'max' => 20],
            [['email', 'password'], 'string', 'max' => 45],
            [['oauth_provider', 'oauth_uid'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'oauth_provider' => 'Oauth Provider',
            'oauth_uid' => 'Oauth Uid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblImages()
    {
        return $this->hasMany(TblImages::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblPrivileges()
    {
        return $this->hasMany(TblPrivileges::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblPrivileges0()
    {
        return $this->hasMany(TblPrivileges::className(), ['privileged_user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblUserProfiles()
    {
        return $this->hasMany(TblUserProfile::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblViews()
    {
        return $this->hasOne(TblViews::className(), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblViews0()
    {
        return $this->hasMany(TblViews::className(), ['viewed_user_id' => 'user_id']);
    }


    public static function findIdentity($id){
      return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null){
      throw new NotSupportedException();
    }

    public function getId(){
      return $this->user_id;
    }

    public static function findByUsername($username){
      return self::findOne(['username'=>$username]);
    }

    public function validatePassword($password){
      return $this->password === $password;
    }

    public function getAuthKey(){
      return $this->authKey;
    }

    public function validateAuthKey($authKey){
      return $this->authKey === $authKey;
    }


}
