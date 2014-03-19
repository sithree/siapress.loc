<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include "yiiapp.php";
Yii::app()->cache->flush();
$modif = Modified::model()->findByPk(1);
$modif->date = date('Y-m-d H:i:s');
$modif->save();

unlink('images/news/main/21031_item.jpg');
unlink('images/news/main/21031_cat.jpg');
unlink('images/news/main/21031_main.jpg');
unlink('images/news/main/21031_home.jpg');

?>
