<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Продукты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить продукт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'manufacturing_date',
                'filterType' => GridView::FILTER_DATE_RANGE,
                'filterWidgetOptions' => [
                    'convertFormat'=>true,
                    'pluginOptions' => [
                        'opens'=>'right',
                        'locale' => [
                            'cancelLabel' => 'Закрыть',
                            'format' => 'Y-m-d',
                        ]
                    ]
                ],
            ],
            'name',
            [
                'attribute' => 'description',
                'filter' => false,
                'value' => function($model){
                    return \app\models\Product::strLimit($model->description);
                }
            ],

            [
                'attribute' => 'storename',
                'filter' => false,
                'value' => function($model){
                    return $model->storename;
                },
                'header' => 'Склад и стоимость'
            ],
            [
                'class' => \yii\grid\ActionColumn::className(),
                'buttons'=>[
                    'delete'=>function ($url, $model) {

                        return \yii\helpers\Html::a( 'Удалить', $url,
                            ['title' => Yii::t('yii', 'View'), 'data-pjax' => '0', 'data-method' => 'post']);
                    },
                    'update'=>function ($url, $model) {
                        return \yii\helpers\Html::a( 'Редактировать', $url,
                            ['title' => Yii::t('yii', 'Update'), 'data-pjax' => '0']);
                    }
                ],
                'template'=>"{update} {delete}",

            ]
        ],
    ]); ?>


</div>
