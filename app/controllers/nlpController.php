<?php
require_once('../app/models/Note.php');
require_once('../app/models/Analysis.php');

class nlpController extends Controller {
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

        $data = [
            'title' => 'AI Analysis',
            'isLoggedIn' => isset($_SESSION['user_id']),
            'username' => $_SESSION['username'] ?? null,
            'role' => $_SESSION['role'] ?? null
        ];
        
        $this->view('nlp', $data);
    }

    public function analyze() {
        header('Content-Type: application/json');
        
        try {
            if (!isset($_SESSION['user_id'])) {
                throw new Exception('User not authenticated');
            }

            $rawInput = file_get_contents('php://input');
            if (!$rawInput) {
                throw new Exception('No input received');
            }

            error_log('Raw input received: ' . $rawInput);

            $input = json_decode($rawInput, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Invalid JSON: ' . json_last_error_msg());
            }

            $text = $input['text'] ?? '';
            if (empty($text)) {
                throw new Exception('No text provided');
            }

            error_log('Processing text: ' . substr($text, 0, 100) . '...');

            try {
                $analysisResult = $this->callGeminiAPI($text);
                
                error_log('API Response received: ' . substr($analysisResult, 0, 100) . '...');

                $noteId = $this->noteModel->createNote($text, $_SESSION['user_id']);
                if (!$noteId) {
                    throw new Exception('Failed to save note to database');
                }

                $analysisSaved = $this->analysisModel->createAnalysis($noteId, $analysisResult);
                if (!$analysisSaved) {
                    throw new Exception('Failed to save analysis to database');
                }

                echo json_encode([
                    'success' => true,
                    'result' => $analysisResult
                ]);

            } catch (Exception $e) {
                error_log('Error in analysis process: ' . $e->getMessage());
                throw $e;
            }

        } catch (Exception $e) {
            error_log('NLP Analysis Error: ' . $e->getMessage());
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage(),
                'details' => 'Please check the error logs for more information'
            ]);
        }
    }

    private function callGeminiAPI($text) {
        if (!defined('GOOGLE_API_KEY') || empty(GOOGLE_API_KEY)) {
            throw new Exception('Google API key is not configured');
        }

        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=' . GOOGLE_API_KEY;
        
        $data = [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => "As a medical analysis assistant, analyze this clinical note and provide key insights, potential diagnoses, and recommended follow-ups: \n\n" . $text
                        ]
                    ]
                ]
            ],
            'generationConfig' => [
                'temperature' => 0.7,
                'topK' => 40,
                'topP' => 0.95,
                'maxOutputTokens' => 1024,
            ],
            'safetySettings' => [
                [
                    'category' => 'HARM_CATEGORY_DANGEROUS_CONTENT',
                    'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'
                ]
            ]
        ];

        $ch = curl_init($url);
        
        if ($ch === false) {
            throw new Exception('Failed to initialize CURL');
        }

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json'
            ],
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_VERBOSE => true
        ]);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        curl_close($ch);

        if ($error) {
            throw new Exception('CURL Error: ' . $error);
        }

        if ($httpCode !== 200) {
            throw new Exception('API request failed with status ' . $httpCode . ': ' . $response);
        }

        $responseData = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Failed to decode API response: ' . json_last_error_msg());
        }

        if (isset($responseData['error'])) {
            throw new Exception('API Error: ' . ($responseData['error']['message'] ?? 'Unknown error'));
        }

        if (!isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
            throw new Exception('Unexpected API response format');
        }

        return $responseData['candidates'][0]['content']['parts'][0]['text'];
    }
}
?>