<?php
// Database configuration
$host = 'localhost'; // Your database host
$dbname = 'contact_form'; // Database name
$username = 'root'; // Your database username
$password = ''; // Your database password

// Establish database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Prepare the SQL query to insert data into the database
    $stmt = $conn->prepare("INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    // Execute the query and handle any errors
    if ($stmt->execute()) {
        // Data successfully saved to database
        echo "Your message has been sent. Thank you!";
    } else {
        // Error saving data to database
        echo "Error saving message to database. Please try again.";
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
