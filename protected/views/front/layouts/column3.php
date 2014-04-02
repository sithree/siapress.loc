<?php

if ($this->beginCache("Blogs_1", array('dependency' => array(
                'class' => 'system.caching.dependencies.CDbCacheDependency',
                'sql' => 'SELECT MAX(id) FROM sia_articles')))) {
?>
    <?php $this->widget('application.components.widgets.Blogs_1'); ?>
    <?php $this->endCache();
}
    ?>