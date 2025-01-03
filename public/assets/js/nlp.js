document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('fileInput');
    const fileList = document.getElementById('fileList');
    const analyzeBtn = document.getElementById('analyzeBtn');
    const results = document.getElementById('results');
    const textInput = document.getElementById('textInput');
    const downloadBtn = document.getElementById('downloadPdf');

    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.style.borderColor = '#2563eb';
    });

    uploadArea.addEventListener('dragleave', () => {
        uploadArea.style.borderColor = '#e5e7eb';
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.style.borderColor = '#e5e7eb';
        handleFiles(e.dataTransfer.files);
    });

    uploadArea.addEventListener('click', () => {
        fileInput.click();
    });

    fileInput.addEventListener('change', () => {
        handleFiles(fileInput.files);
    });

    async function handleFiles(files) {
        fileList.innerHTML = '';
        for (const file of files) {
            try {
                if(file.type.startsWith('text/')) {
                    const text = await readFileAsText(file);
                    textInput.value = text;
                } else if(file.type.startsWith('image/')) {
                    const progress = document.createElement('div');
                    progress.className = 'ocr-progress';
                    progress.textContent = 'Processing image... This may take a few moments.';
                    fileList.appendChild(progress);

                    const imageUrl = await readFileAsDataURL(file);
                    const text = await performOCR(imageUrl, progress);
                    textInput.value = text;
                    progress.remove();
                } else if(file.type === 'application/pdf') {
                    alert('PDF processing will be implemented soon');
                }

                const fileItem = document.createElement('div');
                fileItem.className = 'file-item';
                fileItem.innerHTML = `
                    <i class="fa-solid ${getFileIcon(file.type)}"></i>
                    <span>${file.name} (${formatFileSize(file.size)})</span>
                `;
                fileList.appendChild(fileItem);
            } catch (error) {
                console.error('File processing error:', error);
                alert('Error processing file: ' + error.message);
            }
        }
    }

    function readFileAsText(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = (e) => resolve(e.target.result);
            reader.onerror = (e) => reject(new Error('Failed to read file'));
            reader.readAsText(file);
        });
    }

    function readFileAsDataURL(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = (e) => resolve(e.target.result);
            reader.onerror = (e) => reject(new Error('Failed to read file'));
            reader.readAsDataURL(file);
        });
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    function getFileIcon(fileType) {
        if (fileType.startsWith('image/')) return 'fa-image';
        if (fileType.startsWith('text/')) return 'fa-file-text';
        if (fileType === 'application/pdf') return 'fa-file-pdf';
        return 'fa-file';
    }

    async function performOCR(imageUrl, progressElement) {
        try {
            const worker = await Tesseract.createWorker({
                logger: message => {
                    if (progressElement) {
                        progressElement.textContent = `Processing image: ${message.status}`;
                    }
                    console.log(message);
                }
            });

            await worker.loadLanguage('eng');
            await worker.initialize('eng');

            await worker.setParameters({
                tessedit_char_whitelist: 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789.,!?()-:;/ ',
                preserve_interword_spaces: '1',
            });

            const result = await worker.recognize(imageUrl);
            await worker.terminate();

            if (!result || !result.data || !result.data.text) {
                throw new Error('No text was extracted from the image');
            }

            return result.data.text;
        } catch (error) {
            console.error('OCR Error:', error);
            throw new Error('Failed to extract text from image');
        }
    }

    analyzeBtn.addEventListener('click', async () => {
        const text = textInput.value.trim();
        
        if (!text && fileList.children.length === 0) {
            alert('Please enter text or upload a file to analyze');
            return;
        }

        analyzeBtn.disabled = true;
        analyzeBtn.textContent = 'Analyzing...';
        results.style.display = 'none';

        try {
            await analyzeText(text);
        } catch (error) {
            console.error('Analysis error:', error);
            alert('An error occurred during analysis. Please try again.');
        } finally {
            analyzeBtn.disabled = false;
            analyzeBtn.textContent = 'Analyze';
        }
    });

    downloadBtn.addEventListener('click', () => {
        const resultsContent = document.querySelector('.results-content').innerHTML;
        const style = `
            <style>
                body { 
                    font-family: Arial, sans-serif;
                    padding: 20px;
                }
                h1 { 
                    color: #2563eb;
                    margin-bottom: 20px;
                }
                .analysis-result { 
                    line-height: 1.6;
                    background-color: #f8fafc;
                    padding: 15px;
                    border-radius: 8px;
                }
            </style>
        `;
        
        const html = `
            <html>
                <head>
                    ${style}
                </head>
                <body>
                    <h1>Analysis Results</h1>
                    ${resultsContent}
                </body>
            </html>
        `;

        html2pdf().set({
            margin: 1,
            filename: 'analysis-results.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
        }).from(html).save();
    });

    async function analyzeText(text) {
        try {
            const resultsContent = results.querySelector('.results-content');
            resultsContent.innerHTML = '<div class="loading">Analyzing...</div>';
            results.style.display = 'block';

            console.log('Sending text:', text);

            const response = await fetch('index.php?url=nlp/analyze', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ 
                    text: text
                })
            });

            console.log('Response status:', response.status);

            const responseText = await response.text();
            console.log('Raw response:', responseText);

            let data;
            try {
                data = JSON.parse(responseText);
            } catch (parseError) {
                console.error('JSON Parse Error:', parseError);
                console.log('Response that failed to parse:', responseText);
                throw new Error('Failed to parse server response');
            }

            if (!data.success) {
                if (data.error === 'User not authenticated') {
                    window.location.href = 'index.php?url=login/index';
                    return;
                }
                throw new Error(data.error || 'Unknown error occurred');
            }

            results.style.display = 'block';
            resultsContent.innerHTML = `
                <div class="analysis-result">
                    ${data.result.replace(/\n/g, '<br>')}
                </div>
            `;
        } catch (error) {
            console.error('Full error details:', error);
            results.style.display = 'block';
            results.querySelector('.results-content').innerHTML = `
                <div class="error-message">
                    Error: ${error.message}
                    <br>
                    Please try again or contact support if the problem persists.
                </div>
            `;
        }
    }
});