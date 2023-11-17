<?php
include "koneksi.php";

//Top 3 articles
function getTopArticles() {
    global $conn;
    $query = "SELECT * FROM article ORDER BY article_release DESC LIMIT 3";
    return mysqli_query($conn, $query);
}

//Semua articles
function getAllArticles() {
    global $conn;
    $query = "SELECT * FROM article ORDER BY article_release DESC";
    return mysqli_query($conn, $query);
}
?>