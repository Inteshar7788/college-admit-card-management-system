<?php
session_start();

if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include("../config/db.php");
?>




<?php


if(!isset($_SESSION['admin']))
{
    header("Location: login.php");
    exit();
}

include("../config/db.php");

$count_query = mysqli_query($conn, "SELECT * FROM admit_cards");
$total_cards = mysqli_num_rows($count_query);
?>




<?php
include("../config/db.php");

$count_query = mysqli_query($conn, "SELECT * FROM admit_cards");
$total_cards = mysqli_num_rows($count_query);
?><!DOCTYPE html><html>
<head>
    <title>Admin Dashboard</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{
    background:#f4f6f9;
}

.top-header{
    background:linear-gradient(135deg,#0d6efd,#0dcaf0);
    padding:20px;
}

.logo{
    width:70px;
    height:70px;
    border-radius:50%;
    background:white;
    padding:5px;
}

.navbar-custom{
    background:#111827;
}

.card{
    border:none;
    border-radius:15px;
    transition:0.3s;
}

.card:hover{
    transform:translateY(-5px);
}

.table{
    background:white;
}

.table thead{
    background:#0d6efd;
    color:white;
}

.btn{
    border-radius:8px;
}

.footer{
    background:#111827;
    color:white;
    text-align:center;
    padding:15px;
    margin-top:40px;
}
</style>
</head>
<body class="bg-light">
    <!-- College Header -->

    <div class="bg-primary text-white py-3 shadow">

        <div class="container">

            <div class="d-flex align-items-center">





                <div>

                    <h2 class="mb-0">
                        A P J ABDUL KALAM DEGREE & LAW COLLEGE
                    </h2>

                    <small>
                        Admit Card Management Portal
                    </small>

                </div>

            </div>

        </div>

    </div>

    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <div class="container">

            <a class="navbar-brand" href="dashboard.php">
                Admin Dashboard
            </a>

            <div class="ms-auto">

                <a href="dashboard.php"
                   class="btn btn-outline-light me-2">
                   Dashboard
                </a>

                <a href="upload.php"
                               class="btn btn-outline-light me-2">
                               Upload
                            </a>

                <a href="logout.php"
                   class="btn btn-danger">
                   Logout
                </a>

            </div>

        </div>

    </nav>

    <div class="container mt-5">

        <div class="text-center mb-4">
            <h2 class="fw-bold">
                College Admit Card Admin Panel
            </h2>

            <p class="text-muted">
                Manage Student Admit Cards Efficiently
            </p>
        </div>


<div class="row">

    <div class="col-md-4">
        <div class="card bg-primary text-white shadow">
            <div class="card-body">
                <h5>Total Admit Cards</h5>
                <h1><?php echo $total_cards; ?></h1>
            </div>
        </div>
    </div>

    <div class="col-md-4">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <h5>Upload Admit Card</h5>

                    <a href="upload.php" class="btn btn-light mt-2">
                        Open Upload Page
                    </a>
                </div>
            </div>
        </div>

</div>

<hr class="mt-5">

<h3>All Admit Cards</h3>

<form method="GET" class="mb-3"><div class="row">

    <div class="col-md-4">
        <input type="text"
               name="search"
               class="form-control"
               placeholder="Search by Name or Roll No">
    </div>

    <div class="col-md-2">
        <button type="submit"
                class="btn btn-primary">
            Search
        </button>
    </div>

</div>

</form>

<table class="table table-bordered table-striped mt-3">

    <thead>
        <tr>
            <th>ID</th>
            <th>Student Name</th>
            <th>Roll No</th>
            <th>Course</th>
            <th>Year</th>
            <th>PDF</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

    <?php

    if(isset($_GET['search']))
    {
    $search = $_GET['search'];

    $query = mysqli_query(
        $conn,
        "SELECT * FROM admit_cards
         WHERE student_name LIKE '%$search%'
         OR roll_no LIKE '%$search%'
         ORDER BY id DESC"
    );

    }
    else
    {
    $query = mysqli_query(
    $conn,
    "SELECT * FROM admit_cards
    ORDER BY id DESC"
    );
    }

    while($row = mysqli_fetch_assoc($query))
    {
    ?>

        <tr>

            <td><?php echo $row['id']; ?></td>

            <td><?php echo $row['student_name']; ?></td>

            <td><?php echo $row['roll_no']; ?></td>

            <td><?php echo $row['course']; ?></td>

            <td><?php echo $row['year_sem']; ?></td>

            <td>
                <a href="../uploads/admitcards/<?php echo $row['pdf_file']; ?>"
                   target="_blank"
                   class="btn btn-success btn-sm">

                   View PDF

                </a>
            </td>
        <td>
                <a href="edit.php?id=<?php echo $row['id']; ?>"
                   class="btn btn-warning btn-sm">
                   Edit
                </a>
            </td>

        <td>
            <a href="delete.php?id=<?php echo $row['id']; ?>"
               class="btn btn-danger btn-sm"
               onclick="return confirm('Are you sure?')">

               Delete

            </a>
        </td>


        </tr>

    <?php
    }
    ?>

    </tbody>

</table>

</div>
<footer class="bg-dark text-white text-center py-3 mt-5">

    © <?php echo date("Y"); ?> A P J ABDUL KALAM DEGREE COLLEGE

    <br>

    <small>
        Admit Card Management Portal | Developed by An Engineer
    </small>

</footer>
</body>
</html>