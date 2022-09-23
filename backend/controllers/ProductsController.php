<?php

namespace backend\controllers;

use common\models\AdminLoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use common\models\Products;
use common\models\ProductsImages;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;

use function PHPSTORM_META\map;

/**
 * Site controller
 */
class ProductsController extends Controller
{
    public $productsModel;
    public $productsImagesModel;
    public $connection;
    public function __construct($id, $module, $config = [])
    {
        $this->productsModel = new Products();
        $this->productsImagesModel = new ProductsImages();
        $this->connection = \Yii::$app->db;
        parent::__construct($id, $module, $config);
    }
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['index', 'add', 'edit'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [],
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
                'class' => \yii\web\ErrorAction::class,
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
        $products = $this->productsModel->find()->all();
        return $this->render('index', [
            'products' => $products
        ]);
    }
    public function actionAdd()
    {
        $posts = Yii::$app->request->post();
        if ($this->productsModel->load($posts)) {
            $this->productsImagesModel->value = $posts['image'];
            $this->productsImagesModel->save();
            $this->productsModel->save();
            Yii::$app->session->setFlash('success', 'Product Add Successfly!');
            return $this->redirect(['products/index']);
        }
        $form = $this->renderAjax('form', [
            'model' => $this->productsModel,
            'modelImages' => $this->productsImagesModel,
            'title' => 'Create Product Settings'
        ]);
        return $this->render('add', [
            'form' => $form
        ]);
    }
    public function actionEdit($id)
    {
        $product = $this->productsModel->findOne(['id' => $id]);
        if (Yii::$app->request->isPost) {
            $posts = Yii::$app->request->post();
            if (count($posts) > 0) {
                $product->load($posts);
                $transaction = $this->connection->beginTransaction();
                try {
                    $product->save();
                    $this->productsImagesModel->save();
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Product Updated Successfly!');
                    return $this->redirect(['products/index']);
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    throw $e;
                } catch (\Throwable $e) {
                    $transaction->rollBack();
                    throw $e;
                }
            }
        }
        $form = $this->renderAjax('form', [
            'model' => $product,
            'modelImages' => $this->productsImagesModel,
            'title' => 'Edit Product Settings'
        ]);
        return $this->render('add', [
            'form' => $form
        ]);
    }
}
