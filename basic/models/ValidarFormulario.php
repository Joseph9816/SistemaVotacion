<?php
    namespace app\models;
    use Yii;
    use yii\base\model;
    class ValidarFormulario extends model{
        public $nombre;
        public $id;
        public function rules(){
            return [['nombre','required', 'message' => 'Campo requerido'], 
            ['nombre','match', 'pattern' => "/^.{3,50}$/", 'message' => 'Minimo 3 y maximo 50 caracteres'],
            ['nombre', 'match', 'pattern' => "/^[a-z]+$/", 'message' => 'Solo se permiten letras'],
            ['id', 'required', 'message' => 'Campo requerido'],
            ['id','match', 'pattern' => "/^.{3,10}$/", 'message' => 'Minimo 3 y maximo 10 caracteres'],
            
            ];
        }
        public function attributeLabels(){
            return ['nombre' => 'Nombre:', 'id' => 'Id:',];
            
        }
    }
?>