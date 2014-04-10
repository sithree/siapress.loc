<h1 class="title entry-title">Все опросы СИА-ПРЕСС</h1>
<hr />
<?php
foreach ($models as $poll) {
    $this->renderPartial('view', array('model' => $poll, 'head' => 'portlet'));
} ?>
<hr />
<div class="pagination ">
<?php $this->widget('bootstrap.widgets.BootPager', array(
    'pages' => $pages
)); ?>
</div>
