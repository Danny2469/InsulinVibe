<?php
// Database connection
$conn = new mysqli('localhost', 'username', 'password', 'discussion_forum');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve posted comment
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $topic = $_POST['topic'];
    $comment = $_POST['comment'];
    $username = 'Anonymous'; // You can expand this to use actual usernames

    $stmt = $conn->prepare("INSERT INTO comments (topic, username, comment_text) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $topic, $username, $comment);
    $stmt->execute();

    echo json_encode(['success' => true]);
}
?>
