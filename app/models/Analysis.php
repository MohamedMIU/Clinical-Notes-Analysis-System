<?php
require_once('../app/config/connect_DB.php');

class Analysis {
    private $conn;
    private $table = 'analysis';

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function createAnalysis($noteId, $content) {
        try {
            $sql = "INSERT INTO {$this->table} (note_id, content) VALUES (?, ?)";
            $stmt = mysqli_prepare($this->conn, $sql);
            
            if (!$stmt) {
                error_log("Prepare failed: " . mysqli_error($this->conn));
                return false;
            }

            mysqli_stmt_bind_param($stmt, "is", $noteId, $content);
            
            $success = mysqli_stmt_execute($stmt);
            
            if (!$success) {
                error_log("Execute failed: " . mysqli_stmt_error($stmt));
                return false;
            }

            mysqli_stmt_close($stmt);
            return true;
        } catch (Exception $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }

    public function getAnalysisByNoteId($noteId) {
        $sql = "SELECT * FROM {$this->table} WHERE note_id = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $noteId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }
}
?>