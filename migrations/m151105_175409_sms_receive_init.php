<?php

use yii\db\Schema;

class m151105_175409_sms_receive_init extends \yii\db\Migration
{
	public function up()
	{
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			$tableOptions = 'ENGINE=InnoDB CHARSET=utf8';
		}

		$this->createTable('{{%incoming_sms}}', [
			'id' => $this->primaryKey(),
			'provider' => $this->string(),
			'phone_mobile' => $this->string(),
			'prefix' => $this->string('8'),
			'text' => $this->string(),
			'operator' => $this->string(),
			'received_on_number' => $this->string(),
			'provider_transaction_id' => $this->string(),
			'answer' => $this->string(),
			'created_at' => $this->dateTime(),
		], $tableOptions);
	}

	public function down()
	{
		$this->dropTable('{{%incoming_sms}}');
	}
}
