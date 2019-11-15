<?php

namespace app\modules\kadastr\models;
use yii\db;
//use yii\db\Exception;
use Exception;
use Yii;

/**
 * This is the model class for table "kadastr".
 *
 * @property string $id
 * @property string $cadastral_number
 * @property string $address
 * @property double $price
 * @property int $area
 */
class Kadastr extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kadastr';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cadastral_number', 'address', 'price', 'area'], 'required'],
            [['address'], 'string'],
            [['price'], 'number'],
            [['area'], 'integer'],
            [['cadastral_number'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cadastral_number' => 'Кадастровый номер',
            'address' => 'Адрес',
            'price' => 'Цена',
            'area' => 'M²',
        ];
    }

    //метод сохранения кадастровых номеров в базу
    public function saveDataKd($data) {

        $result = FALSE;

            foreach ($data as $val) {

                $kd_num = $val['cn'];
                $kd_address = $val['address'];

                if(isset($kd_num)) {

                $isset_kd = Kadastr::find()->where(['cadastral_number' => $kd_num])->exists();
                $isset_address = Kadastr::find()->where(['address' => $kd_address])->exists();

                if (!$isset_kd || !$isset_address) {
                  //  try {

                        $result =  Yii::$app->db->createCommand()->batchInsert('kadastr', ['cadastral_number', 'address', 'price', 'area'], [
                        [   $val['cn'],
                            $val['address'],
                            $val['cad_cost'],
                            $val['area_value'],
                        ],

                    ])->execute();

                // } catch (ExitException $e) {

                     //$this->end($e->statusCode, isset($response) ? $response : null);

                   //  var_dump($e->statusCode);
                  //      }
                    }
                }
            }

            return $result;
    }
}
