<?php
include "koneksi.php";

if (isset($_POST['submit'])) {
    $episode = $_POST['episode'];
    $status = $_POST['status'];

    if ($status === 'File') {
        $file = $_FILES['file']['name'];
        $tmp = $_FILES['file']['tmp_name'];
        $path = "videos/".$file;
        $uploaded = date('Y-m-d H:i:s');

        if (move_uploaded_file($tmp, $path)) {
            $query = "INSERT INTO episode (episode, file, file_uploaded, status) VALUES ('$episode', '$path', '$uploaded', '$status')";
            mysqli_query($conn, $query);
            echo "<script>alert('Episode has been uploaded!');</script>";
            header("Location: episode.php");
        } else {
            echo "<script>alert('Failed to upload episode.');</script>";
        }
    } elseif ($status === 'Link') {
        // Handle link submission
        $link = $_POST['link'];
        $uploaded = date('Y-m-d H:i:s');
        $query = "INSERT INTO episode (episode, file, file_uploaded, status) VALUES ('$episode', '$link', '$uploaded', '$status')";
        mysqli_query($conn, $query);
        echo "<script>alert('Episode has been uploaded!');</script>";
        header("Location: episode.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Episode</title>
    <script>
        function toggleInput() {
            var status = document.getElementById('status').value;
            var fileInput = document.getElementById('fileInput');
            var linkInput = document.getElementById('linkInput');
            var file = document.getElementById('file');
            var link = document.getElementById('link');

            if (status === 'File') {
                fileInput.style.display = 'block';
                linkInput.style.display = 'none';
                file.required = true;
                link.required = false;
            } else if (status === 'Link') {
                fileInput.style.display = 'none';
                linkInput.style.display = 'block';
                file.required = false;
                link.required = true;
            }
        }
    </script>
</head>
<body>
    <a href="index.php">Back</a>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <label for="episode">Episode:</label>
        <input type="text" id="episode" name="episode" required>
        
        <label for="status">Status:</label>
        <select id="status" name="status" onchange="toggleInput()" required>
            <option value="File">File</option>
            <option value="Link">Link</option>
        </select>
        
        <div id="fileInput">
            <label for="file">File:</label>
            <input type="file" id="file" name="file" required>
        </div>

        <div id="linkInput" style="display: none;">
            <label for="link">Link:</label>
            <input type="text" id="link" name="link">
        </div>
        
        <button type="submit" name="submit">Upload</button>
    </form>
</body>
</html>
