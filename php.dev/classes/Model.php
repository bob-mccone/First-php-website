<?php
    // Abstract class that will extend from other model classes, this is the base model
    abstract class Model{
        // Protected properties
        protected $dbh;
        protected $stmt;

        // Construct
        public function __construct(){
            // PDO string
            $this->dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
        }

        // Query method
        public function query($query){
            $this->stmt = $this->dbh->prepare($query);
        }

        // Bind method, binds the prep statement
        public function bind($param, $value, $type = null){
            // Check the type
            if (is_null($type)) {
                switch (true) {
                    // If the value is an int
                    case is_int($value):
                        // Set type as int
                        $type = PDO::PARAM_INT;
                        break;
                    // If the value is bool
                    case is_bool($value):
                        // Set the type as bool
                        $type = PDO::PARAM_BOOL;
                        break;
                    // If the value is null
                    case is_null($value):
                        // Set type as null
                        $type = PDO::PARAM_NULL;
                        break;
                        // Otherwise set the default as a string
                        default:
                        $type = PDO::PARAM_STR;
                }
            }
            $this->stmt->bindValue($param, $value, $type);
        }

        // Execute function
        public function execute(){
            $this->stmt->execute();
        }

        // Function to get result set
        public function resultSet(){
            // Execute method
            $this->execute();
            // Fetch all method
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Last insert id method
        public function lastInsertId(){
            return $this->dbh->lastInsertId();
        }

        // Return a single record, for when users login
        public function single(){
            // Execute method
            $this->execute();
            // Fetch method
            return $this->stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>