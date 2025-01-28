<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auctioneers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    .auction-footer {
        background-color: #f8f9fa;
        background: white url(https://res.cloudinary.com/dwrwnflkr/image/upload/v1681807803/footer-bg_k69qz5.png) no-repeat right;
        background-size: contain;
        color: #333;
        font-family: 'Arial', sans-serif;
        padding: 40px 20px;
        border-top: 1px solid #ddd;
    }


    .footer-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        max-width: 1200px;
        margin: 0 auto;
    }

    .footer-section {
        margin: 20px;
        box-sizing: border-box;
    }

    .about-section {
        flex: 0 0 40%;
        max-width: 40%;
    }

    .quick-links,
    .contact-information {
        flex: 0 0 20%;
        max-width: 20%;
    }

    .footer-section h3,
    .footer-section h4 {
        color: #0a2e79;
        font-size: 18px;
        margin-bottom: 15px;
        font-weight: bold;
    }

    .footer-section p {
        font-size: 14px;
        line-height: 1.6;
        color: #555;
    }

    .footer-section ul {
        list-style: none;
        padding: 0;
    }

    .footer-section ul li {
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .footer-section ul li a {
        text-decoration: none;
        color: #0a2e79;
        transition: color 0.3s ease;
    }

    .footer-section ul li a:hover {
        color: #0056b3;
    }

    .footer-section ul li i {
        color: #0a2e79;
    }

    .social-links a {
        text-decoration: none;
        margin-right: 10px;
        color: #555;
        font-size: 18px;
        transition: color 0.3s ease;
    }

    .social-links a:hover {
        color: #0a2e79;
    }

    .footer-bottom {
        background-color: white;
        text-align: center;
        padding-top: 20px;
        padding-bottom: 20px;
        border-top: 1px solid black;
        font-size: 14px;
        color: #666;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .footer-container {
            flex-direction: column;
            align-items: inline;
        }

        .footer-section {
            flex: 1 0 100%;
            max-width: 100%;
            margin: 10px 0;
        }
    }
    </style>
</head>

<body>
    <footer class="auction-footer">
        <div class="footer-container">
            <!-- About Section -->
            <div class="footer-section about-section">
                <h3>Auctioneers</h3>
                <p>
                    Auctioneers is your trusted partner for seamless online auction management.
                    We provide tools and services for managing auctions, connecting buyers and sellers,
                    and ensuring a secure and transparent experience for everyone.
                </p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-section quick-links">
                <h4>Quick Links</h4>
                <ul>
                    <li><i class="fas fa-home"></i><a href="#">Home</a></li>
                    <li><i class="fas fa-info-circle"></i><a href="#">About Us</a></li>
                    <li><i class="fas fa-gavel"></i><a href="#">Auctions</a></li>
                    <li><i class="fas fa-tags"></i><a href="#">Pricing</a></li>
                    <li><i class="fas fa-envelope"></i><a href="#contact">Contact</a></li>
                </ul>
            </div>

            <!-- Contact Information -->
            <div class="footer-section contact-information">
                <h4>Contact Us</h4>
                <p><i class="fas fa-map-marker-alt"></i> 224, Rise on Plaza <br> Surat, Gujarat-395006,<br> India</p>
                <p><i class="fas fa-phone"></i> +91 6355470610</p>
                <p><i class="fas fa-envelope"></i> support@auctioneers.com</p>
            </div>
        </div>

        
    </footer>
    <div class="footer-bottom">
            <p>&copy; 2025 AuctioneerHub. All Rights Reserved.</p>
        </div>
</body>

</html>