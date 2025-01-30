<?php
// Database connection
include('../conn.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the image name before deleting the record
    $selectQuery = "SELECT image FROM movies WHERE id = '$id'";
    $result = mysqli_query($conn, $selectQuery);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) {
        // Get the image file path
        $imagePath = '../img/' . $row['image'];
        
        // Delete the record from the database
        $deleteQuery = "DELETE FROM movies WHERE id = '$id'";
        if (mysqli_query($conn, $deleteQuery)) {
            // Check if the image file exists and delete it
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            header("location: index.php");
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    } else {
        echo "Record not found.";
    }
} else {
    echo "No ID specified.";
}
?>
