<?php

namespace app\controllers;

use app\models\Store;
use app\models\StoreProduct;
use Yii;
use app\models\Product;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $storeProductModel = new StoreProduct();
        $stores = Store::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save() && $storeProductModel->load(Yii::$app->request->post())) {
            foreach ($storeProductModel->store_code as $k => $v){
                $storeProduct = new StoreProduct();
                $storeProduct->store_code = $v;
                $storeProduct->product_id = $model->id;
                $storeProduct->quantity = $storeProductModel->quantity[$k];
                $storeProduct->price = $storeProductModel->price[$k];
                $storeProduct->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'storeProductModel' => $storeProductModel,
            'stores' => $stores
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $storeProductModel = new StoreProduct();
        $stores = Store::find()->all();
        $storeProducts = StoreProduct::find()->where(['product_id' => $id])->all();
        if ($model->load(Yii::$app->request->post()) && $model->save() && $storeProductModel->load(Yii::$app->request->post())) {
            StoreProduct::deleteAll(['product_id' => $id]);
            foreach ($storeProductModel->store_code as $k => $v){
                $storeProduct = new StoreProduct();
                $storeProduct->store_code = $v;
                $storeProduct->product_id = $model->id;
                $storeProduct->quantity = $storeProductModel->quantity[$k];
                $storeProduct->price = $storeProductModel->price[$k];
                $storeProduct->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'storeProductModel' => $storeProductModel,
            'stores' => $stores,
            'storeProducts' => $storeProducts
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        StoreProduct::deleteAll(['product_id' => $id]);
        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
