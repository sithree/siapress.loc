<?php
$this->pageTitle = 'Поиск по сайту - ' . Yii::app()->name;
?>
<h1>Поиск по сайту</h1>
<hr />
<?php #print_r($results) ?>

<?php
/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id' => 'searchForm',
    'type' => 'horizontal',
    'method' => 'GET',
    'htmlOptions' => array('class' => 'we1ll'),
        ));
?>
<?php echo $form->textFieldRow($model, 'text', array('class' => 'input-large', 'prepend' => '<i class="icon icon-search"></i>')); ?>
<?php echo $form->dropDownListRow($model, 'category', CHtml::listData(ArticleCategories::model()->findAll(), 'id', 'name'), array('class' => 'input-large', 'prepend' => '<i class="icon icon-book"></i>', 'prompt' => 'Не имеет значения')); ?>
<?php echo $form->textFieldRow($model, 'author', array('class' => 'input-large', 'prepend' => '<i class="icon icon-user"></i>')); ?>
<?php #echo $form->textFieldRow($model, 'date_start', array('class' => 'input-large', 'prepend' => '<i class="icon icon-calendar"></i>')); ?>
<?php #echo $form->textFieldRow($model, 'date_end', array('class' => 'input-large', 'prepend' => '<i class="icon icon-calendar"></i>')); ?>
<hr />
<div class="row-fluid" style="text-align: center;">
    <?php $form->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'icon' => 'search white', 'label' => 'Искать', 'htmlOptions' => array('class' => 'span5 btn-danger', 'style' => 'margin-left:auto; float:none;'))); ?>
    <div class="clr"> </div>

</div>
<?php $this->endWidget(); ?>
<hr />
<?php if (!empty($_GET)): ?>
    <p>Всего найдено: <strong><?php echo count($results); ?> записей</strong></p>
<?php endif; ?>

<?php if (!empty($results)): ?>
    <?php foreach ($results as $result): ?>
        <div id="mainnewslist" class="row-fluid">
            <?php if (Article::model()->getImgpath($result->id, '', true, false, '_cat')): ?>
                <div class="span3">
                    <a class="thumbnail margin" href="<?php echo Article::model()->getArticlestriplink($result); ?>">
                        <div style="width:100%; height: 86px; background: url(<?php echo Article::model()->getImgpath($result->id, '', true, false, '_cat') ?>) no-repeat center center"></div>
                    </a>
                </div>
                <div class="span9">

                    <h3>
                        <a class="main-news-link" href="<?php echo Article::model()->getArticlestriplink($result); ?>">
                            <?php echo trim($result->title); ?>
                        </a>
                    </h3>
                    <ul class="unstyled" style="font-size:12px; ">
                        <li>Рубрика: <?php echo $result->category->name ?></li>
                        <li>Автор: <?php echo ($result->author_alias) ? $result->author_alias : $result->author0->name ?></li>
                        <li>Дата: <?php echo Helper::getFormattedtime($result->created, false, false) ?></li>
                    </ul>
                </div>
            <?php else: ?>
                <div class="span12">

                    <h3>
                        <a class="main-news-link" href="<?php echo Article::model()->getArticlestriplink($result); ?>">
                            <?php echo trim($result->title); ?>
                        </a>
                    </h3>
                    <ul class="unstyled" style="font-size:12px; ">
                        <li>Рубрика: <?php echo $result->category->name ?></li>
                        <li>Автор: <?php echo ($result->author_alias) ? $result->author_alias : $result->author0->name ?></li>
                        <li>Дата: <?php echo Helper::getFormattedtime($result->created, false, false) ?></li>
                    </ul>
                </div>
            <?php endif; ?>

        </div>
    <?php endforeach; ?>
<?php endif; ?>