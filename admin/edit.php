<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include("../config/db.php");

$id = $_GET['id'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM admit_cards WHERE id='$id'"
);

$row = mysqli_fetch_assoc($query);

if(isset($_POST['update']))
{
    $student_name = $_POST['student_name'];
    $roll_no = $_POST['roll_no'];
    $course = $_POST['course'];
    $year_sem = $_POST['year_sem'];

    if($_FILES['pdf_file']['name'] != "")
    {
        $new_pdf = $_FILES['pdf_file']['name'];
        $tmp_pdf = $_FILES['pdf_file']['tmp_name'];

        move_uploaded_file(
            $tmp_pdf,
            "../uploads/admitcards/" . $new_pdf
        );

        mysqli_query(
            $conn,
            "UPDATE admit_cards SET
            student_name='$student_name',
            roll_no='$roll_no',
            course='$course',
            year_sem='$year_sem',
            pdf_file='$new_pdf'
            WHERE id='$id'"
        );
    }
    else
    {
        mysqli_query(
            $conn,
            "UPDATE admit_cards SET
            student_name='$student_name',
            roll_no='$roll_no',
            course='$course',
            year_sem='$year_sem'
            WHERE id='$id'"
        );
    }

    header("Location: dashboard.php");
    exit();
}
?><!DOCTYPE html><html>
<head>
    <title>Edit Admit Card</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head><body class="bg-light"><div class="container mt-5"><div class="card shadow">

    <div class="card-header">
        <h3>Edit Admit Card</h3>
    </div>

    <div class="card-body">

        <form method="POST" enctype="multipart/form-data">

            <div class="mb-3">
                <label>Student Name</label>
                <input type="text"
                       name="student_name"
                       class="form-control"
                       value="<?php echo $row['student_name']; ?>"
                       required>
            </div>

            <div class="mb-3">
                <label>Roll Number</label>
                <input type="text"
                       name="roll_no"
                       class="form-control"
                       value="<?php echo $row['roll_no']; ?>"
                       required>
            </div>

            <div class="mb-3">
                <label>Course</label>
                <input type="text"
                       name="course"
                       class="form-control"
                       value="<?php echo $row['course']; ?>"
                       required>
            </div>

            <div class="mb-3">
                <label>Year / Semester</label>
                <input type="text"
                       name="year_sem"
                       class="form-control"
                       value="<?php echo $row['year_sem']; ?>"
                       required>
            </div>

            <div class="mb-3">
                <label>Replace PDF (Optional)</label>
                <input type="file"
                       name="pdf_file"
                       class="form-control">
            </div>

            <button type="submit"
                    name="update"
                    class="btn btn-primary">
                Update Record
            </button>

            <a href="dashboard.php"
               class="btn btn-secondary">
                Back
            </a>

        </form>

    </div>

</div>

</div></body>
</html>