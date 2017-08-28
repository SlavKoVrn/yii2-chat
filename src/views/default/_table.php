<div class="table-responsive"> 
<table class="table table table-striped table-bordered table-hover table-condensed">
    <caption><h3><?= Yii::t('chat','Chat') ?></h3></caption>
    <thead>
        <tr class="success">
           <th style="width:20%"><?= Yii::t('chat','Time') ?></th>
           <th style="width:10%"><?= Yii::t('chat','Icon') ?></th>
           <th style="width:20%"><?= Yii::t('chat','Username') ?></th>
           <th><?= Yii::t('chat','Message') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($messages as $message) : ?>
        <tr>
            <td><?= $message['rfc822'] ?></td>
            <td>
                <img src="<?= $message['icon'] ?>" width="50px" />
            </td>
            <td><?= $message['name'] ?></td>
            <td><?= $message['message'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
