<?php

namespace app\models;
use Yii;

class Usuarios extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public static function TableName()
    {
        return "usuarios";
    }
    
    public function rules()
    {
        return [
            'idusuarios' => Yii::T('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'ape1' => Yii::t('app', 'Primer Apellido'),
            'ape2' => Yii::t('app', 'Segundo Apellido'),
            'tipo' => Yii::t('app', 'Tipo'),
            'clave' => Yii::t('app', 'Clave'),
        ];
    }
    public static function findIdentity($id){
            return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null){
            throw new NotSupportedException();//I don't implement this method because I don't have any access token column in my database
    }

    public function getId(){
            return $this->idusuarios;
    }
        
    public function getAuthKey()
    {
            throw new NotSupportedException();//You should not implement this method if you don't have authKey column in your database
    }

    public function validateAuthKey($authKey)
    {
       throw new NotSupportedException();//You should not implement this method if you don't have authKey column in your database
    }
    
    public static function findByUsername($username){
            return self::findOne(['nombre'=>$username]);
    }
    
    public static function findById($id){
            return self::findOne(['idusuarios'=>$id]);
    }

    public function validatePassword($password){
            return $this->clave === md5($password);
    }
}