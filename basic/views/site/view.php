<?php
use yii\helpers\Url;
?>
<h3>Resultado Votaciones</h3>
<table class = "table table-bordered">
    <tr>
        <th>Id candidato</th>
        <th>Nombre</th>
        <th>Cantidad votos</th>
    </tr>
    <?php foreach($model as $row): ?>
    <tr>
        <td><?= $row->idcandidatos ?></td>
        <td><?= $row->nombre ?></td>
        <td><?= $row->cantidad_votos?></td>
    </tr>
    <?php endforeach ?>
</table>