<?php
// Create connection
$conn = mysqli_connect('localhost', 'root', '', 'ajaxphp') or die('Connection is failed');

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
