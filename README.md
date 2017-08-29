# Chat for registered users module for Yii 2.0 Framework advanced template

The Yii2 extension module to chat for registered users using User model of advanced template.

[Log visitor demo page](http://yii2.kadastrcard.ru/chat)

![Log visitor](http://yii2.kadastrcard.ru/uploads/chat.jpg)

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run:

```bash
composer require slavkovrn/yii2-chat
```

or add

```bash
"slavkovrn/yii2-chat": "*"
```

to the require section of your `composer.json` file.

Usage
-----

1.add link to ChatModule in your config

```php
return [
    'modules' => [
        'chat' => [
            'class' => 'slavkovrn\chat\ChatModule',
            'numberLastMessages' => 30,
        ],
    ],
]; 
```
2. in your User model you should define two getters for name and link to icon of registered User

in my case that's

```php
namespace app\models;
...
use app\models\Profile;
class User extends ActiveRecord implements IdentityInterface
{
    public function getChatname()
    {
        return Profile::find()->where(['id' => Yii::$app->user->id])->one()['name'];
    }
 
    public function getChaticon()
    {
        return Profile::find()->where(['id' => Yii::$app->user->id])->one()['photo'];
    }
    ...
```

and now you can chat with registered users via http://yoursite.com/chat url

<a href="mailto:slavko.chita@gmail.com">write comments to admin</a>
