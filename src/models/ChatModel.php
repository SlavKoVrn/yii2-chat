<?php

namespace slavkovrn\chat\models;

use Yii;

/**
 * This is the model class for table "{{%chat}}".
 *
 * @property string $id
 * @property string $user_id
 * @property string $time
 * @property string $rfc822
 * @property string $message
 */
class ChatModel extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%chat}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','user_id','time'], 'integer'],
            [['rfc822'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 255],
            [['icon'], 'string', 'max' => 255],
            [['message'], 'string'],
            [['name','icon','message'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('chat', 'Name'),
            'icon' => Yii::t('chat', 'Icon'),
            'message' => Yii::t('chat', 'Message'),
        ];
    }

    public static function getMessages($numberLastMessages)
    {
        $messages = self::find()
            ->orderBy('time DESC')
            ->limit($numberLastMessages)
            ->all();
        $out=[];
        foreach ($messages as $message)
        {
            $out[$message['time']]=[
                    'rfc822' => $message['rfc822'],
                    'name' => $message['name'],
                    'icon' => $message['icon'],
                    'message' => $message['message'],
                ];
        }
        ksort($out);
        return $out;
    }
}
