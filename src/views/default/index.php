<?php
use slavkovrn\chat\ChatAsset;
$assets = ChatAsset::register($this); 
?>
<div class="chat-default-index content">
    <div class="row">
        <div id="chat-box" class="col-sm-12">
            <?= $this->render('_table',compact('messages')) ?>
        </div>
<?php if (Yii::$app->user->isGuest) :?>
        <div id="chat-box" class="col-sm-12">
            <h2><?= Yii::t('chat','Register to take part in chat') ?></h2>
        </div>
<?php else :?>

        <div class="col-sm-12">
            <div class="table-responsive"> 
            <table class="table table table-striped table-bordered table-hover table-condensed">
                <caption><h3><?= Yii::t('chat','Current user') ?></h3></caption>
                <thead>
                    <tr class="success">
                       <th style="width:10%"><?= Yii::t('chat','Icon') ?></th>
                       <th style="width:20%"><?= Yii::t('chat','Username') ?></th>
                       <th><?= Yii::t('chat','Message') ?></th>
                       <th style="width:20%"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <img src="<?= $user->chaticon ?>" width="50px" />
                        </td>
                        <td>
                            <?= $user->chatname ?>
                        </td>
                        <td>
                            <textarea id="chat-message" class="form-control" aria-invalid="false"></textarea>
                        </td>
                        <td>
                            <img id="ajax-loader" src="<?= $assets->baseUrl.'/images/loader.gif' ?>" style="display:none" />
                            <button type="submit" id="send-message" class="btn btn-success" data-id="<?= $user->id ?>" data-name="<?= $user->chatname ?>" data-icon="<?= $user->chaticon ?>" >
                                <?= Yii::t('chat','Send message') ?>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
<?php endif; ?>
    </div>
</div>
<?php
$script=<<<SCRIPT
function reloadchat(button,sendMessage) {
    if (sendMessage)
        $('#ajax-loader').show();
    $.ajax({
        url: '/chat/default/send-message',
        type: "POST",
        data: {
            'sendMessage':sendMessage,
            'ChatModel[user_id]': $(button).data('id'),
            'ChatModel[name]': $(button).data('name'),
            'ChatModel[icon]': $(button).data('icon'),
            'ChatModel[message]': $('#chat-message').val(),
        },
        success: function (html) {
            if (sendMessage)
            {
                $('#ajax-loader').hide();
                $('#chat-message').val('')
            }
            $("#chat-box").html(html);
        }
    });
}
$('#send-message').click(function(){
    reloadchat(this,true);
});
setInterval(function () { reloadchat(null,false); }, 5000 );
SCRIPT;
$this->registerJs($script,$this::POS_READY);
?>
