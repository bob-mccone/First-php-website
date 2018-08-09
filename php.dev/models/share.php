<?php
    class ShareModel extends Model{
        // Share model index method
        public function Index(){
            // Query, newest at top
            $this->query('SELECT * FROM shares ORDER BY create_date DESC');
            // Result are being stored as rows
            $rows = $this->resultSet();
            // returning the rows, they are printed out by the view
            return $rows;
        }

        // Add function for creating share posts
        public function add(){
            // Sanitize post
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // If post gets submitted
            if($post['submit']){
                // If title, body or link are empty
                if($post['title'] == '' || $post['body'] == '' || $post['link'] == ''){
                    // Set error message
                    Messages::setMsg('Please fill in all fields', 'error');
                    return;
                }
                // Insert into mysql
                $this->query('INSERT INTO shares (title, body, link, user_id) VALUES(:title, :body, :link, :user_id)');
                // Data binding
                $this->bind(':title', $post['title']);
                $this->bind(':body', $post['body']);
                $this->bind(':link', $post['link']);
                // As we are not logged in we will put a 1
                $this->bind(':user_id', 1);
                // Execute
                $this->execute();
                // Verify
                if($this->lastInsertId()){
                    // Redirect
                    header('Location: '.ROOT_URL.'shares');
                }
            }
            return;
        }
    }
?>