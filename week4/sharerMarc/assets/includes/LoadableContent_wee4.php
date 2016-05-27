<?php
///**
// * Created by PhpStorm.
// * User: Nomad_Mystic
// * Date: 4/25/2016
// * Time: 11:09 PM
// */
//
//class LoadableContent
//{
//    public $js = '';
//    public $html = '';
//    public $css = '';
//
//    function __construct($js, $html, $css)
//    {
//        $this->js = $js;
//        $this->html = $html;
//        $this->css = $css;
//    }
//
//    // Send the content of this object back to javascript
//    public function load()
//    {
//        header('Content-Type: application/json');
//        echo json_encode($this);
//    }
//}