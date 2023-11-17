<?php
include "koneksi.php";

//Buat article
function createArticle($title, $content, $img) {
    global $conn;
    $query = "INSERT INTO article (article_name, article_content, article_image) VALUES ('$title', '$content','$img')";
    return mysqli_query($conn, $query);
}

//Select article
function readArticle($id) {
    global $conn;
    $query = "SELECT * FROM article WHERE id='$id'";
    return mysqli_fetch_array(mysqli_query($conn, $query));
}

//Update article
function updateArticle($id, $title, $content, $img) {
    global $conn;
    $query = "UPDATE article SET article_name='$title', article_content='$content', article_image='$img' WHERE id='$id'";
    return mysqli_query($conn, $query);
}

// Delete article
function deleteArticle($id) {
    global $conn;
    $query = "DELETE FROM article WHERE id='$id'";
    return mysqli_query($conn, $query);
}

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