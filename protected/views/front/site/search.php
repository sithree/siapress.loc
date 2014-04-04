<?php
$this->pageTitle = 'Поиск по сайту - ' . Yii::app()->name;
?>
<h1 class="title entry-title">Поиск по сайту</h1>
<hr />
<?php
/** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id' => 'searchForm',
    'type' => 'vertical',
    'method' => 'GET',
    'htmlOptions' => array('class' => 'we1ll'),
        ));
?>
<?php echo $form->textFieldRow($model, 'text', array('class' => 'col-xs-12', 'prepend' => '<i class="icon icon-search"></i>')); ?>
<div class="row">
    <div class="col-xs-6">
        <?php echo $form->dropDownListRow($model, 'category', CHtml::listData(ArticleCategories::model()->findAll(), 'id', 'name'), array('class' => 'col-xs-12', 'prepend' => '<i class="icon icon-book"></i>', 'prompt' => 'Не имеет значения')); ?>
    </div>
    <div class="col-xs-6">
        <?php echo $form->textFieldRow($model, 'author', array('class' => 'col-xs-12', 'prepend' => '<i class="icon icon-user"></i>')); ?>
    </div>
</div>





<?php #echo $form->textFieldRow($model, 'date_start', array('class' => 'input-large', 'prepend' => '<i class="icon icon-calendar"></i>')); ?>
<?php #echo $form->textFieldRow($model, 'date_end', array('class' => 'input-large', 'prepend' => '<i class="icon icon-calendar"></i>')); ?>

<br />
<button name="yt0" type="submit" class="red-button col-xs-5">Искать</button>

<?php // $form->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'label' => 'Искать', 'htmlOptions' => array('class' => 'red-button', 'style' => 'margin-left:auto; float:none;'))); ?>
<div class="clr"> </div>


<?php $this->endWidget(); ?>
<hr />
<?php if (!empty($_GET)): ?>
    <p>Всего найдено: <strong><?php echo count($results); ?> записей</strong></p>
<?php endif; ?>

<?php if (!empty($results)): ?>
    <?php foreach ($results as $item): ?>
        <?php $image = Article::imageSV2($item['id'], $item['title'], 118, 86, true); ?>
        <div class="row news-container">
            <?php if ($image): ?>
                <div class="col-xs-3">
                    <div class="img_container">
                        <?php echo CHtml::link($image, array($category['alias'] . '/' . $item['id'])); ?>
                    </div>
                </div>
            <?php else: ?>
                <?php
                if ($item['cat_id'] == 9) {
                    if (is_file('images/users/blog/' . $item['author'] . '.jpg')):
                        $img = 1;
                        ?>
                        <div class="col-xs-3">
                            <div class="img_container">
                                <?php echo CHtml::link('<img src="images/users/blog/' . $item['author'] . '.jpg" alt="Блог" />', array('news/' . $category['alias'] . '/' . $item['id'])); ?>
                            </div>
                        </div>
                        <?php
                    endif;
                }
                ?>
            <?php endif; ?>
            <div class="col-xs-<?php echo ($image or is_file('images/users/blog/' . $item['author'] . '.jpg')) ? 9 : 12 ?>">
                <h2><?php echo CHtml::link($item['title'] . '<br />', array('news/' . $item['id'])); ?></h2>
                <p><?php echo $item['introtext']; ?></p>

            </div>

        </div>
        <footer class="row fbottom clearfix">

            <div class="col-xs-8"><?php // echo $item->author_alias ? $item->author_alias : $item->author0->name          ?>
                <nobr><span class="nowrap"><?php echo Helper::getFormattedtime($item['created'], false, true); ?></span></nobr>
            </div>
            <div class="col-xs-4 a-right">
                <i class="fa fa-eye"></i> <?php echo $item->articleAdd->hits; ?> <i class="fa fa-comment"></i> <?php echo count($item->comments) ?>            </div>

        </footer>
    <?php endforeach; ?>
<?php endif; ?>