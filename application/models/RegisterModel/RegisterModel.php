<?php 

/* register page for users to create account to the website */
class RegisterModel {
    protected $_formFields;
    protected $_dbh;
    protected $_lastId;
    public $title = 'Register - Schoolboard';

    /* constructor */
    public function __construct() {
        $this->_dbh = Db::getDbh();
        if ( !$this->_dbh ) {
            die;
        }

        $this->_formFields = new RegisterFormFields();

        if ( !empty($_POST) ) {
            $this->_populateFormFields();
            $this->_addUser($this->_formFields);
            $this->__registerUser($this->_lastId);
        }
    }

    /* populates form fields object with form values */
    private function _populateFormFields() {
        $this->_formFields->firstName       = $_POST['registerFirstName'];
        $this->_formFields->lastName        = $_POST['registerLastName'];
        $this->_formFields->email           = $_POST['registerEmail'];
        $this->_formFields->username        = $_POST['registerUsername'];
        $this->_formFields->password        = $_POST['registerPassword'];
        $this->_formFields->confirmPassword = $_POST['registerConfirmPassword'];
        $this->_formFields->member          = $_POST['registerMemberType'];
    }

    /* registers user and redirects to appropriate member panel */
    private function __registerUser($userId) {
        $query = $this->_dbh->prepare(sprintf(
            "SELECT user_id,
                    first_name,
                    last_name,
                    email,
                    username,
                    password,
                    member,
                    date_joined
               FROM users_table
              WHERE user_id='%s'",
              $userId
            ));
        $query->execute();

        while ( $user = $query->fetch(PDO::FETCH_ASSOC) ) {
            $_SESSION['userId'] = $userId;
            $_SESSION['logged'] = 'true';

            if ( $user['member'] == 'faculty') {
                header('Location: http://localhost/site-schoolboard/facultylogin/');
            } else {
                header('Location: http://localhost/site-schoolboard/studentlogin/');
            }
        }
    }

    /* adds a new user to the database */
    private function _addUser($fields = null) {
        $query = $this->_dbh->prepare(sprintf(
            "INSERT INTO %s
            (first_name, last_name, email, username, password, member)
            values ('%s', '%s', '%s', '%s', '%s', '%s')",
            'users_table',
            $fields->firstName,
            $fields->lastName,
            $fields->email,
            $fields->username,
            $fields->password,
            $fields->member
            ));
        $query->execute();

        return $this->_lastId = $this->_dbh->lastInsertId();
    }
}