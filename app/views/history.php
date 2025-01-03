<?php
$isLoggedIn = $data['isLoggedIn'] ?? false;
$username = $data['username'] ?? null;
$role = $data['role'] ?? null;
$notes = $data['notes'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History - Clinical Notes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="http://localhost/project/public/assets/css/home.css">
    <link rel="stylesheet" href="http://localhost/project/public/assets/css/history.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script src="http://localhost/project/public/assets/js/history.js" defer></script>
</head>
<body>
    <?php include('partials/header.php'); ?>

    <div class="history-container">
        <div class="history-header">
            <h1 class="history-title">Clinical Notes History</h1>
            <p class="history-subtitle">Your complete history of clinical notes and their analyses</p>
        </div>

        <div class="history-timeline">
            <?php if (empty($notes)): ?>
                <div class="no-notes">
                    <div class="no-notes-icon">
                        <i class="fas fa-file-medical"></i>
                    </div>
                    <p class="no-notes-text">No clinical notes found</p>
                    <a href="index.php?url=nlp/index" class="create-note-btn">Create Your First Note</a>
                </div>
            <?php else: ?>
                <?php foreach ($notes as $note): ?>
                    <div class="note-card" data-note='<?php echo htmlspecialchars(json_encode($note), ENT_QUOTES); ?>'>
                        <div class="note-header">
                            <div class="note-date">
                                <i class="far fa-calendar-alt"></i>
                                <?php echo date('F j, Y, g:i a', strtotime($note['date'])); ?>
                            </div>
                            <div class="note-actions">
                                <button class="action-btn download-btn" title="Download">
                                    <i class="fas fa-download"></i>
                                </button>
                            </div>
                        </div>

                        <div class="note-content-wrapper">
                            <div class="section-title">Original Note</div>
                            <div class="note-content">
                                <?php echo nl2br(htmlspecialchars($note['content'])); ?>
                            </div>
                        </div>

                        <?php if (isset($note['analysis'])): ?>
                            <div class="analysis-section">
                                <div class="analysis-header">
                                    <div class="analysis-title">
                                        <i class="fas fa-chart-line"></i>
                                        Analysis Results
                                    </div>
                                    <span class="status-badge completed">
                                        <i class="fas fa-check-circle"></i>
                                        Completed
                                    </span>
                                </div>
                                <div class="analysis-content">
                                    <?php echo nl2br(htmlspecialchars($note['analysis']['content'])); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php include('partials/footer.php'); ?>
</body>
</html>