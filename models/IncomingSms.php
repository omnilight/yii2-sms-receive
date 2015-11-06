<?php

namespace omnilight\sms\receive\models;

use omnilight\phonenumbers\PhoneNumberBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%incoming_sms}}".
 *
 * @property integer $id
 * @property string $provider
 * @property string $phone_mobile
 * @property string $prefix
 * @property string $text
 * @property string $operator
 * @property string $received_on_number
 * @property string $provider_transaction_id
 * @property string $answer
 * @property string $created_at
 */
class IncomingSms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%incoming_sms}}';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()'),
                'updatedAtAttribute' => null,
            ],
            'phonenumbers' => [
                'class' => PhoneNumberBehavior::class,
                'defaultRegion' => 'RU',
                'attributes' => [
                    'phone_mobile_local' => 'phone_mobile',
                ]
            ]
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['provider', 'phone_mobile', 'text', 'operator', 'received_on_number', 'provider_transaction_id', 'answer'], 'string', 'max' => 255],
            [['prefix'], 'string', 'max' => 8],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('omnilight/incoming-sms', 'ID'),
            'provider' => Yii::t('omnilight/incoming-sms', 'Provider'),
            'phone_mobile' => Yii::t('omnilight/incoming-sms', 'Phone Mobile'),
            'prefix' => Yii::t('omnilight/incoming-sms', 'Prefix'),
            'text' => Yii::t('omnilight/incoming-sms', 'Text'),
            'operator' => Yii::t('omnilight/incoming-sms', 'Operator'),
            'received_on_number' => Yii::t('omnilight/incoming-sms', 'Received On Number'),
            'provider_transaction_id' => Yii::t('omnilight/incoming-sms', 'Provider Transaction ID'),
            'answer' => Yii::t('omnilight/incoming-sms', 'Answer'),
            'created_at' => Yii::t('omnilight/incoming-sms', 'Created At'),
        ];
    }
}
