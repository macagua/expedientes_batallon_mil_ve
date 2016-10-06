<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Captador */

$this->title = $model->getJerarquia() . " ". $model->nombre_completo;
$this->params['breadcrumbs'][] = ['label' => 'Captadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="captador-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '¿Está seguro que desea eliminar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //'jquia',
            [
                'label' => 'Jerarquía',
                'attribute' => 'jquia',
                'value' => $model->getJerarquia(),
            ],
            'cedula',
            'nombre_completo',
            'telefono',
            // 'captado',
            [
                'attribute' => 'captado',
                // 'label' => 'Personal Captado',
                'value' => Html::a($model->captado,
                        // http://127.0.0.1/persona/view?id=25498875
                        ['persona/view','id'=>$model->captado],
                        ['title'=>'Ver Datos del Personal' ]
                ),
                'format'=>'raw',
            ],
        ],
    ]) ?>

</div>
