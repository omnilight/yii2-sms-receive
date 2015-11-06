<?php

namespace omnilight\sms\receive\actions;
use omnilight\sms\receive\contracts\ProviderInterface;
use yii\base\Action;
use yii\base\Component;
use yii\base\Event;


/**
 * Class SmsReceiveAction
 */
class SmsReceiveAction extends Action
{
    /**
     * @var array | string
     */
    public $provider;
    /**
     * @var Callable
     */
    public $receiveSms;
    /**
     * @var Callable
     */
    public $error;

    public function run()
    {
        /** @var ProviderInterface | Component $provider */
        $provider = \Yii::createObject($this->provider);
        $this->attachHandlers($provider);
        return $provider->receive(\Yii::$app->request)->answer();
    }

    /**
     * @param ProviderInterface $provider
     */
    private function attachHandlers(ProviderInterface $provider)
    {
        if (!($provider instanceof Component)) {
            return;
        }
        /** @var Component $provider */
        if ($this->receiveSms !== null) {
            $provider->on(ProviderInterface::EVENT_RECEIVE_SMS, $this->receiveSms);
        }
        if ($this->error !== null) {
            $provider->on(ProviderInterface::EVENT_ERROR, $this->error);
        }
    }
}