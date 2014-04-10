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

<div class="row">
    <div class="col-xs-6">
        <a class="gray-button" href="/news">Больше новостей</a>
    </div>

    <div class="col-xs-6">
        <a class="red-button" href="/news/send">Отправить новость</a>
    </div>
</div>
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