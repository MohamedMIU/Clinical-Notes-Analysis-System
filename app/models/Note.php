<?php
require_once('../app/config/connect_DB.php');

class Note {
    private $conn;
    private $table = 'notes';

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function createNote($content, $userId) {
        try {
            $sql = "INSERT INTO {$this->table} (content, user, date) VALUES (?, ?, NOW())";
            $stmt = mysqli_prepare($this->conn, $sql);
            
            if (!$stmt) {
                error_log("Prepare failed: " . mysqli_error($this->conn));
                return false;
            }

            mysqli_stmt_bind_param($stmt, "si", $content, $userId);
            
            $success = mysqli_stmt_execute($stmt);
            
            if (!$success) {
                error_log("Execute failed: " . mysqli_stmt_error($stmt));
                return false;
            }

            $id = mysqli_insert_id($this->conn);
            mysqli_stmt_close($stmt);
            return $id;
        } catch (Exception $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }

    public function getNotesByUser($userId) {
        $sql = "SELECT * FROM {$this->table} WHERE user = ? ORDER BY date DESC";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        $notes = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $notes[] = $row;
        }
        return $notes;
    }
}
?>