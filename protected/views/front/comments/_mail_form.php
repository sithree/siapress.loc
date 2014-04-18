<?php
/* @var $model Comment */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Добавлен новый комментарий</title>
    </head>
    <body>
        <p><strong><?php echo $model->object_type_id == 2 ? 'Опрос' : ($model->article->cat_id == 9 ? 'Блог' : 'Новость') ?>:</strong>
            <a href="<?php echo $model->object_type_id == 2 ? 'http://siapress.loc/polls/view?id=' . $model->poll->id : $model->article->link(true); ?>"><?php echo $model->object_type_id == 2 ? $model->poll->title : $model->article->title ?></a><br />
            <strong>Состояние:</strong> <?php echo $model->published == 1 ? 'Опубликовано' : 'Ожидает модерации'; ?><br />
            <strong>Дата:</strong> <?php echo Helper::getFormattedtime($model->created) ?><br />
            <strong>ip:</strong> <?php echo $model->ip; ?>
        </p>

        <p><strong><?php echo ($model->author_id != 0) ? $model->author->name . ' (' . $model->author->username . ')' : $model->name ?>:</strong></p>
        <p><?php echo $model->replace($model->text); ?></p>
        <p>
            <?php
            echo CHtml::link('Бан на сутки', Yii::app()->createAbsoluteUrl('comment/ban', array('id' => $model->id, 'token' => $model->token)));
            echo ' ';
            echo CHtml::link('Нарушает', Yii::app()->createAbsoluteUrl('comment/markBan', array('id' => $model->id, 'token' => $model->token, 'value' => 1)));
            echo ' ';
            echo CHtml::link('Оскорбляет', Yii::app()->createAbsoluteUrl('comment/markBan', array('id' => $model->id, 'token' => $model->token, 'value' => 2)));
            echo ' ';
            echo CHtml::link('Не в тему', Yii::app()->createAbsoluteUrl('comment/markBan', array('id' => $model->id, 'token' => $model->token, 'value' => 3)));
            echo ' ';
            echo CHtml::link('Удалить', Yii::app()->createAbsoluteUrl('comment/markPublished', array('id' => $model->id, 'token' => $model->token, 'value' => 0)));
            ?>
        </p>

        <p><?php echo Helper::trimText($model->article->fulltext, 1000); ?></p>

    </body>
</html>