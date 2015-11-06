<?php

namespace omnilight\sms\receive\actions;
use omnilight\sms\receive\contracts\ProviderInterface;
use yii\base\Action;


/**
 * Class SmsReceiveAction
 */
class SmsReceiveAction extends Action
{
    public $provider;

    public function run()
    {
        /** @var ProviderInterface $provider */
        $provider = \Yii::createObject($this->provider);
        return $provider->receive(\Yii::$app->request)->answer();
    }
}