<?php
require_once('../app/models/Note.php');
require_once('../app/models/Analysis.php');

class HistoryController {
    private $noteModel;
    private $analysisModel;

    public function __construct() {
        $this->noteModel = new Note();
        $this->analysisModel = new Analysis();
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?url=login/index');
            return;
        }

        $userId = $_SESSION['user_id'];
        $notes = $this->noteModel->getNotesByUser($userId);
        
        foreach ($notes as &$note) {
            $note['analysis'] = $this->analysisModel->getAnalysisByNoteId($note['id']);
        }

        $data = [
            'notes' => $notes,
            'isLoggedIn' => true,
            'username' => $_SESSION['username'] ?? null,
            'role' => $_SESSION['role'] ?? null
        ];

        require_once('../app/views/history.php');
    }
}
?>