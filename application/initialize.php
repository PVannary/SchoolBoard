<?php
    // base app class
    include 'core/App.php';

    // base controller class
    include 'core/Controller.php';

// Begin Session
if ( session_id() == '' || !isset($_SESSION) ) {
    session_start();
}