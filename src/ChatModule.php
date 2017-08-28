<?php

namespace slavkovrn\chat;

use Yii;
use yii\i18n\PhpMessageSource;

/**
 * chat module definition class
 */
class ChatModule extends \yii\base\Module
{
	public $table = 'chat';
    public $numberLastMessages = 22;

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'slavkovrn\chat\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->registerTranslations();

		$this->checkTable();

       // custom initialization code goes here
    }

    protected function registerTranslations()
    {
        Yii::$app->get('i18n')->translations['chat'] = [
            'class' => PhpMessageSource::class,
            'basePath' => __DIR__ . '/messages',
            'sourceLanguage' => (isset(Yii::$app->language))?Yii::$app->language:'en',
            'forceTranslation' => true,
        ];
    }

	protected function checkTable()
	{
        if (isset(Yii::$app->db->schema->db->tablePrefix))
            $this->table = Yii::$app->db->schema->db->tablePrefix.$this->table;
        
		if (Yii::$app->db->schema->getTableSchema($this->table, true) === null) {
			Yii::$app->db->createCommand()
                ->createTable(
                    $this->table,
    				array(
    					'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY',
    					'user_id' => 'int(10) unsigned DEFAULT NULL',
    					'time' => 'int(10) unsigned DEFAULT NULL',
    					'rfc822' => 'varchar(50) DEFAULT NULL',
    					'name' => 'varchar(255) DEFAULT NULL',
    					'icon' => 'varchar(255) DEFAULT NULL',
    					'message' => 'text',
    				),
                    'ENGINE=InnoDB DEFAULT CHARSET=utf8'
                )
                ->execute();
		}
	}
}
