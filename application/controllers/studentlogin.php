<?php

/* student login controller */
class StudentLogin extends Controller {

    // index model function when page is accessed
    public function index($params) {
        $this->_view($this->_model('StudentLogin', $params));
    }
}