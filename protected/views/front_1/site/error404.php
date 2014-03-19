<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<h2>Страница не найдена!</h2>

<div class="error">
<p>Такой страницы не существует или неправильно набран адрес страницы.</p>

<p><?php  echo CHtml::link('Главная страница', '/'); ?><br />
<?php  echo CHtml::link('Карта сайта', '/'); ?></p>
</div>