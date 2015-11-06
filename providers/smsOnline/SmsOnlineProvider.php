<?php

namespace omnilight\sms\receive\provider\smsOnline;

use omnilight\sms\receive\contracts\ProviderInterface;
use omnilight\sms\receive\models\IncomingSms;
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
    private $isError = false;
    /**
     * @var IncomingSms
     */
    private $sms;

    /**
     * Returns type of the provider
     * @return string
     */
    public static function type()
    {
        return 'smsonline';
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function receive(Request $request)
    {
        $this->answer = null;
        $model = new IncomingRequest();
        if ($model->load($request->get(), '') && $model->validate()) {

            $this->sms = $model->toIncomingSms();
            $this->sms->save(false);

            $this->trigger(self::EVENT_RECEIVE_SMS);

            $this->sms->updateAttributes([
                'answer' => $this->answer,
            ]);

            $this->isError = false;
            return $this;
        }
        $this->trigger(self::EVENT_ERROR);
        $this->isError = true;
        return $this;
    }

    /**
     * @return string
     */
    public function answer()
    {
        if ($this->isError) {
            if ($this->answer !== null) {
                return 'utf='.$this->answer;
            }
            return 'utf=Error';
        }

        return $this->answer;
    }

    /**
     * @return IncomingSms
     */
    public function getSms()
    {
        return $this->sms;
    }
}