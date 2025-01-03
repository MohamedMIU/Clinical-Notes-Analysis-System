<?php
require_once(__DIR__ . '/../models/User.php');

class LoginController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function index() {
        $data = ['errors' => ['email' => '', 'password' => '']];
        $this->view('login', $data);
    }

    public function processLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            if ($this->userModel->validateLogin($_POST)) {
                $user = $this->userModel->verifyLogin($email, $password);
                
                if ($user) {
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['role'] = $user['role'];
                    
                    header('Location: index.php');
                    exit();
                } else {
                    $this->userModel->errors['password'] = 'Invalid email or password';
                }
            }
            
            $data = ['errors' => $this->userModel->errors];
            $this->view('login', $data);
        } else {
            header('Location: index.php?url=login');
            exit();
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: index.php');
        exit();
    }
}
?>