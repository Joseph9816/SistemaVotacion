<?php
    use yii\helpers\Url;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>

<h1>Registrar usuario</h1>

<?php $form = ActiveForm::begin([
    "method" => "post",
    "enableClientValidation" => true]);
?>
<div clas="form-group">
    <?= $form->field($model, "id")->input("text") ?>
</div>
<div clas="form-group">
    <?= $form->field($model, "nombre")->input("text") ?>
</div>
<?= Html::submitButton("Registrar", ["class" => "btn btn-primary"]) ?>

<?php $form->end() ?>
