<?php

namespace omnilight\sms\receive\contracts;
use yii\web\Request;


/**
 * Interface ProviderInterface
 */
interface ProviderInterface
{
    const EVENT_RECEIVE_SMS = 'receiveSms';

    /**
     * @param Request $request
     * @return self
     */
    public function receive(Request $request);
    /**
     * @return mixed
     */
    public function answer();

    /**
     * @return IncomingSms
     */
    public function getSms();
}