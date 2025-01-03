<?php
require_once('../app/config/connect_DB.php');

class Comment {
    private $conn;
    private $table = 'comments';

    public $id;
    public $topic_id;
    public $content;
    public $user;
    public $date;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getCommentsByTopicId($topicId) {
        $sql = "SELECT * FROM {$this->table} WHERE topic_id = ? ORDER BY date DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $topicId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $comments = [];
        while ($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }
        return $comments;
    }

    public function addComment($topicId, $content, $user) {
        $sql = "INSERT INTO {$this->table} (topic_id, content, user, date) VALUES (?, ?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iss", $topicId, $content, $user);
        
        if ($stmt->execute()) {
            $this->updateTopicRepliesCount($topicId);
            return true;
        }
        return false;
    }

    private function updateTopicRepliesCount($topicId) {
        $sql = "UPDATE topics SET replies = (SELECT COUNT(*) FROM {$this->table} WHERE topic_id = ?) WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $topicId, $topicId);
        $stmt->execute();
    }

    public function getCommentCount($topicId) {
        $sql = "SELECT COUNT(*) as count FROM {$this->table} WHERE topic_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $topicId);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        return $data['count'];
    }

    public function deleteComment($commentId, $topicId) {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $commentId);
        
        if ($stmt->execute()) {
            $this->updateTopicRepliesCount($topicId);
            return true;
        }
        return false;
    }

    public function editComment($commentId, $content) {
        $sql = "UPDATE {$this->table} SET content = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $content, $commentId);
        return $stmt->execute();
    }
}
?>