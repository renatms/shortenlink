<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Short;
use yii\filters\VerbFilter;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    /*public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }*/

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new Short();
        $link = 'http://' . $_SERVER['HTTP_HOST'] . '/';

        $query = mb_substr(Yii::$app->request->url, 1); // mb_substr - удаление первого символа из строки
        $findLink = Short::find()->andWhere(['short_key' => $query])->one();
        if (!empty($findLink))
            return $this->redirect($findLink->url);


        if ($model->load(Yii::$app->request->post())) {
            if ($model->notExistUrl($model->url)) {
                $model->short_key = $model->shortUrl();
                $model->save();
            } else {
                $model = Short::find()->andWhere(['url' => $model->url])->one();
            }

            return $this->render('index', [
                'model' => $model, 'link' => $link . $model->short_key
            ]);
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
