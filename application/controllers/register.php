<?php

/* register controller */
class Register extends Controller {

    // index model function when page is accessed
    public function index($params) {
        $this->_view($this->_model('Register', $params));
    }
}