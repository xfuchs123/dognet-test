<?php

use common\models\Company;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model Company */
/* @var $users array */
/* @var $countries array */
/* @var $companies \yii\data\ActiveDataProvider */

$this->title = 'Company';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="company">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-5">
            <?php
            $form = ActiveForm::begin([
                'id' => 'company-form'
            ]);
            ?>
            <?= $form->field($model, 'name')->textInput() ?>
            <?= $form->field($model, 'country')->dropDownList($countries) ?>
            <?= $form->field($model, 'vat_id')->textInput()->hint('Please enter in format "SKxxx"') ?>
            <?= $form->field($model, 'fk_user')->dropDownList($users, ['prompt' => 'Please select a company owner']) ?>

            <div class="form-group">
                <?= Html::submitButton('Add Company', ['class' => 'btn btn-primary', 'name' => 'company-add-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?= GridView::widget([
                    'dataProvider' => $companies,
                    'showOnEmpty' => true,
                    'summaryOptions' => ['class' => 'company-summary'],
                    'showFooter' => true,
                    'showHeader' => true,
                    'columns' => [
                            'name',        //safe output is handled automatically by default in gridview column
                            'vat_id',
                            'country',
                            [
                                'attribute' => 'user.username',
                                'label' => 'Owner'
                            ],

                    ]
            ]) ?>
        </div>
    </div>

</div>
