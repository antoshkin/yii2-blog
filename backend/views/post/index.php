<?php

use yii\widgets\ListView;

/* @var $this yii\web\View */
$this->title = Yii::t('app', 'V-jet Blog');
?>

<?php

echo ListView::widget([
    'dataProvider' => $listDataProvider,
    'options' => [
        'tag' => 'div',
        'class' => 'list-wrapper',
        'id' => 'list-wrapper',
    ],
    'layout' => "{items}\n{pager}\n",
    'itemView' => function ($model, $key, $index, $widget) {
        return $this->render('_one_post_list',['model' => $model]);
    },
]);
?>

<hr>




