<?php
// Database connection details
$servername = "localhost";
$username = "root";  // Default username for MySQL in XAMPP
$password = "";      // Default password for MySQL in XAMPP
$dbname = "insulinvibes";  // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];  // Get the email from the form

    // Validate email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Prepare the SQL statement to insert the email into the 'subscriptions' table
        $stmt = $conn->prepare("INSERT INTO subscriptions (email) VALUES (?)");
        $stmt->bind_param("s", $email);  // Bind the email as a string parameter

        // Execute the statement and check if the email was inserted successfully
        if ($stmt->execute()) {
            // Display the enhanced thank-you page
            echo '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="description" content="Supportive platform for individuals with Type 1 Diabetes. Connect, share, learn, and stay updated with events, stories, and more.">
                <meta name="keywords" content="Type 1 Diabetes, Diabetes Awareness, Support Group, Health, Merchandise, Events, Stories">
                <meta name="author" content="Type1DiabetesHub">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Thank You - Insulin Vibes</title>
                <style>
                    body {
                        background: linear-gradient(to bottom right, #a1c4fd, #c2e9fb);
                        font-family: \'Roboto\', sans-serif;
                        color: #333;
                        margin: 0;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100vh;
                        text-align: center;
                    }
                    .thank-you-container {
                        background-color: #fff;
                        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                        border-radius: 12px;
                        padding: 40px 30px;
                        max-width: 600px;
                        width: 100%;
                        animation: fadeIn 1s ease-out;
                    }
                    .thank-you-container h1 {
                        color: #4682b4;
                        font-size: 36px;
                        margin-bottom: 20px;
                        font-weight: bold;
                    }
                    .thank-you-container p {
                        font-size: 18px;
                        color: #555;
                        margin-bottom: 30px;
                    }
                    .cta-button {
                        padding: 12px 30px;
                        background-color: #4682b4;
                        color: white;
                        text-decoration: none;
                        border-radius: 8px;
                        font-size: 18px;
                        font-weight: bold;
                        transition: background-color 0.3s ease, transform 0.3s ease;
                    }
                    .cta-button:hover {
                        background-color: #315f80;
                        transform: translateY(-2px);
                    }
                    .cta-button:active {
                        transform: translateY(2px);
                    }
                    @keyframes fadeIn {
                        0% {
                            opacity: 0;
                            transform: translateY(-30px);
                        }
                        100% {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }
                    footer {
                        position: absolute;
                        bottom: 10px;
                        font-size: 14px;
                        color: #333;
                    }
                </style>
            </head>
            <body>
                <div class="thank-you-container">
                    <h1>Thank You for Subscribing!</h1>
                    <p>Your subscription has been successfully received. You’ll start receiving updates soon.</p>
                    <a href="index.html" class="cta-button">Back to Home</a>
                </div>
                <footer>
                    <p>&copy; 2024 InsulinVibes. All rights reserved.</p>
                </footer>
            </body>
            </html>';
        } else {
            echo "There was an error with your subscription. Please try again.";
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Please enter a valid email address.";
    }
}

// Close the database connection
$conn->close();
?>
