<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Analysis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="http://localhost/project/public/assets/css/nlp.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</head>
<body>
    <?php include('partials/header.php'); ?>

    <div class="analyze-container">
        <h1>AI Clinical Note Analysis</h1>
        <p class="subtitle">Upload your clinical notes or enter text for AI analysis</p>

        <div class="input-methods">
            <div class="input-section">
                <h2>Enter Text</h2>
                <textarea 
                    id="textInput" 
                    placeholder="Enter your clinical notes here..."
                ></textarea>
            </div>

            <div class="input-section">
                <h2>Upload File</h2>
                <div class="upload-area" id="uploadArea">
                <input type="file" id="fileInput" accept=".txt,.doc,.docx,.pdf,image/png,image/jpeg,image/jpg,image/gif" hidden>                    <div class="upload-content">
                        <i class="fa-solid fa-arrow-up-from-bracket"></i>
                        <p>Drag & Drop files here</p>
                        <p class="file-types">Supported formats: TXT, DOC, DOCX, PDF, Images</p>
                    </div>
                </div>
                <div id="fileList" class="file-list"></div>
            </div>
        </div>

        <div class="analyze-actions">
            <button id="analyzeBtn" class="analyze-btn">Analyze</button>
        </div>

        <div id="results" class="results-section" style="display: none;">
            <div class="results-header">
                <h2>Analysis Results</h2>
                <button id="downloadPdf" class="download-btn">
                    <i class="fa-solid fa-download"></i> Download PDF
                </button>
            </div>
            <div class="results-content">
            </div>
        </div>
    </div>

    <?php include('partials/footer.php'); ?>
    <script src="http://localhost/project/public/assets/js/nlp.js"></script>
    <script src='https://unpkg.com/tesseract.js@4.1.1/dist/tesseract.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script></body>
</html>