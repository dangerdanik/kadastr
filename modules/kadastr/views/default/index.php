<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
?>

<?php

$this->title = 'Кадастровые номера';

?>

<div class="kadastr-default-index">
    <h1>Получение кадастровых данных</h1>

    <?php $form = ActiveForm::begin(['id' => 'kd_search-form']); ?>

    <?= $form->field($model, 'cadastral_number')->textInput(['autofocus' => true]) ?>


    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'cadastral_number',
            'address',
            'price',
            'area',
            ['class' => 'yii\grid\ActionColumn',
                'template' => FALSE,
                /*'template' => '{update} {delete}',
                'buttons' => [
                    'update' => function($url, $model, $key) {

                        return Html::a(
                            '<span class="glyphicon glyphicon-pencil", title="Редактирование">', Url::to(['/group/update', 'id' => $model->group_id])
                        );
                    },
//                    'delete' => function($url, $model, $key) {
//
//                        return Html::a(
//                                        '<span class="glyphicon glyphicon-trash", onclick=""; title="Удаление" >', Url::to(['/sources/delete', 'id' => $model->sources_id])
//                        );
//                    },
                ]*/
            ],
        ],
    ]);
    ?>


    <div class="form-group">
        <?= Html::submitButton('Получить данные', ['class' => 'btn btn-primary', 'name' => 'kd_search-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
