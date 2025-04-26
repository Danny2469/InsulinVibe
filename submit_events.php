<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventTitle = $_POST["eventTitle"];
    $eventDate = $_POST["eventDate"];
    $eventDescription = $_POST["eventDescription"];
    $eventLocation = $_POST["eventLocation"];
    $eventOrganizer = $_POST["eventOrganizer"];

    // Store the event data in a text file (you should use a database in a real application)
    $eventData = "Event Title: $eventTitle\nEvent Date: $eventDate\nEvent Description: $eventDescription\nEvent Location: $eventLocation\nEvent Organizer: $eventOrganizer\n\n";
    file_put_contents("events.txt", $eventData, FILE_APPEND);

    echo "Event posted successfully!";
}
?>
