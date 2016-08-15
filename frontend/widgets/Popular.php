<?php
namespace frontend\widgets;

use common\models\Comment;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class Popular extends Widget
{
    public $count;

    public function init()
    {
        parent::init();
        if ($this->count === null) {
            $this->count = 5;
        }
    }

    public function run()
    {
        $data = '<h4>' . Yii::t('app', 'Popular posts') . '</h4>';
        $data .= '<br>';

        $rows = Comment::find()
            ->select(['post', 'id', 'count(post) as kolvo'])
            ->groupBy('post')
            ->orderBy('kolvo DESC')
            ->limit($this->count)
            ->all();

        if ( empty($rows) ) {
            $data .= Yii::t('app', 'Popular post list empty');
            return $data;
        }

        foreach ( $rows as $row ) {
            $comment = Comment::findOne($row->id);
            $title = @$comment->post0->title;
            $data .= Html::a($title, ['post/show', 'id' => @$comment->post0->id], ['class' => 'btn-link']) . '<br><br>';
        }

        return $data;
    }
}
