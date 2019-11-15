<?php

namespace app\modules\kadastr;

use Yii;
use yii\base\Application;

/**
 * kadastr module definition class
 */
class Module extends \yii\base\Module implements \yii\base\BootstrapInterface
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\kadastr\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
     //   $this->module = Yii::$app->getModule('kadastr');
        parent::init();

      /*  if (Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'app\modules\kadastr\commands\dan';
        }*/
    }

    public function bootstrap($app)
    {
        if ($app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'app\modules\kadastr\commands\controllers';
        }
    }
    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */

}
