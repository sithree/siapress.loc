<?php

return CMap::mergeArray(
                require_once(dirname(__FILE__) . '/main.php'), array(
            'components' => array(
                'bootstrap' => array(
                    'class' => 'ext.bootstrapNew.components.Bootstrap', // assuming you extracted bootstrap under extensions
                    'enableJS' => true,
                    'coreCss' => true,
                    'responsiveCss' => false,
                ),
                'defaultController' => 'article',
//                'cache' => array(
//                    'class' => 'system.caching.CDummyCache',
//                ),
                'log' => array(
                    'class' => 'CLogRouter',
                    'routes' => array(
                    ),
                ),
                // Defaults to Widgets
                'widgetFactory' => array(
                    'widgets' => array(
                        'ERedactorWidget' => array(
                            'options' => array(
                                'lang' => 'ru',
                                'removeStyles' => true,
                                'removeClasses' => true,
                                'buttons' => array(
                                    'formatting', '|', 'quote', '|', 'bold', 'italic', 'deleted', 'underline', '|',
                                    'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
                                    'image', 'video', 'table', 'link', '|',
                                    'alignleft', 'aligncenter', 'alignright', 'justify', '|',
                                    'html',
                                ),
                                'toolbarFixed' => true,
                                'toolbarFixedTopOffset' => 40,
                                'fixedBox' => true,
                                'linkNofollow' => true,
                                'tidyHtml' => false,
                                'buttonsCustom' => array(
                                    "quote" => array(
                                        'title' => 'Цитировать',
                                        'callback' => new CJavaScriptExpression(
                                                "
                                                  
function(buttonName, buttonDOM, buttonObject) {

    var current = this.getCurrent();

    if (!$(current).hasClass('quote')) 
        this.inlineSetClass('quote');
    else {
        text = $(current).text();
        this.selectionSave();
        $(current).remove();
        this.selectionRestore();
        this.sync();    
        this.insertText(text);
    }
                              
                            }"
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
                )
);
?>
