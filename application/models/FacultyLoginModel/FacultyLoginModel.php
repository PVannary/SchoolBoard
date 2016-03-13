<?php

/* login page for faculty */
class FacultyLoginModel {
    public $title = 'Faculty Login - Schoolboard';

    /* constructor */
    public function __construct() {
        $this->_formFields = new FacultyLoginFormFields();

        if ( !empty($_POST) ) {
            $this->_populateFormFields();
            $this->_processLogin();
        }
    }

    /* populates form fields object with form values */
    private function _populateFormFields() {
        $this->_formFields->username = $_POST['facultyUsername'];
        $this->_formFields->password = $_POST['facultyPassword'];
    }

    /* process login form*/
    private function _processLogin() {
        $dbh   = Db::getDbh();

        $query = $dbh->prepare(sprintf(
            "SELECT user_id,
                    first_name,
                    last_name,
                    email,
                    username,
                    password,
                    member,
                    date_joined
               FROM users_table
              WHERE username ='%s'
                AND password = '%s'
                AND member = 'faculty'",
            $this->_formFields->username,
            $this->_formFields->password
            ));
        $query->execute();

        while ( $user = $query->fetch(PDO::FETCH_ASSOC) ) {
            $_SESSION['userId'] = $dbh->lastInsertId('user_id');
            $_SESSION['logged'] = 'true';

            if ( $query->rowCount() > 0 ) {
                header('Location: http://localhost/facultydashboard.html');
            }
        }
    }
}