<?php

/* home controller */
class Home extends Controller {

    // index model function when page is accessed
    public function index($params) {
        $this->_view($this->_model('Home', $params));
    }
}