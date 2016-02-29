<?php

class Home {
    protected $_modelFile;
    protected $_contentFile;

    // index model function when page is accessed
    public function index($params) {
        $this->_view($this->_model('home', $params));
    }

    // creates requested model class
    protected function _model($model, $params) {
        $modelName = $model;
        $this->_modelFile = ucfirst($modelName) . 'Model';

        // includes all class files of model
        foreach ( glob('application/models/' . $this->_modelFile . '/*.php') as $fileName) {
        include $fileName;
        }

        // creates an instance of HomeModel();
        return new $this->_modelFile($model, $params);
    }

    // creates a view of the creadted model class
    protected function _view( $data = array() ) {
        $this->_contentFile = 'application/models/' . $this->_modelFile . '/index.html';
        include 'public/templates/index.html';
    }
}