document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.download-btn').forEach(button => {
        button.addEventListener('click', function() {
            const noteCard = this.closest('.note-card');
            const noteData = JSON.parse(noteCard.dataset.note);
            downloadNote(noteData);
        });
    });
});

function downloadNote(note) {
    const content = `
        <div class="download-content">
            <h1>Clinical Note</h1>
            <div class="date">Date: ${new Date(note.date).toLocaleString()}</div>
            
            <div class="section">
                <h2>Original Note</h2>
                <p>${note.content}</p>
            </div>
            
            ${note.analysis ? `
                <div class="section">
                    <h2>Analysis</h2>
                    <p>${note.analysis.content}</p>
                </div>
            ` : ''}
        </div>
    `;

    const style = `
        <style>
            .download-content {
                font-family: Arial, sans-serif;
                padding: 20px;
                color: #1f2937;
            }
            h1 {
                color: #2563eb;
                font-size: 24px;
                margin-bottom: 20px;
            }
            .date {
                color: #6b7280;
                margin-bottom: 30px;
            }
            .section {
                margin-bottom: 30px;
            }
            h2 {
                color: #374151;
                font-size: 18px;
                margin-bottom: 10px;
            }
            p {
                line-height: 1.6;
                margin: 0;
            }
        </style>
    `;

    const element = document.createElement('div');
    element.innerHTML = style + content;
    document.body.appendChild(element);

    const opt = {
        margin: 1,
        filename: `clinical-note-${new Date(note.date).toISOString().split('T')[0]}.pdf`,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
    };

    html2pdf().set(opt).from(element).save().then(() => {
        document.body.removeChild(element);
    });
}