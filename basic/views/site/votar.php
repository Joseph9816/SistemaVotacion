<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\config\params;
use yii\widgets\DetailView;
?>

<div class = "container">
    <div class = "row">
        <center>
            <h3>Sistema de votacion</h3>
        </center>
    </div>
    <div class="row">
        <div class="col">
            <h3 class="bg-danger""><?= $mensaje ?></h3>
            <?= Html::beginForm(
                    Url::toRoute("site/request"),
                    "get",
                    ['class' => 'form-inline']
                    );
            ?>
            <div class="form-group">
                <?php foreach ($model as $mod):?>
                <?=
                    DetailView::widget([
                        'model' => $mod,
                        'attributes' => [
                        [
                            'attribute' => 'Candidato',
                            'value' => Yii::getAlias('@candidatoImgUrl') . $mod->imagen,
                            'format' => ['image', ['width' => '150', 'height' => '150']]
                        ]
                        ],
                    ]);
                ?>
                <label>Nombre: <?= $mod->nombre ?> <?= $mod->ape1 ?> <?= $mod->ape2 ?></label><br>
                <!--<label for="votos">Votar: </label><input type="radio" name="votos" value="" />-->
                <?= Html::checkbox('' . $mod->nombre, false, ['label' => 'Votar por ' . $mod->nombre]) ?>
                <br><br>
                <?php endforeach;?>
                </div>
        </div>
        
        <!--<input class="btn btn-success" type="submit" value="Emitir Voto" name="b_voto" />-->
        <input class="btn btn-danger" type="button" onclick="document.location = 'index.php'" value="Regresar" name="b_regresar" />
        <?= Html::submitInput("Emitir Voto", ['class' => "btn btn-success"]) ?>
        
    </div>
</div>


