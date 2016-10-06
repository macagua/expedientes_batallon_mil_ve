<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use yii\helpers\Url;
use yii\web\View;
use app\models\Unidad;

/* @var $this yii\web\View */
/* @var $model app\models\Persona */
/* @var $form yii\widgets\ActiveForm */

$url = Url::to(['ajax-municipio']);
$this->registerJs(
"
$('#persona-estado_id').on('change', function(e) {
    $.ajax({
       url: '".$url."',
       data: {estado_id: $('#persona-estado_id').val()},
       success: function(html) {
           console.log(html);
          $('#".Html::getInputId($model, 'municipio_id')."').html(html);
       },
       error: function(result) {
                    alert('Estado no encontrado');
                }
    });
});
", View::POS_READY);

$url = Url::to(['ajax-parroquia']);
$this->registerJs(
"
$('#persona-municipio_id').on('change', function(e) {
    $.ajax({
       url: '".$url."',
       data: {municipio_id: $('#persona-municipio_id').val()},
       success: function(html) {
           console.log(html);
          $('#".Html::getInputId($model, 'parroquia_id')."').html(html);
       },
       error: function(result) {
                    alert('Municipio no encontrado');
                }
    });
});
", View::POS_READY);

?>

<div class="persona-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cedula')->textInput() ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

    <?php /* $form->field($model, 'estado_id')->dropDownList(
        ArrayHelper::map($estados, 'id_estado','estado'),
        [
            'prompt'=>'--Seleccione--',
        ]
    ); */ ?>
    <?php /* $form->field($model, 'municipio_id')->dropDownList(
          ArrayHelper::map($municipios, 'id_municipio','municipio'),
          [
              'prompt'=>'--Seleccione--',
          ]
    ); */ ?>
    <?php /* $form->field($model, 'parroquia_id')->dropDownList(
        ArrayHelper::map($parroquias, 'id_parroquia','parroquia'),
        [
            'prompt'=>'--Seleccione--',
        ]
    ); */ ?>

    <?= $form->field($model, 'lugar_nacimiento')->textInput() ?>

    <?php // $form->field($model, 'fecha_nacimiento')->textInput() ?>
    <?= $form->field($model,'fecha_nacimiento')->
        widget(DatePicker::className(),[
            'dateFormat' => 'yyyy-MM-dd',
            'language' => 'es',
            'clientOptions' => [
                'yearRange' => '-115:+0',
                'changeYear' => true],
                'options' => ['class' => 'form-control']
        ])->label('Fecha de nacimiento') ?>

    <?= $form->field($model, 'direccion')->textInput() ?>

    <?= $form->field($model, 'sector')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono_movil')->textInput() ?>

    <?php // $form->field($model, 'religion')->textInput() ?>
    <?= $form->field($model, 'religion')->dropDownList(
        [
            '1'=>'Catolicismo',
            '2'=>'Protestante',
            '3'=>'Movimiento de los Santos de los Últimos Días',
            '4'=>'Judaísmo',
            '5'=>'Islam',
            '6'=>'Budismo',
            '7'=>'Santería Caribeña',
            '8'=>'Espiritismo',
            '9'=>'Ateísmo',
            '10'=>'Otra creencia',
        ],
        ['prompt'=>'Por favor, seleccioné una opción',]
    )->label('Religión'); ?>

    <?php // $form->field($model, 'estado_civil')->textInput() ?>
    <?php /* $form->field($model, 'estado_civil')->dropDownList(
        ['S'=>'Soltero', 'C'=>'Casado', 'V'=>'Viudo'],
        ['prompt'=>'Por favor, seleccioné una opción',]
    )->label('Estado civil'); */ ?>
    <?= $form->field($model, 'estado_civil')->dropDownList(
        $model->getOpcionesEdoCivil(),
        ['prompt'=>'Por favor, seleccioné una opción',]
    )->label('Estado civil'); ?>

    <?php // $form->field($model, 'modalidad')->textInput(['maxlength' => true]) ?>
    <?php /* $form->field($model, 'modalidad')->dropDownList(
        ['C'=>'Tiempo completo', 'P'=>'Tiempo parcial'],
        ['prompt'=>'Por favor, seleccioné una opción',]
    )->label('Modalidad'); */ ?>
    <?= $form->field($model, 'modalidad')->dropDownList(
        $model->getOpcionesModalidad(),
        ['prompt'=>'Por favor, seleccioné una opción',]
    )->label('Modalidad'); ?>

    <?php // $form->field($model, 'unidad_id')->textInput() ?>
    <?= $form->field($model, 'unidad_id')->dropDownList(
        ArrayHelper::map(Unidad::find()->all(),'id','unidad'),
            ['prompt'=>'Por favor, seleccioné una opción']
    )->label('Unidad asignada') ?> 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
