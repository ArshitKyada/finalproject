<?php
include_once 'preloader.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f3f4f6;
        margin: 0;
        padding: 0;
    }

    body::-webkit-scrollbar {
        display: none;
    }

    /* Banner Section */
    .banner {
        position: relative;
        width: 100%;
        height: 300px;
        overflow: hidden;
    }

    .banner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    main {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .card {
        background-color: white;
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .card .content {
        padding: 1rem;
    }

    .card .content .date {
        background-color: #22c55e;
        color: white;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        display: inline-block;
        margin-bottom: 0.5rem;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 2rem;
    }

    .pagination a {
        padding: 0.5rem 1rem;
        border: 1px solid #d1d5db;
        color: #6b7280;
        text-decoration: none;
        border-radius: 0.25rem;
        margin: 0 0.25rem;
    }

    .card a {
        text-decoration: none;
        color:black;
    }
    </style>
</head>

<body>
    <?php include_once 'header.php' ?>

    <div class="banner">
        <img src="images/banner.png" alt="Banner Image">
    </div>

    <main>
        <div class="grid">
            <div class="card">
                <a href="blog/blog1.html">
                    <img src="images/blog1.jpg" alt="Colorful plants on a white table">
                    <div class="content">
                        <span class="date">November 3, 2022</span>
                        <h2>An Introvert’s Guide to Be Successful at Work</h2>
                    </div>
                </a>
            </div>

            <div class="card">
                <a href="blog/blog2.html">
                    <img src="images/blog2.jpg" alt="Workspace with computer and decorations">
                    <div class="content">
                        <span class="date">November 3, 2022</span>
                        <h2>Why You Should (Often) Pay More for Links</h2>
                    </div>
                </a>
            </div>

            <div class="card">
                <a href="blog/blog3.html">
                    <img src="images/blog3.jpg" alt="Word 'CREATE' in wooden letters">
                    <div class="content">
                        <span class="date">October 29, 2022</span>
                        <h2>David Droga Still Has Faith in Online Creative.</h2>
                    </div>
                </a>
            </div>

            <div class="card">
                <a href="blog/blog4.html">
                    <img src="images/blog4.jpg" alt="Sunset over mountains">
                    <div class="content">
                        <span class="date">October 25, 2022</span>
                        <h2>How Nature Inspires Creative Thinking</h2>
                    </div>
                </a>
            </div>

            <div class="card">
                <a href="blog/blog5.html">
                    <img src="images/blog5.jpg" alt="People working in a team">
                    <div class="content">
                        <span class="date">October 20, 2022</span>
                        <h2>The Importance of Collaboration in Business</h2>
                    </div>
                </a>
            </div>

            <div class="card">
                <a href="blog/blog6.html">
                    <img src="images/blog6.jpg" alt="People working in a team">
                    <div class="content">
                        <span class="date">October 10, 2022</span>
                        <h2>What We Do When Everyone Gets It Wrong!</h2>
                    </div>
                </a>
            </div>
        </div>

        <div class="pagination">
            <a href="#">01</a>
            <a href="#">02</a>
            <a href="#"><i class="fas fa-chevron-right"></i></a>
        </div>
    </main>

    <?php include_once 'footer.php'; ?>
</body>

</html>