<?php

namespace omnilight\sms\receive\contracts;

use omnilight\sms\receive\models\IncomingSms;
use yii\web\Request;


/**
 * Interface ProviderInterface
 */
interface ProviderInterface
{
    /**
     * When sms received
     */
    const EVENT_RECEIVE_SMS = 'receiveSms';
    /**
     * When error happens during receiving of sms
     */
    const EVENT_ERROR = 'error';

    /**
     * Returns type of the provider
     * @return string
     */
    public static function type();

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