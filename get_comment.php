<?php
// Database connection
$conn = new mysqli('localhost', 'username', 'password', 'discussion_forum');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $topic = $_GET['topic'];
    
    $stmt = $conn->prepare("SELECT username, comment_text, comment_date FROM comments WHERE topic = ?");
    $stmt->bind_param('s', $topic);
    $stmt->execute();
    $result = $stmt->get_result();

    $comments = [];
    while ($row = $result->fetch_assoc()) {
        $comments[] = $row;
    }

    echo json_encode($comments);
}
?>
