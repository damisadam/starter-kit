<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-request-password-reset">

    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-5">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>Please fill out your username. A link to reset password will be sent there.</p>
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            <div class="form-group">
                <?= Html::submitButton('Send', ['class' => 'btn_1 btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>