<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'manufacturing_date')->textInput(['type' => 'date']) ?>
        </div>
    </div>

    <?php if(!$model->isNewRecord): ?>
        <?php $i=0; foreach ($storeProducts as $item): $i++ ?>
        <?php $param = ['options' =>[$item->store_code => ['Selected' => true]]]; ?>
        <div class="row" id="form-row">
            <div class="fields-frm">
                <div class="col-md-4">
                    <div class="form-group">
                        <?= $form->field($storeProductModel, 'store_code[]')->dropDownList(\yii\helpers\ArrayHelper::map($stores, 'code', 'name'), $param) ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <?= $form->field($storeProductModel, 'price[]')->textInput(['value' => $item->price]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($storeProductModel, 'quantity[]')->textInput(['value' => $item->quantity]) ?>
                </div>
            </div>
            <div class="col-md-1 btn-plus">
                <?php if($i==1): ?>
                    <button type="button" id="btn-row" class="btn btn-sm btn-warning"><i class="fa fa-plus"></i></button>
                    <button type="button" id="btn-del" onclick="delBtn(this)" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                <?php else: ?>
                    <button type="button" id="btn-del" onclick="delBtn(this)" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
    <div class="row" id="form-row">
        <div class="fields-frm">
            <div class="col-md-4">
                <div class="form-group">
                    <?= $form->field($storeProductModel, 'store_code[]')->dropDownList(\yii\helpers\ArrayHelper::map($stores, 'code', 'name')) ?>
                </div>
            </div>
            <div class="col-md-3">
                <?= $form->field($storeProductModel, 'price[]')->textInput() ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($storeProductModel, 'quantity[]')->textInput() ?>
            </div>
        </div>
        <div class="col-md-1 btn-plus">
            <button type="button" id="btn-row" class="btn btn-sm btn-warning"><i class="fa fa-plus"></i></button>
            <button type="button" id="btn-del" onclick="delBtn(this)" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <?php endif; ?>
    <div class="new-rows"></div>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
