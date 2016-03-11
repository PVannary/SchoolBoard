<?php

/* base controller class */
class Controller {
    protected $_modelName;
    protected $_modelFile;
    protected $_contentFile;

    /* creates requested model class */
    protected function _model($model, $params) {
        $this->_modelName = strtolower($model);
        $this->_modelFile = ucfirst($model) . 'Model';

        // includes all class files of model
        foreach ( glob('application/models/' . $this->_modelFile . '/*.php') as $fileName) {
            include $fileName;
        }

        // creates an instance of requested model
        return new $this->_modelFile($model, $params);
    }

    /* creates a view of the requested model class */
    protected function _view( $data = array() ) {
        $this->_contentFile = 'application/models/' . $this->_modelFile . '/index.html';
        include 'public/templates/index.html';
    }
}