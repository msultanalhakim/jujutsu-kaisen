<?php
    include "connection.php";
    session_start();
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Jujutsu Kaisen - Shibuya Incident</title>
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <link rel="icon" href="assets/icon/jujutsu-kaisen-highschool.ico"/>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body{background-color: rgba(13, 13, 13);}
        </style>
    </head>
    <body>
        <?php include('navbar.php'); ?>
        <div class="article-page">
            <div class="container-article">
                <div class="sub-article">
                    <h2>Article Lists <span> Jujutsu Kaisen</span></h2>
                    <div class="article-item">
                        <ul>
                            <li><img src="assets/images/articles/article-01.png" alt=""></li>
                            <li class="right">
                                <a href="" class="btn-news">News</a>
                                <a href=""><h2>Yuji Itadori di Jujutsu Kaisen, Siapakah Dia?</h2></a>
                                <span>September 24, 2023</span>
                            </li>
                        </ul>
                    </div>
                    <div class="article-item">
                        <ul>
                            <li><img src="assets/images/articles/article-02.jpeg" alt=""></li>
                            <li class="right">
                                <a href="" class="btn-news">News</a>
                                <a href=""><h2>Kematian Gojo Satoru, Begini Komentar Komikus!</h2></a>
                                <span>September 25, 2023</span>
                            </li>
                        </ul>
                    </div>
                    <div class="article-item">
                        <ul>
                            <li><img src="assets/images/articles/article-03.jpeg" alt=""></li>
                            <li class="right">
                                <a href="" class="btn-news">News</a>
                                <a href=""><h2>Penjelasan Akhir Film Jujutsu Kaisen!</h2></a>
                                <span>March 24, 2023</span>
                            </li>
                        </ul>
                    </div>
                    <div class="article-pagination">
                        <a href="" class="btn-pagination">&lt;</a>
                        <a href="" class="btn-pagination">2</a>
                        <a href="" class="btn-pagination">3</a>
                        <a href="" class="btn-pagination">4</a>
                        <a href="" class="btn-pagination">&gt;</a>
                    </div>
                </div>
                <!--
                <div class="sidebar-article">
                    <div class="sidebar-content">
                        <h2>Popular Article</h2>
                        <div class="sidebar-item">
                            <a href=""><ul>
                                <li><img src="assets/images/articles/article-01.png"></li>
                                <li><h4>Yuji Itadori di Jujutsu Kaisen, siapakah dia?</h4></li>
                                <li><span>September 27, 2023</span></li>
                            </ul></a>
                        </div>
                        <div class="sidebar-item">
                            <a href=""><ul>
                                <li><img src="assets/images/articles/article-02.jpeg"></li>
                                <li><h4>Kematian Gojo Satoru, Begini Komentar Komikus!</h4></li>
                                <li><span>September 25, 2023</span></li>
                            </ul></a>
                        </div>
                        <div class="sidebar-item">
                            <a href=""><ul>
                                <li><img src="assets/images/articles/article-03.jpeg"></li>
                                <li><h4>Penjelasan Akhir Film Jujutsu Kaisen!</h4></li>
                                <li><span>March 25, 2023</span></li>
                            </ul></a>
                        </div>
                        <div class="sidebar-item">
                            <a href=""><ul>
                                <li><img src="assets/images/articles/article-01.png"></li>
                                <li><h4>Yuji Itadori di Jujutsu Kaisen, siapakah dia?</h4></li>
                                <li><span>27 December 2023</span></li>
                            </ul></a>
                        </div>
                    </div>
                </div>-->
        </div>
    </div>
    <div class="footer" id="footer">
        &copy; Jujutsu Kaisen 2023. All rights reserved.
    </div>
        <script src="assets/js/script.js"></script>
    </body>
</html>