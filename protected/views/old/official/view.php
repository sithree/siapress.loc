<?php
$this->breadcrumbs = array(
    'Articles' => array('index'),
    $model->title,
);

$comments = Comment::model()->getAllComments($model['id']);
#CVarDumper::dump($model);
$this->setPageTitle($model['title'] . ' — ' . Article::model()->getCategoryFullname($model['cat_id'])); #; . Yii::app()->name);
?>

<?php
echo CHtml::tag('h1', array('class' => 'title'), $model['title'] . ' ' . CHtml::link('', array('news/'), array('class' => 'icon icon-print', 'title' => 'Версия для печати'))
);
?>
<?php echo (mb_strlen($model['introtext']) > 10) ? CHtml::tag('h3', array('class' => 'introtext'), $model['introtext']) : ""; ?>

<hr />
<?php echo Article::model()->getArticleimage($model); ?>


<?php echo CHtml::tag('div', array('class' => 'fulltext'), $model['fulltext']); ?>
<?php echo CHtml::tag('div', array('class' => 'authorbottom'), Article::model()->getArticleauthor($model)); ?>
<hr />
Просмотров: <?php echo $model['hits']; ?>, комментариев: <?php echo $model['comment_count'] ?>
<hr />

<a id="comments"></a>
<?php if ($model['comment_count'] > 0): ?>
    <h3 style="margin-bottom: 15px;">Комментарии: <a title="Подписаться на RSS - ленту комментариев этой новости" href="#"><span class="label label-warning">RSS</span></a></h3>
<?php else: ?>
    <h3 style="margin-bottom: 15px;">Комментариев пока нет.</h3>
<?php endif; ?>
<?php
if (count($comments > 0)) {
    foreach ($comments as $comment):
        ?>
        <div class="comment <?php echo $comment['level']>0 ? "comment-inner-" . $comment['level'] : '' ?>">
            <div class="comment-ava">
                <a href="#" title="Перейти на страницу профиля">
                    <img src="images/users/noava.jpg" alt="Стрельцов Иван" />
                </a>
            </div>
            <div class="comment-says">
                <span class="comment-date"><?php echo Helper::getFormattedtime($comment['created']) ?></span>
                <a href="#comment-<?php echo $comment['id'] ?>"><?php echo $comment['name']; ?></a> пишет:
            </div>
            <div class="comment-inner">
                <?php echo $comment['published'] == 0 ? 'Комментарий удален модератором.' : Comment::model()->replace($comment['text']); ?>
                <div class="comment-add">
                    <a href="#">Ответить</a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="#">Комментировать</a>&nbsp;&nbsp;&nbsp;&nbsp;
                    <!-- <a href="#">Пожаловаться</a> -->
                </div>
            </div>
        </div>
        <?php
    endforeach;
}
?>
<br />
<a id="addcomment"></a>
<h4>Оставить комментарий</h4>
<br />
<div class="alert alert-error">
    Вы заполнили не все поля.
</div>
<div class="well">
    <div class="row-fluid">
        <div class="span8">
            <div class="row-fluid">
                <div class="span6">
                    <input type="text" class="span12" placeholder="Ваше имя" />
                </div>
                <div class="span6">
                    <input type="text" class="span12" placeholder="Ваше email" />
                </div>
            </div>
            <div class="row-fluid" style="margin-bottom: 3px;">
                <div class="span12">
                    <?php
                    $this->widget('bootstrap.widgets.BootButtonGroup', array(
                        'buttons' => array(
                            array('label' => '', 'url' => '#', 'icon' => 'align-left',
                                'htmlOptions' => array('title' => 'Выравнивание по левому краю')),
                            array('label' => '', 'url' => '#', 'icon' => 'align-center',
                                'htmlOptions' => array('title' => 'Выравнивание по центру')),
                            array('label' => '', 'url' => '#', 'icon' => 'align-right',
                                'htmlOptions' => array('title' => 'Выравнивание по правому краю')),
                            array('label' => '', 'url' => '#', 'icon' => 'italic',
                                'htmlOptions' => array('title' => 'Курсив')),
                            array('label' => '', 'url' => '#', 'icon' => 'bold',
                                'htmlOptions' => array('title' => 'Жирный')),
                            array('label' => '', 'url' => '#', 'icon' => 'picture',
                                'htmlOptions' => array('title' => 'Вставить картинку')),
                            array('label' => '', 'url' => '#', 'icon' => 'comment',
                                'htmlOptions' => array('title' => 'Вставить цитату')),
                        ),
                    ));
                    ?>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <textarea class="span12" rows="4" placeholder="Текст комментария" >dfdf</textarea>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span4">
                    <input type="text" class="span12" placeholder="Код с картинки" />
                </div>
                <div class="span3">
                    234324
                </div>
                <div class="span5">
                    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'icon' => 'ok white', 'label' => 'Отправить', 'htmlOptions' => array('class' => 'span12 btn-danger'))); ?>
                </div>
            </div>
        </div>
        <div class="span4" style="font-size:11px;">
            <hr />

            <p style="font-size: 11px;"><span class="label label-important">Внимание!</span> Комментарий может быть удален модератором без предупреждения, объяснения причин, даже просто потому, что он ему не понравился.</p>
            <p style="font-size: 11px;">Пожалуйста, ознакомьтесь с <a href="rules">правилами сайта</a>.</p>
            <hr />
        </div>
    </div>
</div>
<hr />
