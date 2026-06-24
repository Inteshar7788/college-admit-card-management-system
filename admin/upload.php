<?php

include("../config/db.php");

if(isset($_POST['upload']))
{
    $student_name = $_POST['student_name'];
    $roll_no = $_POST['roll_no'];
    $course = $_POST['course'];
    $year_sem = $_POST['year_sem'];

    $pdf_name = $_FILES['pdf']['name'];
    $tmp_name = $_FILES['pdf']['tmp_name'];

    move_uploaded_file(
        $tmp_name,
        "../uploads/admitcards/".$pdf_name
    );

    $sql = "INSERT INTO admit_cards
    (student_name, roll_no, course, year_sem, pdf_file)

    VALUES

    ('$student_name',
     '$roll_no',
     '$course',
     '$year_sem',
     '$pdf_name')";

    mysqli_query($conn,$sql);

    echo "<script>alert('Admit Card Uploaded Successfully');</script>";
}

?>




<!DOCTYPE html>
<html>
<head>
<title>Upload Admit Card</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header">
<h3>Upload Admit Card</h3>
</div>

<div class="card-body">

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">
<label>Student Name</label>
<input type="text" name="student_name" class="form-control">
</div>

<div class="mb-3">
<label>Roll Number</label>
<input type="text" name="roll_no" class="form-control">
</div>

<div class="mb-3">
<label>Course</label>
<input type="text" name="course" class="form-control">
</div>

<div class="mb-3">
<label>Year/Semester</label>
<input type="text" name="year_sem" class="form-control">
</div>

<div class="mb-3">
<label>Choose PDF</label>
<input type="file" name="pdf" class="form-control">
</div>

<button
type="submit"
name="upload"
class="btn btn-success">

Upload Admit Card

</button>

</form>

</div>

</div>

</div>

</body>
</html>