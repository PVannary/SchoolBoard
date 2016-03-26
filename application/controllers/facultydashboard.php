<?php

/* faculty dashboard controller */
class FacultyDashboard extends Controller {

    // index model function when page is accessed
    public function index($params) {
        $this->_view($this->_model('FacultyDashboard', $params));
    }
}