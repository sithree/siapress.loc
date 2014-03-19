<?php

class Config
{
    /*
     * Время жизни кеша
     */
    public $_cacheduration = '180';
    public $onpage = '20';

    /*
     * Получение времени жизни кеша
     */
    static function getCacheduration()
    {
        return '180';
    }

    /*
     * Установка кеша
     */
    function setCacheduration($n)
    {
        return $this->_cacheduration = (int) inttostr($n);
    }
    
    static function getOnpage(){
        return 20;
    }
}

?>
