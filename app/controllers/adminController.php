<?php
class AdminController extends Controller {
    public function __construct() {
        if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'admin') {
            header('Location: index.php?url=home/index');
            exit();
        }
    }

    public function index() {
        $this->view('admin'); 
}
?>