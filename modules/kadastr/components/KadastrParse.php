<?php

namespace app\modules\kadastr\components;
use app\modules\kadastr\models\Kadastr;

class KadastrParse
{
    private $headers = [
        'Host: pkk5.rosreestr.ru',
        'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:70.0) Gecko/20100101 Firefox/70.0',
        'Accept: text/javascript, application/javascript, application/ecmascript, application/x-ecmascript, */*; q=0.01',
        'Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3',
        'Accept-Encoding: gzip, deflate, br',
        'X-Requested-With: XMLHttpRequest',
        'Connection: keep-alive',
        'Referer: https://pkk5.rosreestr.ru/',
        'Cookie: _ga=GA1.1.1320403794.1573548638; _gid=GA1.1.1761512392.1573548638',
    ];

    public $kd_data = NULL;

    public $result = FALSE;

    protected function parse_data($url) {

        $json_data = NULL;

        if(isset($url)) {

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

            $server_output = curl_exec ($ch);

            $json_data = json_decode($server_output);

            curl_close ($ch);
        }

        return $json_data;
    }

    public  function __construct($kad_num) {

       // $result = FALSE;

       foreach ($kad_num as $val) {

           $ids[] = $this->get_kadastr_id($val);
       }

     //   debug($ids);

       $count_id = count($ids);

       foreach ($ids as $id) {

           $this->kd_data[] = $this->get_kadasrt_data($id);
       }

       $kd_data = new Kadastr();

        $this->result = $kd_data->saveDataKd($this->kd_data);

       return $this->result;
    }

    //возвращает кадастр id
    protected function get_kadastr_id($kad_num) {

        $kad_id = NULL;

       $url = "https://pkk5.rosreestr.ru/api/features/1?text=$kad_num&tolerance=4&limit=11";

        $json_data = $this->parse_data($url);

        if ($json_data->total == NULL) {

            foreach ($json_data->features as $val) {

                $kad_id = $val->attrs->id;
            }

        }
      //  curl_close ($ch);

        return $kad_id;

    }

    // тут получаем именно данные по kadasstr_id
    protected function get_kadasrt_data($kad_id) {

        $need = NULL;

        if($kad_id != NULL) {

            $need = array();

            $url = "https://pkk5.rosreestr.ru/api/features/1/$kad_id?&_=1573642042042";

            $json_data = $this->parse_data($url);

            $need['cn'] = $json_data->feature->attrs->cn;

            $need['address'] = $json_data->feature->attrs->address;

            $need['cad_cost'] = $json_data->feature->attrs->cad_cost;

            $need['area_value'] = $json_data->feature->attrs->area_value;
        }

        return $need;
    }

}