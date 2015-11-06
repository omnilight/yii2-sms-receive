<?php

namespace omnilight\sms\receive;

use yii\base\BootstrapInterface;


/**
 * Class Bootstrap
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        $app->i18n->translations['omnilight/phonenumbers'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@omnilight/sms/incoming/messages',
            'sourceLanguage' => 'en-US',
        ];

        \Yii::$app->params['yii.migrations'][] = '@omnilight/sms/receive/migrations';
    }
}