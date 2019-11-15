<?php
 use Yii;

 use app\modules\kadastr\components\KadastrParse;



class TestCest
{
   /* public function _before(UnitTester $I)
    {
    }

    public function _after(UnitTester $I)
    {
    }*/

    // tests
    //тест класса парснинга
    public function tryToTest(UnitTester $I)
    {
        $kad_num = [0 => "69:27:0000022:1306", 1 => "69:27:0000022:1307"];

        $objKadastr = new KadastrParse($kad_num);

        $arr = array_shift($objKadastr->kd_data);

       print_r($arr); //die;

       $I->assertNotEmpty($arr);
    }
}
