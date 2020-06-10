<?php
    use yii\helpers\Url;
    use yii\helpers\Html;
?>
<h1>Registrar usuario</h1>
<h3><?= $mensaje ?></h3>
<?= Html::beginForm(Url::toRoute("site/request"),//action
    "post",//metodo
    ['class' => 'form-inline']);//opciones
?>
<div class = "form-group">
    <?= Html::label("Introduce el nombre", "nombre") ?>
    <?= Html::textInput("nombre", null, ["class" => "form-control"]) ?>
</div>
<?= Html::submitInput("Enviar nombre", ["class" => "btn btn-primary"]) ?>


<?= Html::endForm() ?>

