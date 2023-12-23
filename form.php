<!-- add_content.php -->

<?php
    require_once 'connection.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $date = $_POST['content_date'];
        $description = $_POST['content_description'];

        // Validate and sanitize input (you may want to enhance this)
        $date = mysqli_real_escape_string($conn, $date);
        $description = mysqli_real_escape_string($conn, $description);

        // Handle file upload
        $uploadDir = 'uploads/';  // Create a directory named 'uploads' in your project
        $uploadFile = $uploadDir . basename($_FILES['content_image']['name']);

        if (move_uploaded_file($_FILES['content_image']['tmp_name'], $uploadFile)) {
            // File is valid, and was successfully uploaded
            $image = mysqli_real_escape_string($conn, $uploadFile);

            // Insert data into the database
            $insertSql = "INSERT INTO contents (content_image, content_date, content_description) VALUES ('$image', '$date', '$description')";
            $result = $conn->query($insertSql);

            if ($result) {
                echo "Content added successfully!";
            } else {
                echo "Error adding content: " . $conn->error;
            }
        } else {
            echo "Error uploading file.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Content</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
   
    <main>
        <h2>Add Content</h2>
        <form method="post" action="" enctype="multipart/form-data">
            <label for="content_image">Image:</label>
            <input type="file" name="content_image" accept="image/*" required>

            <label for="content_date">Date:</label>
            <input type="date" name="content_date" required>

            <label for="content_description">Description:</label>
            <textarea name="content_description" rows="4" required></textarea>

            <button type="submit">Add Content</button>
        </form>
    </main>

    <script src="" async defer></script>
</body>
</html>
