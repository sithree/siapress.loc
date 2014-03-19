<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class MPagination2 {
    /*
     * Количество выводимых объектов на страницу
     */

    public $limit = 15;
    public $onpage = 10;

    public function __construct($count, $page) {

        $a = ceil($count / $this->limit); //Всего страниц
        $now = $page; //Текущая страница

        echo '    <div class="pagination ">
    <ul>
    <li class="disabled"><a href="#">Prev</a></li>
    <li class="active"><a href="#">1</a></li>
    ...
    </ul>
    </div>';

        #echo $now;
        if ($count / $this->limit > 1) {
            echo "<div style='text-align: right;' class='btn-toolbar'>\r\n<div class=\"btn-group\">";

            //Если мы не на первой записи, выводим ←
            if ($now > 1) {
                echo CHtml::link('←', array("news/" . $catalias . '/page/' . ($now - 1)), array('class' => 'btn', 'rel' => 'nofollow')) . " ";
                echo "</div><div class='btn-group'>";
            }
            //Если текущая страница больше трех выводим точки ...
            if (($now - 3) > 1) {
                echo "</div><div class='btn-group'>";
                echo CHtml::tag('span', array('class' => 'btn'), "...");
                echo "</div><div class='btn-group'>\r\n";
            }

            for ($index = 1; $index <= $this->onpage; $index++) {
                //если мы смотрим дальше третьей страницы
                if ($now - 3 > 1) {
                    
                }
                if ($now != $index)
                    echo CHtml::link($index, array("news/" . $catalias . '/page/' . $index), array('class' => 'btn', 'rel' => 'nofollow')) . " ";
                else
                    echo CHtml::tag('span', array('class' => 'btn active'), $index);
            }

            //Выводим ... если до конца еще больше двух страниц
            if (($a - 2) > $now) {
                echo "</div><div class='btn-group'><span class='btn'>...</span>";
                echo "</div><div class='btn-group'>\r\n";
                echo CHtml::link($a, array("news/" . $catalias . '/page/' . $a), array('class' => 'btn', 'rel' => 'nofollow')) . " ";
            }

            //Если не в конце, добавляем →
            if ($a != $now) {
                echo "</div><div class='btn-group'>";
                echo CHtml::link('→', array("news/" . $catalias . '/page/' . ($now + 1)), array('class' => 'btn', 'rel' => 'nofollow')) . " ";
                #echo "</div><div class='btn-group'>\r\n";
            } else {
                echo "</div><div class='btn-group'><span class='btn'>...</span>";
                echo "</div><div class='btn-group'>\r\n";
                echo CHtml::tag('span', array('class' => 'btn active'), $now);
            }


            echo "</div></div>";
        }
        else
            return false;
    }

    /*
     * Получение количества выводимых объектов на страницу
     */

    static public function getLimit() {
        return self::$limit;
    }

    /*
     * Установка количества выводимых объектов на страницу
     */

    static public function setLimit($l) {
        return self::$limit = $l;
    }

}