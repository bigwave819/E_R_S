<?php

$conn =new mysqli("localhost", "root", "", "emp_recruitment");

if ($conn) {
    echo "<script>window.alert('successively connected to the database')</script>";
}

?>