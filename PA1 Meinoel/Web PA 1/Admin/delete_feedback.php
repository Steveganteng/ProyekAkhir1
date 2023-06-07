<?php
require('config/config.php');

// Check if feedback_id is set and not empty
if(isset($_POST['feedback_id']) && !empty($_POST['feedback_id'])) {
    $feedback_id = $_POST['feedback_id'];

    // Fetch feedback data from database
    $query = "SELECT * FROM feedback WHERE id_feedback = '$feedback_id'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Error: Feedback not found.";
    }
} elseif(isset($_POST['feedback_id'])) {
    // If feedback_id is empty, display error message
    echo "Error: Feedback ID is required.";
}

// If delete button is clicked, delete feedback from database
if(isset($_POST['hapus']))   {
    $feedback_id = $_POST['feedback_id'];

    $query = "DELETE FROM feedback WHERE id_feedback = '$feedback_id'";
    if(mysqli_query($conn, $query)) {
        header("Location: admin.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
