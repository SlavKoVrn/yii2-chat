<?php

namespace slavkovrn\chat;

use yii\web\AssetBundle;

/**
 * Module asset bundle
 */
class ChatAsset extends AssetBundle
{
	/**
	 * @inheritdoc
	 */
	public $sourcePath = '@slavkovrn/chat/assets';

    public $css = [
        'images/images.css'
    ];

} 