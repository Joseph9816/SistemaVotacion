<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Candidatos;
use app\models\Votos;
use app\models\VotarForm;

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
    
    public function actionVotar($mensaje = null)
    {
        
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $table =  new Candidatos;
        $model = $table->find()->all();
        return $this->render("votar", ["model" => $model, "mensaje" => $mensaje]);
    }
    
    public function actionRequest()
    {
        $cont = 0;
        $candidato = null;
        $table =  new Candidatos;
        $model = $table->find()->all();
        foreach ($model as $mod):
            if(isset($_REQUEST['' . $mod->nombre]))
            {
                $candidato[$cont] = $mod->nombre;
                $cont++;
            }
        endforeach;
        if($cont > 1)
        {
            $mensaje = "Solo puede seleccionar una opcion";
            $this->redirect(["site/votar", "mensaje" => $mensaje]);
        }
        else if($cont == 0)
        {
            $mensaje = "Tiene que seleccionar una opcion";
            $this->redirect(["site/votar", "mensaje" => $mensaje]);
        }
        else
        {
            $validar = new VotarForm;
            $yaVoto = $validar->yaVoto();
            if($yaVoto == "0")
            {
                $rVoto = $validar->votar($candidato[0]);
                if($rVoto == "1")
                {
                    $mensaje = "Voto registrado";
                    $this->redirect(["site/votar", "mensaje" => $mensaje]);
                }
                else if($rVoto == "2")
                {
                    $mensaje = "Error al cambiar que ya voto";
                    $this->redirect(["site/votar", "mensaje" => $mensaje]);
                }
                else
                {
                    $mensaje = "Error al registrar";
                    $this->redirect(["site/votar", "mensaje" => $mensaje]);
                }
            }
            else
            {
                $mensaje = "No puede votar mas de una vez";
                $this->redirect(["site/votar", "mensaje" => $mensaje]);
            }
        }
    }
    
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
