<?php
use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;


?>
<h3>Resultado Votaciones</h3>
<table class = "table table-bordered">
    <tr>
        <th>Id candidato</th>
        <th>Nombre</th>
    </tr>
    <?php 
        $array;
        $x=0;
        foreach($model as $row): 
            $array[$x]=$row->cantidad_votos;
            $x++;
    ?>
    <tr>
        <td><?= $row->idcandidatos ?></td>
        <td><?= $row->nombre ?></td>
    </tr>
    <?php endforeach ?>
</table>

<?php
    $aca1 = 0;
    $adm1 = 0;
    $estu1 = 0;
    $aca2 = 0;
    $adm2 = 0;
    $estu2 = 0;
    $aca3 = 0;
    $adm3 = 0;
    $estu3 = 0;
    foreach($model1 as $row1):
        if($row1->tipoVoto == 'aca' && $row1->idCandidato == 1)
        {
            $aca1++;
        }
        else if($row1->tipoVoto == 'aca' && $row1->idCandidato == 2)
        {
            $aca2++;
        }
        else if($row1->tipoVoto == 'aca' && $row1->idCandidato == 3)
        {
            $aca3++;
        }
        else if($row1->tipoVoto == 'adm' && $row1->idCandidato == 1)
        {
            $adm1++;
        }
        else if($row1->tipoVoto == 'adm' && $row1->idCandidato == 2)
        {
            $adm2++;
        }
        else if($row1->tipoVoto == 'adm' && $row1->idCandidato == 3)
        {
            $adm3++;
        }
        else if($row1->tipoVoto == 'estu' && $row1->idCandidato == 1)
        {
            $estu1++;
        }
        else if($row1->tipoVoto == 'estu' && $row1->idCandidato == 2)
        {
            $estu2++;
        }
        else if($row1->tipoVoto == 'estu' && $row1->idCandidato == 3)
        {
            $estu3++;
        }
    endforeach;
    $voto1 = ($aca1 * 0.60) + ($adm1 * 0.15) + ($estu1 * 0.25);
    $voto2 = ($aca2 * 0.60) + ($adm2 * 0.15) + ($estu2 * 0.25);
    $voto3 = ($aca3 * 0.60) + ($adm3 * 0.15) + ($estu3 * 0.25);
?>





<?php
$data = [
    ['Salom', $voto1],
    ['Francisco', $voto2],
    ['Leiner',$voto3]
];
$tituloGrafica1 = "Clicks por departamento";
$clickByDeptoChart[] = [ 'name' => 'Sistemas', 'y' => 1];
$clickByDeptoChart[] = [ 'name' => 'Soporte', 'y' => 4];

$clickByDeptoChart[] = [ 'name' => 'Administracion', 'y' => 6];
?>

<?= 
Highcharts::widget([
'scripts' => [
'highcharts-pie',
],
'options' => [
'credits' => ['enabled' => false],
'chart' => ['type' => 'pie'
],
'plotOptions' => [ // it is important here is code for change depth and use pie as donut
    'pie' => [
        'allowPointSelect' => true,
        'cursor' => 'pointer',
        'innerSize' => 100,
        'depth' => 45,
        'showInLegend' => true
    ]
],

'title' => ['text' => 'Titulo de Gráfica'],
'series' => [[
    'type' => 'pie',
    'name' => 'Menciones',
    'data' => $data,

    ]],
]

]);
    

?>
<?= 
Highcharts::widget([
    'scripts' => ['modules'],
    'options' => [
        'chart' => ['type' => 'column'],
        'title' => ['text' => $tituloGrafica1],
        'xAxis' => ['type' => 'category'],
        'yAxis' => ['title' => ['text' => 'click por departamento']],
        'series' => [
            [
                'name' => 'Dio Click',
                'colorByPoint' => true,
                'data' => $clickByDeptoChart
            ],
        ],
    ]
]);
?>