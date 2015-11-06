<?php

namespace omnilight\sms\receive\provider\smsOnline;

use omnilight\sms\receive\contracts\IncomingSms;
use omnilight\sms\receive\contracts\ProviderInterface;
use yii\base\Component;
use yii\web\Request;


/**
 * Class SmsOnlineProvider
 */
class SmsOnlineProvider extends Component implements ProviderInterface
{
    /**
     * @var string
     */
    public $answer = '';
    /**
     * @var bool
     */
    public $isError = false;

    /**
     * @param Request $request
     * @return bool
     */
    public function receive(Request $request)
    {
        $model = new IncomingRequest();
        if ($model->load($request->get(), '') && $model->validate()) {

            $sms = $model->toIncomingSms();
            $sms->save(false);

            $this->trigger(self::EVENT_RECEIVE_SMS);

            $sms->updateAttributes([
                'answer' => $this->answer,
            ]);

            $this->isError = false;
            return $this;
        }
        $this->isError = true;
        return $this;
    }

    /**
     * @return string
     */
    public function answer()
    {
        if ($this->isError) {
            return 'utf=Error';
        }

        return $this->answer;
    }

    /**
     * @return IncomingSms
     */
    public function getSms()
    {

    }
}