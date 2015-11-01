<?php
// The JSON standard MIME header.
header('Content-type: application/json');

// This ID parameter is sent by our javascript client.
$id = $_POST['id'];

// Here's some data that we want to send via JSON.
// We'll include the $id parameter so that we
// can show that it has been passed in correctly.
// You can send whatever data you like.
$data = array("Hello", $id);

// Send the data.
echo json_encode($data);

?>
