<?php

namespace app\modules\kadastr\controllers;

use Yii;
use yii\web\Controller;
use app\modules\kadastr\components\KadastrParse;
use app\modules\kadastr\models\Kadastr;
use yii\data\ActiveDataProvider;

/**
 * Default controller for the `kadastr` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = new Kadastr();

        if ($model->load(Yii::$app->request->post())) {
            //Yii::$app->session->setFlash('contactFormSubmitted');

           $post = Yii::$app->request->post();

           //debug($post['Kadastr']['cadastral_number']); die;

            $kad_num =  explode(", ", $post['Kadastr']['cadastral_number']);

            /*$kad_id = NULL;

            $kad_num = [0 => "69:27:0000022:1306",
                1 => "69:27:0000022:1307"];*/

            $Kadastr = new KadastrParse($kad_num);

           if ($Kadastr->result != FALSE) {

               Yii::$app->session->setFlash('success', "Добавлены новые кадастровые номера");
           } else {

               Yii::$app->session->setFlash('error', "Номера небыли добавлены");
           }

          //  die();

            return $this->refresh();
        }

        $query = $model->find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'forcePageParam' => false,
                'pageSizeParam' => false,
                'pageSize' => 10
            ]
        ]);

        return $this->render('index', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);

       // return $this->render('index');
    }
}
