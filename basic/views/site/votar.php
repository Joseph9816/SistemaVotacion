<?php
use yii\helpers\Url;
use app\config\params;
use yii\widgets\DetailView;
use Codeception\PHPUnit\ResultPrinter\HTML;
?>

<div class = "container">
    <div class = "row">
        <center>
            <h3>Sistema de votacion</h3>
        </center>
    </div>
    <div class="row">
        <div class="col">
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
            <label for="votos">Votar: </label><input type="radio" name="votos" value="" />
            <br><br>
            <?php endforeach;?>
        </div>
        
        <input class="btn btn-success" type="submit" value="Emitir Voto" name="b_voto" />
        <input class="btn btn-danger" type="button" onclick="document.location = 'index.php'" value="Regresar" name="b_regresar" />
        
    </div>
</div>


