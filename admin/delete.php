<?php

include("../config/db.php");

$id = $_GET['id'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM admit_cards WHERE id='$id'"
);

$row = mysqli_fetch_assoc($query);

$file = "../uploads/admitcards/" . $row['pdf_file'];

if(file_exists($file))
{
    unlink($file);
}

mysqli_query(
    $conn,
    "DELETE FROM admit_cards WHERE id='$id'"
);

header("Location: dashboard.php");

?>