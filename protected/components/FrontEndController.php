<?php

class FrontEndController extends BaseController {

    // лейаут
    public $layout = '//layouts/news/article';
    public $metaProperty;
    public $breadcrumbs = array();
    public $menu = array();

    public function addMetaProperty($name, $content) {
        $this->metaProperty .= "<meta property=\"$name\" content=\"$content\" />\r\n";
    }

    public function getMetaProperty() {
        return $this->metaProperty;
    }

}

?>
