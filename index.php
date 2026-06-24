<?php
include("config/db.php");

$result = null;

if(isset($_POST['search']))
{
    $roll_no = $_POST['roll_no'];
    $course = $_POST['course'];
    $year_sem = $_POST['year_sem'];

    $sql = "SELECT * FROM admit_cards
            WHERE roll_no='$roll_no'
            AND course='$course'
            AND year_sem='$year_sem'";

    $result = mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>College Admit Card Portal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header text-center">
            <h2>College Admit Card Portal</h2>
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Roll Number</label>
                    <input type="text"
                           name="roll_no"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Course</label>

                    <select name="course"
                            class="form-control"
                            required>
                        <option value="">Select Course</option>
                        <option>BCA</option>
                        <option>BBA</option>
                        <option>BA</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Year/Semester</label>

                    <select name="year_sem"
                            class="form-control"
                            required>
                        <option value="">Select Year</option>
                        <option>1 Year</option>
                        <option>2 Year</option>
                        <option>3 Year</option>
                    </select>
                </div>

                <button type="submit"
                        name="search"
                        class="btn btn-primary">
                    Search Admit Card
                </button>

            </form>

            <br>

            <?php

            if($result && mysqli_num_rows($result) > 0)
            {
                $row = mysqli_fetch_assoc($result);

                echo "
                <div class='alert alert-success'>
                    <h5>Admit Card Found</h5>

                    <p><b>Student Name:</b> ".$row['student_name']."</p>
                    <p><b>Roll Number:</b> ".$row['roll_no']."</p>
                    <p><b>Course:</b> ".$row['course']."</p>
                    <p><b>Year:</b> ".$row['year_sem']."</p>

                    <a href='uploads/".$row['pdf_file']."'
                       target='_blank'
                       class='btn btn-success'>
                       Download Admit Card
                    </a>
                </div>
                ";
            }
            elseif(isset($_POST['search']))
            {
                echo "
                <div class='alert alert-danger'>
                    Admit Card Not Found
                </div>
                ";
            }

            ?>

        </div>

    </div>

</div>

</body>
</html>