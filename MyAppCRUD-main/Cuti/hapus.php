<?php
include '../koneksi.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM cuti WHERE id=$id");
header("Location: list.php");
