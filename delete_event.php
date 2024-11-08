<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $sql = "DELETE FROM events WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "กิจกรรมถูกลบเรียบร้อยแล้ว";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
