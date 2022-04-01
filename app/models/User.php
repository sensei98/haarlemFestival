<?php
class User {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function register($data) {
        $this->db->query('INSERT INTO users (username, email, password) VALUES(:username, :email, :password)');

        //Bind values
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($username, $password) {
        $this->db->query('SELECT * FROM users WHERE username = :username');

        //Bind value
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        $hashedPassword = $row->password;

        if (password_verify($password, $hashedPassword)) {
            return $row;
        } else {
            return false;
        }
    }

    //Find user by email. Email is passed in by the Controller.
    public function findUserByEmail($email) {
        //Prepared statement
        $this->db->query('SELECT * FROM users WHERE email = :email');

        //Email param will be binded with the email variable
        $this->db->bind(':email', $email);

        //Check if email is already registered
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    //Adds log to database table
    public function dbLog($username, $type_id, $log_detail = "") {

        $user_id = $this->findUserIdByUsername($username);
        $this->db->query('INSERT INTO logs (user_id, type_id, time, event_log) VALUES(:user_id, :type, now(), :detail)');

        //Bind values
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':type', $type_id);
        $this->db->bind(':detail', $log_detail);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getLogs($user_id, $privilege_level){
        $this->db->query('SELECT l.log_id, u.username, e.name, l.time, l.event_log FROM logs l inner join event_types e on l.type_id = e.type_id inner JOIN users u on l.user_id = u.user_id inner join privileges p on u.privilege_level = p.privilege_level WHERE l.user_id = :user_id OR l.user_id in (SELECT user_id FROM users where privilege_level < :privilege)');

        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':privilege', $privilege_level);

        $result = $this->db->resultSet();
        return $result;
    }

    public function sendResetEmail($data){
        $this->db->query('SELECT email, password FROM Users WHERE email= :email');
            //Email param will be binded with the email variable
            $this->db->bind(':email', $data['email']);
            
            if($this->db->rowCount()==1)
                {
                  
                    $row = $this->db->single();
                    $email = md5($row->email);
                    $pass = $row->password;

                    //prepare link for email body
                    $link="http://localhost/HaarlemFestival_CMS/users/newPasswordReset?key=".$email."&reset=".$pass. ''; 
                    
                    //send email
                    $to_email = $data['email'];
                    $subject = 'Password Reset';
                    $message = 'Please click the following link to reset your password ' . $link . '';
                    $headers = 'From: noreply@FAKELINK.nl';
                    echo($to_email . $subject . $message . $headers);
                    mail($to_email,$subject,$message,$headers);
            }
    }
}
