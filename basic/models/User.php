<?php

namespace app\models;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    
    public $id;
    public $username;
    public $password;
    public $tipo;

    /**
     * @inheritdoc
     */
    
    /* busca la identidad del usuario a través de su $id */

    public static function findIdentity($id)
    {
        $model = new Usuarios;
        $user = $model->find()
                ->where("idusuarios=:idusuarios", [":idusuarios" => $id])
                ->one();/*
        static $user = null;
        $tabla = $model->find()->all();

        foreach($tabla as $row):
            if($row->idusuarios == $id)
            {
                $user = $row;
                $password = $row->clave;
            }
        endforeach;*/
        if(isset($user))
        {
            return new static($user);
        }
        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    
    /* Busca la identidad del usuario a través del username */
    public static function findByUsername($username)
    {
        $users = Usuarios::find()
                ->where("nombre=:nombre", [":nombre" => $username])
                ->all();
        
        foreach ($users as $user) {
            if (strcasecmp($user->username, $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    
    /* Regresa el id del usuario */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        /* Valida el password */
        if ($password == $this->password)
        {
            return $password === $password;
        }
    }
}