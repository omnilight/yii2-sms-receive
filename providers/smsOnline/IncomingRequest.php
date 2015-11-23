<?php

namespace omnilight\sms\receive\providers\smsOnline;
use omnilight\sms\receive\models\IncomingSms;
use yii\base\Model;


/**
 * Class IncomingRequest
 */
class IncomingRequest extends Model
{
    public $pref;
    public $txt;
    public $tid;
    public $cn;
    public $op;
    public $phone;
    public $sn;

    public function rules()
    {
        return [
            [['pref', 'txt', 'tid', 'cn', 'op', 'phone', 'sn'], 'required'],
            [['pref', 'txt', 'tid', 'cn', 'op', 'phone', 'sn'], 'string'],
        ];
    }


    /**
     * @return IncomingSms
     */
    public function toIncomingSms()
    {
        $model = new IncomingSms();
        $model->prefix = $this->pref;
        $model->text = $this->txt;
        $model->operator = $this->op;
        $model->phone_mobile_local = '+'.$this->phone;
        $model->received_on_number = $this->sn;
        $model->provider = SmsOnlineProvider::type();
        $model->provider_transaction_id = $this->tid;

        return $model;
    }
}