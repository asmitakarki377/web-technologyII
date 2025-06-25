<?php
// Set upload directories
$resumeDir = "uploads/resumes/";
$photoDir = "uploads/photos/";

// Create directories if not exists
if (!is_dir($resumeDir)) mkdir($resumeDir, 0777, true);
if (!is_dir($photoDir)) mkdir($photoDir, 0777, true);

$messages = [];
$success = true;

// Resume validations
if (isset($_FILES['resume']) && is_uploaded_file($_FILES['resume']['tmp_name'])) {
    $resume = $_FILES['resume'];
    $resumeName = basename($resume['name']);
    $resumePath = $resumeDir . $resumeName;
    $resumeExt = strtolower(pathinfo($resumePath, PATHINFO_EXTENSION));
    $allowedResumeTypes = ['pdf', 'doc', 'docx'];

    if (file_exists($resumePath)) {
        $messages[] = "❌ Resume already exists.";
        $success = false;
    } elseif (!in_array($resumeExt, $allowedResumeTypes)) {
        $messages[] = "❌ Invalid resume format. Only PDF and DOC/DOCX allowed.";
        $success = false;
    } elseif ($resume['size'] > 500 * 1024) {
        $messages[] = "❌ Resume size exceeds 500KB.";
        $success = false;
    } else {
        if (move_uploaded_file($resume['tmp_name'], $resumePath)) {
            $messages[] = "✅ Resume uploaded successfully: " . $resumeName;
        } else {
            $messages[] = "❌ Failed to upload resume.";
            $success = false;
        }
    }
} else {
    $messages[] = "❌ Resume file not uploaded via HTTP POST.";
    $success = false;
}

// Photo validations
if (isset($_FILES['photo']) && is_uploaded_file($_FILES['photo']['tmp_name'])) {
    $photo = $_FILES['photo'];
    $photoName = basename($photo['name']);
    $photoPath = $photoDir . $photoName;
    $photoExt = strtolower(pathinfo($photoPath, PATHINFO_EXTENSION));
    $allowedPhotoTypes = ['jpg', 'jpeg'];

    if (file_exists($photoPath)) {
        $messages[] = "❌ Photograph already exists.";
        $success = false;
    } elseif (!in_array($photoExt, $allowedPhotoTypes)) {
        $messages[] = "❌ Invalid photo format. Only JPG and JPEG allowed.";
        $success = false;
    } elseif ($photo['size'] > 1 * 1024 * 1024) {
        $messages[] = "❌ Photo size exceeds 1MB.";
        $success = false;
    } else {
        if (move_uploaded_file($photo['tmp_name'], $photoPath)) {
            $messages[] = "✅ Photograph uploaded successfully: " . $photoName;
        } else {
            $messages[] = "❌ Failed to upload photograph.";
            $success = false;
        }
    }
} else {
    $messages[] = "❌ Photograph not uploaded via HTTP POST.";
    $success = false;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Result</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        h2 {
            color: #2a4d69;
            text-align: center;
            margin-bottom: 30px;
        }
        .message {
            padding: 15px;
            margin: 10px 0;
            border-radius: 4px;
            border-left: 4px solid;
        }
        .success {
            background: #d4edda;
            border-color: #28a745;
            color: #155724;
        }
        .error {
            background: #f8d7da;
            border-color: #dc3545;
            color: #721c24;
        }
        .back-btn {
            background: #2a4d69;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
        .back-btn:hover {
            background: #1e3552;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Upload Result</h2>
        
        <?php foreach ($messages as $message): ?>
            <div class="message <?= $success ? 'success' : 'error' ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endforeach; ?>
        
        <div style="text-align: center;">
            <a href="index.html" class="back-btn">Back to Upload Form</a>
        </div>
    </div>
</body>
</html>
