<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'role') ?>

    <?= $form->field($model, 'login') ?>

    <?= $form->field($model, 'pass') ?>

    <?= $form->field($model, 'name') ?>

    <?php  echo $form->field($model, 'age') ?>

    <?php  echo $form->field($model, 'position') ?>

    <?php  echo $form->field($model, 'type_zp') ?>

    <?php  echo $form->field($model, 'zp_h') ?>

    <?php  echo $form->field($model, 'id_group') ?>

    <?php  echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
