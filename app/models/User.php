<?php
    class User {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        // Register User
        public function register($data){
            $this->db->query('INSERT INTO users(name, email, password) VALUES(:name, :email, :password)');
            // Bind values
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);
            
            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
          }
        
        // Update User
        public function updateUser($data){
            $this->db->query('UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $data['id']);
            $this->db->bind(':name', $data['name']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':password', $data['password']);

            // Execute
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
          }

        // Login User
        public function login($email, $password){
            $this->db->query('SELECT * FROM users WHERE email = :email');
            $this->db->bind(':email', $email);
  
            $row = $this->db->single();
  
            $hashed_password = $row->password;
            if(password_verify($password, $hashed_password)){
            return $row;
            } else {   
                return false;
            }
        }

        // Find user by email
        public function findUserByEmail($email){
            $this->db->query('SELECT * FROM users WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            // check row
            if($this->db->rowCount() > 0){
                return true;
            } else {
                return false;
            }
        }

            // Get User by ID
        public function getUserById($id){
            $this->db->query('SELECT * FROM users WHERE id = :id');
            // Bind value
            $this->db->bind(':id', $id);
  
            $row = $this->db->single();
  
            return $row;
      }

      public function getUsers(){
        $this->db->query('SELECT *,
                          users.id as userId,
                          users.created_at as userCreated
                          FROM users
                          ORDER BY users.created_at DESC');
  
        $results = $this->db->resultSet();
  
        return $results;
      }
    }