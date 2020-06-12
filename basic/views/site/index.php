<?php

/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = 'Sistema de votacion UNA';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Bienvenido al Sistema de votacion </h1>

        <p class="lead">“Una papeleta de voto es más fuerte que una bala de fusil.”- ABRAHAM LINCOLN</p>

        <p><a class="btn btn-lg btn-success" href="<?= Url::toRoute("site/login") ?>">Ingresar al Sistema</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
            
                <h2>Votaciones</h2>

                <p>Elegir un rector y hacer valer nuestro derecho de votar es sumamanete importante,
                por eso se les invita a toda la comunidad estudiantil, academicos y administrativos
                a poner en practica su derecho del sufragio.
                Para ver el movimiento de las votaciones dale click al siguiente boton.</p>

                <p><a class="btn btn-default" href="<?= Url::toRoute("site/view") ?>">Ver Resultados de la votacion &raquo;</a></p>
            </div>
            <div class="col-lg-4"></div>
            
        </div>

    </div>
</div>
