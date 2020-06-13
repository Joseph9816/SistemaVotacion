<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\ValidarFormulario;
use app\models\Candidatos;
use app\models\Votos;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public function actionView(){
        $table =  new Candidatos;
        $table2 = new Votos;
        $model = $table->find()->all();
        $model1 = $table2->find()->all();
        return $this->render("view", ["model" => $model, "model1" => $model1]);
    }
    
    public function actionVotar()
    {
        $table =  new Candidatos;
        $model = $table->find()->all();
        return $this->render("votar", ["model" => $model]);
    }
    /*public function actionSaluda(){
        $mensaje = "hola";
        return $this->render("saluda",["mensaje" =>$mensaje]);
    }
    public function actionRegistrarse($mensaje = null){

        return $this->render("registrarse", ["mensaje" =>$mensaje]);

    }
    public function actionRequest(){
        $mensaje = null;
        if(isset($_REQUEST["nombre"])){
            $mensaje = "Se agrego con exito el usuario:" . $_REQUEST["nombre"];
        }
        $this->redirect(["site/registrarse","mensaje" => $mensaje]);

    }
    public function actionValidarformulario(){
        $model = new ValidarFormulario;
        if($model->load(Yii::$app->request->post())){
            if($model->validate()){

            }
            else{
                $model->getErrors();
            }
        }
        return $this->render("validarformulario", ["model" => $model]);
    }*/




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
    public function actions()
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
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
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
