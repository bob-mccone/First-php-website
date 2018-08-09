<?php
    class UserModel extends Model{
        // Register function
        public function register(){
            // Sanitize post
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            // Emcrypting the password, MD5 not the best way, use sha1
            $password = md5($post['password']);
            
            // If post gets submitted
            if($post['submit']){
                // If name, email or password are empty
                if($post['name'] == '' || $post['email'] == '' || $post['password'] == ''){
                    // Set error message
                    Messages::setMsg('Please fill in all fields', 'error');
                    return;
                }
                // Insert into mysql
                $this->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
                // Data binding
                $this->bind(':name', $post['name']);
                $this->bind(':email', $post['email']);
                $this->bind(':password', $password);
                // Execute
                $this->execute();
                // Verify
                if($this->lastInsertId()){
                    // Redirect
                    header('Location: '.ROOT_URL.'users/login');
                }
            }
            return;
        }

        // Login function
        public function login(){
            // Sanitize post
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // Encrypting the password, MD5 not the best way, use sha1
            $password = md5($post['password']);
            
            // If post gets submitted
            if($post['submit']){
                // Compare login
                $this->query('SELECT * FROM users WHERE email = :email AND password = :password');
                // Data binding
                $this->bind(':email', $post['email']);
                $this->bind(':password', $password);
                // Assigning row as the value
                $row = $this->single();
                // Check the row
                if($row){
                    // We log in and its correct
                    $_SESSION['is_logged_in'] = true;
                    // Then we set the session values
                    $_SESSION['user_data'] = array(
                        "id" => $row['id'],
                        "name" => $row['name'],
                        "email" => $row['email']
                    );
                     // Redirect them to the shares page
                     header('Location: '.ROOT_URL.'shares');
                } else {
                    // Setting error message
                    Messages::SetMsg('Incorrect Login', 'error');
                }
            }
            return;
        }
    }
?>