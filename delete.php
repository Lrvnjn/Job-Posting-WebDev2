<?php
require_once 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM jobs WHERE id='$id'";
    mysqli_query($con, $query);

    header('Location: posts.php');
}
?>