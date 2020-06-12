<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;

class Votos extends ActiveRecord{
    public static function getDB(){
        return Yii::$app->db;
    }
    public static function tableName(){
        return 'votos';
    }
}


?>