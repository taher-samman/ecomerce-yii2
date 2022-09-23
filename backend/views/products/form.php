<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'form-product',
    'options' => ['class' => 'form-horizontal'],
]) ?>
<div class="container form-products">
    <div class="toolbar">
        <h1 class="title">Manage Product</h1>
        <div class="action-product">
            <?= Html::submitButton('Save', ['class' => 'btn']) ?>
        </div>
    </div>
    <div class="row form-row">
        <div class="col-md-10 ms-auto pt-5">
            <div class="form-grid">
                <p class="title">
                    <?= $title; ?>
                </p>
                <div class="controls">
                    <?= $form->field($model, 'name') ?>
                    <?= $form->field($model, 'sku') ?>
                    <?= $form->field($model, 'description')->textarea() ?>
                    <?= $form->field($model, 'price')->textInput(['type' => 'number']) ?>
                    <?= $form->field($model, 'special_price')->textInput(['type' => 'number']) ?>
                    <?= $form->field($model, 'qty')->textInput(['type' => 'number']) ?>
                    <?= $form->field($model, 'max_qty_allowed')->textInput(['type' => 'number']) ?>
                    <?= $form->field($model, 'min_qty_allowed')->textInput(['type' => 'number']) ?>
                    <?= $form->field($modelImages, 'value')->fileInput() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end() ?>