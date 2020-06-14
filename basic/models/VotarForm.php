<?php

namespace app\models;
use app\models\Votos;
use app\models\Candidatos;
use yii\base\Model;
use app\models\Users;

use Yii;

class VotarForm extends Model
{
    public $yaVotoUsuario = "";
    public $registroVotar = "";
    
    public function votar($candidato)
    {
        $idCandidato = null;
        $modelCandidatos = new Candidatos;
        $tablaCandidatos = $modelCandidatos->find()->all();
        foreach ($tablaCandidatos as $tc):
            if($tc->nombre == $candidato)
            {
                $idCandidato = $tc->idcandidatos;
                break;
            }
        endforeach;
        $tabla = new Votos;
        $tabla->tipoVoto = Yii::$app->user->identity->tipo;
        $tabla->idCandidato = $idCandidato;
        if($tabla->insert())
        {
            $user = new Users;
            $tablaUsuario = $user->findOne(Yii::$app->user->identity->idusuarios);
            $tablaUsuario->nombre = Yii::$app->user->identity->nombre;
            $tablaUsuario->ape1 = Yii::$app->user->identity->ape1;
            $tablaUsuario->ape2 = Yii::$app->user->identity->ape2;
            $tablaUsuario->clave = Yii::$app->user->identity->clave;
            $tablaUsuario->voto = 1;
            if($tablaUsuario->update())
            {
                return "1";
            }
            return "2";
        }
        else
        {
            return "0";
        }
    }
    
    public function yaVoto()
    {
        $user = new Users;
        $tablaUsuario = $user->findOne(Yii::$app->user->identity->idusuarios);
        if($tablaUsuario->voto == 1)
        {
            return "1";
        }
        return "0";
    }

}