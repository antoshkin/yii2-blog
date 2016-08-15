<?php

namespace frontend\controllers;

use Yii;
use common\models\Comment;
use yii\web\Controller;
use common\models\Post;
use common\models\User;
use yii\data\ActiveDataProvider;

class PostController extends Controller
{
    public function actionCreate()
    {
        $post = new Post();

        $load = $post->load(Yii::$app->request->post());
        if ( Yii::$app->user->can('admin') ) {
            $allow = true;
        } elseif ( Yii::$app->user->getId() != $post->author ) {
            $allow = false;
        } else {
            $allow = true;
        }

        if ( $load && $allow && $post->save() ) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Post successfully created'));
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Post creation error'));
        }

        $this->goBack();
    }

    public function actionUpdate()
    {

        $id = Yii::$app->request->post()['Post']['id'];

        if ( Yii::$app->user->can('admin') || Yii::$app->user->can('managePost',['post_id' => $id]) ) {

            $post = Post::findOne($id);

            if ( $post->load(Yii::$app->request->post()) && $post->update() ) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Post successfully updated'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Post updating error'));
            }
        }


        $this->goBack();
    }

    public function actionIndex()
    {
        $post = new Post();

        $dataProviderPosts = new ActiveDataProvider([
            'query' => Post::find()->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', ['post' => $post ,'listDataProvider' => $dataProviderPosts]);
    }

    public function actionShow($id)
    {
        $post = Post::findOne($id);
        $comment = new Comment();

        $dataProviderComments = new ActiveDataProvider([
            'query' => Comment::find()->where(['post' => $id])->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        // -- detect user ID of future comment author
        $user_id = Yii::$app->user->getId();
        $commentAuthor = empty( $user_id ) ? User::findByUsername('guest')->getId() : $user_id;

        return $this->render('show', [
            'post' => $post,
            'commentAuthor' => $commentAuthor,
            'listDataProvider' => $dataProviderComments,
            'comment' => $comment
            ]
        );
    }

    public function actionAddcomment() {

        $comment = new Comment();

        if ( $comment->load(Yii::$app->request->post()) && $comment->save() ) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'Comment successfully sent'));
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Comment add error'));
        }

        $this->redirect(['post/show','id' => $comment->post]);

    }

    public function actionEdit($id) {

        if ( Yii::$app->user->can('admin') || Yii::$app->user->can('managePost',['post_id' => $id]) ) {
            $post = Post::findOne($id);
            return $this->render( 'edit', ['post' => $post] );
        } else {
            $this->goBack();
        }

    }

    public function actionDelete($id) {

        if ( Yii::$app->user->can('admin') || Yii::$app->user->can('managePost',['post_id' => $id]) ) {

            if (Post::deleteAll(['id' => $id])) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Post successfully deleted'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Post delete error'));
            }

        }

        $this->goBack();

    }

}