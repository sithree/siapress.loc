<?php

class Helper {
    /*
     * Делаем ссылки на новости более красивые, выделяе ссоыку в конце заголовка
     */

    public static function getLink($model) {

        $text = trim(str_replace("\n", "", $model['title']));
        $word = explode(' ', $text);
        $count = count($word);
        $c = $count - ceil($count / 35 * 10);
        $pos = stripos($model['title'], $word[$c - 1]);

        $sub = substr($model['title'], $pos, strlen($model['title']));

        $sub2 = CHtml::link($sub, array('news/' . Article::model()->getCategoryAlias($model['cat_id']) . '/' . $model['id']));

        return str_replace($sub, $sub2, $model['title']);
    }

    public static function getLight($model) {

        $text = trim(str_replace("\n", "", $model['title']));
        $word = explode(' ', $text);
        $count = count($word);
        $c = $count - ceil($count / 35 * 10);
        $pos = stripos($model['title'], $word[$c - 1]);

        $sub = substr($model['title'], $pos, strlen($model['title']));

        $sub2 = '<span class="redlight">'.$sub.'</span>'; //CHtml::link($sub, array('news/' . Article::model()->getCategoryAlias($model['cat_id']) . '/' . $model['id']));

        return str_replace($sub, $sub2, $model['title']);
    }

    public static function getFormattedtime($dtime = false, $format = false, $timezone = false) {
        if ($timezone)
            $timezone = ' [Сургут]';
        if ($dtime)
            $date = strtotime($dtime);
        else
            $date = strtotime(date('Y-m-s h:i:s'));
        if ($format !== false) {
            if ($dtime !== false)
                return date($format, $date) . $timezone;
            else
                return date($format) . $timezone;
        }

        $mount = array('01' => 'января', '02' => "февраля",
            "03" => "марта",
            "04" => "апреля",
            "05" => "мая",
            "06" => "июня",
            "07" => "июля",
            "08" => "августа",
            "09" => "сентября",
            "10" => "октября",
            "11" => "ноября",
            "12" => "декабря",
        );


        if (date('Y', $date) == date('Y'))
            $year = "";
        else
            $year = date('Y', $date);


        if (date('Y-m-d') == date('Y-m-d', $date)) {
            return 'Сегодня в ' . date('H:i', $date) . $timezone;
        } else
            return date('d', $date) . ' ' . $mount[date('m', $date)] . ' ' . $year
                    . ' в ' . date('H:i', $date)  . $timezone;
    }

    public static function getDuration() {
        return $this->_cacheDuration;
    }

    /*
     * @
     */
    public static function trimText($text, $len = 100, $punctuation = false) {
        $text = strip_tags($text);
        $len2 = mb_strlen($text, 'utf-8');

        return $len > $len2 ? $text : mb_strimwidth($text, 0, $len + 3, '...', 'utf-8');
    }
}

?>
