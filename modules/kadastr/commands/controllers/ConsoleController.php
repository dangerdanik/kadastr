<?php

namespace app\modules\kadastr\commands\controllers;

use app\modules\kadastr\components\KadastrParse;
use app\modules\kadastr\models\Kadastr;
use yii\console\widgets\Table;

class ConsoleController extends \yii\console\Controller
{
    public function actionIndex($kc_numbs = FALSE)
    {
        $model = new Kadastr();

        if ($kc_numbs) {

            $kad_num = explode(",", $kc_numbs);

            $Kadastr = new KadastrParse($kad_num);
        }

            $sql = "SELECT * FROM kadastr";

            $query = $model->findbysql($sql)->asArray()->all();

            // var_dump($query);

            foreach ($query as $key => $val) {

                $cn[$key] = $val['cadastral_number'];

                $address[$key] = $val['address'];

                $price[$key] = $val['price'];

                $area[$key] = $val['area'];

            }

            //  print_r($cn); //die;

            echo Table::widget([
                'headers' => ['CN', 'address', 'price', 'area'],

                'rows' => [
                    [$cn, $address, $price, $area],

                ],
            ]);

    }
}
