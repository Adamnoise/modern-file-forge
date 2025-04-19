
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uploadDirectory = "./uploads/";
    
    // Create uploads directory if it doesn't exist
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }
    
    foreach ($_FILES["files"]["tmp_name"] as $key => $tmp_name) {
        $fileName = $_FILES["files"]["name"][$key];
        $filePath = $uploadDirectory . basename($fileName);
        
        // Basic security check for file extension
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'txt'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo "Error: File type not allowed for file: " . $fileName;
            continue;
        }
        
        if (move_uploaded_file($tmp_name, $filePath)) {
            echo "Successfully uploaded: " . $fileName . "<br>";
        } else {
            echo "Error uploading: " . $fileName . "<br>";
        }
    }
}
?>
<script>
    setTimeout(function() {
        window.location.href = 'upload.html';
    }, 2000);
</script>
