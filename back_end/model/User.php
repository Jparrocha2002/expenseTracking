<?php
include "../database/db.php";
header('Content-type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: OPTIONS, GET, POST, PUT, DELETE');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Content-type, Access-Control-Allow-Headers, Authorization, X-Requested-With');


class User extends Database
{
    public function login()
    {
        $this->init();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];

                if (!empty($email) && !empty($password)) {
                    $query = "SELECT * FROM user WHERE email = '$email'";
                    $result = $this->conn->query($query);

                    if ($result && $result->num_rows > 0) {
                        $user = $result->fetch_assoc();
                        $hashedPassword = $user['password'];

                        if (password_verify($password, $hashedPassword)) {
                            // Login successful
                            echo json_encode(['message' => 'Login successful']);
                        } else {
                            // Login failed
                            echo json_encode(['message' => 'Invalid email or password!']);
                        }
                    } else {
                        // User not found
                        echo json_encode(['message' => 'Invalid email or password!']);
                    }
                } else {
                    // Email or password not provided
                    echo json_encode(['message' => 'Email and password are required!']);
                    }
                }
            }
    }


    public function register()
    {
        $this->init();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
            $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            if(strlen($password) < 8)
            {
                return json_encode(['message' => 'Password required atleast 8 character']);
            }
            // Check if email already exists
            $isEmail = $this->conn->query("SELECT * FROM user WHERE email='$email'");

            if ($isEmail->num_rows > 0) {
                echo json_encode(['message' => 'Email is Already Exists']);
                return;
            }
            $hashPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insert new user
            $isInserted = $this->conn->query("INSERT INTO user (first_name, last_name, email, password)
            VALUES('$first_name', '$last_name', '$email', '$hashPassword')");

            if ($isInserted) {
                echo json_encode(['message' => 'Registration successful']);
            } else {
                echo json_encode(['message' => 'Failed to register']);
          }
        }
    }

    public function getAll()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") 
        {
            $this->init();
            $sql = "SELECT * FROM user";
            $data = $this->conn->query($sql);
            if($data->num_rows > 0)
            {
                $all = $data->fetch_all(MYSQLI_ASSOC);
                echo json_encode($all);
            }
        }
    }
    
}
?>