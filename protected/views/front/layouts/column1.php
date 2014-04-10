<?php
//die("<p>" . Article::getCacheDependency('MainNews') . "</p>");
if ($this->beginCache("MainNews", array('dependency' => array(
                'class' => 'system.caching.dependencies.CExpressionDependency',
                'expression' =>"Article::getCacheDependency('MainNews')")))) {
    ?>
    <?php $this->widget('application.components.widgets.MainNews'); ?>
    <?php
    $this->endCache();
}
?>


        <a class="gray-button" href="/news">Больше новостей</a>

<?php
if ($this->beginCache("Officials", array('dependency' => array(
                'class' => 'system.caching.dependencies.CExpressionDependency',
                'expression' =>"Article::getCacheDependency('Officials')")))){
    ?>
    <?php $this->widget('application.components.widgets.official'); ?>
    <?php
    $this->endCache();
}
?>

<?php

    $this->widget('EPoll');

?>

<a href="/polls" class="gray-light-button">Больше опросов</a>