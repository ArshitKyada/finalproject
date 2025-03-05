<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recent News</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body.news-page {
            margin: 0;
            padding: 0;
        }
        .news-container {
            max-width: 1200px;
            background-color: #f3f4f6;
            margin: 0 auto;
            padding: 3rem 1rem;
        }
        .news-text-center {
            text-align: center;
            margin-bottom: 3rem;
        }
        .news-text-center h2 {
            font-size: 1.875rem;
            font-weight: bold;
            color: #2d3748;
        }
        .news-text-center p {
            color: #718096;
            margin-top: 0.5rem;
        }
        .news-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }
        @media (max-width: 992px) {
            .news-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 600px) {
            .news-grid {
                grid-template-columns: repeat(1, 1fr);
            }
        }
        .news-card {
            background-color: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .news-card img {
            width: 100%;
            height: 12rem;
            object-fit: cover;
        }
        .news-card-content {
            padding: 1rem;
        }
        .news-date {
            background-color: #16a34a;
            color: #fff;
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .news-card h3 {
            font-size: 1.125rem;
            font-weight: bold;
            color: #2d3748;
            margin-top: 0.75rem;
        }
        .news-author {
            display: flex;
            align-items: center;
            color: #4a5568;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }
        .news-author img {
            width: 1.5rem;
            height: 1.5rem;
            border-radius: 9999px;
            margin-right: 0.5rem;
        }
        .news-comments {
            margin-left: 1rem;
        }
        .news-text-gray {
            color: #4a5568;
        }
    </style>
</head>
<body class="news-page">
    <div class="news-container">
        <div class="news-text-center">
            <h2>Our Recent News</h2>
            <p>Explore the world’s best & largest Bidding marketplace with our beautiful Bidding products.</p>
        </div>
        <div class="news-grid">
            <div class="news-card">
                <img src="https://storage.googleapis.com/a1aa/image/OGA92f8HwXGUj_N99VqgllUjt9AzYEKBhoK5T4ReP0U.jpg" alt="News Image">
                <div class="news-card-content">
                    <div class="news-date"><i class="far fa-calendar-alt"></i> September 21, 2022</div>
                    <h3>A brand for a company is like for a person.</h3>
                    <div class="news-author">
                        <img src="https://storage.googleapis.com/a1aa/image/rU2_5wfeB1Fpx5oRdasFhqLzkqcPAy02x5d2wiX1xtI.jpg" alt="Author">
                        <span class="news-comments"><i class="far fa-comments"></i> 2 Comments</span>
                    </div>
                    <p class="news-text-gray">Explore the world’s best & largest Bidding marketplace with our Bidding products.</p>
                </div>
            </div>
            <div class="news-card">
                <img src="https://storage.googleapis.com/a1aa/image/D5nRJQUERzF1ZbZujfGn6K0wL0AetiHPhn6Q7YOWdPU.jpg" alt="News Image">
                <div class="news-card-content">
                    <div class="news-date"><i class="far fa-calendar-alt"></i> October 29, 2022</div>
                    <h3>New! A Stain Remover That Works Like Magic!</h3>
                    <div class="news-author">
                        <img src="https://storage.googleapis.com/a1aa/image/rU2_5wfeB1Fpx5oRdasFhqLzkqcPAy02x5d2wiX1xtI.jpg" alt="Author">
                        <span class="news-comments"><i class="far fa-comments"></i> 0 Comments</span>
                    </div>
                    <p class="news-text-gray">Explore the world’s best & largest Bidding marketplace with our Bidding products.</p>
                </div>
            </div>
            <div class="news-card">
                <img src="https://storage.googleapis.com/a1aa/image/AbHiUahAOb9Cvqq4XukFVT8-d7kEZrFwp3QT9MYikyg.jpg" alt="News Image">
                <div class="news-card-content">
                    <div class="news-date"><i class="far fa-calendar-alt"></i> October 29, 2022</div>
                    <h3>The Secrets Of Millionaires At The Age Of 29!</h3>
                    <div class="news-author">
                        <img src="https://storage.googleapis.com/a1aa/image/rU2_5wfeB1Fpx5oRdasFhqLzkqcPAy02x5d2wiX1xtI.jpg" alt="Author">
                        <span class="news-comments"><i class="far fa-comments"></i> 0 Comments</span>
                    </div>
                    <p class="news-text-gray">Explore the world’s best & largest Bidding marketplace with our Bidding products.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>