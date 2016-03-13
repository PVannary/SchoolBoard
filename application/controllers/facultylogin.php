<?php

/* faculty login controller */
class FacultyLogin extends Controller {

    // index model function when page is accessed
    public function index($params) {
        $this->_view($this->_model('FacultyLogin', $params));
    }
}