<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auctioneers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    .auction-footer {
        background-color: #0A3D62;
        background: #0A3D62 url(images/footer-bg.png) no-repeat right;
        background-size: contain;
        color: #fff;
        font-family: 'Arial', sans-serif;
        padding: 40px 20px;
        border-top: 3px solid black;
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
        color: rgb(255, 255, 255);
        font-size: 18px;
        margin-bottom: 15px;
        font-weight: bold;
    }

    .footer-section p {
        font-size: 14px;
        line-height: 1.6;
        color: #fff;
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
        color: rgb(255, 255, 255);
        transition: color 0.3s ease;
    }

    .footer-section ul li a:hover {
        color: rgb(162, 207, 255);
    }

    .footer-section ul li i {
        color: rgb(255, 255, 255);
    }

    .social-links a {
        text-decoration: none;
        margin-right: 10px;
        color: #fff;
        font-size: 18px;
        transition: color 0.3s ease;
    }

    .social-links a:hover {
        color: #a2cfff;
    }

    .footer-bottom {
        background-color: rgb(0, 0, 0);
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        border-top: 1px solid white;
        font-size: 14px;
        color: #fff;
    }

    .payment-methods {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .payment-methods p {
        margin: 0;
        width: 100px;
    }

    .payment-logo {
        height: 40px;
        width: auto;
        display: block;
    }

    .footer-bottom p {
        margin: 0;
        color: #fff;
    }


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

            <div class="footer-section quick-links">
                <h4>Quick Links</h4>
                <ul>
                    <li><i class="fas fa-home"></i><a href="index.php">Home</a></li>
                    <li><i class="fas fa-info-circle"></i><a href="about.php">About Us</a></li>
                    <li><i class="fas fa-gavel"></i><a href="auctions.php">Auctions</a></li>
                    <li><i class="fas fa-tags"></i><a href="#">Pricing</a></li>
                    <li><i class="fas fa-envelope"></i><a href="#contact">Contact</a></li>
                </ul>
            </div>

            <div class="footer-section contact-information">
                <h4>Contact Us</h4>
                <p><i class="fas fa-map-marker-alt"></i> 224, Rise on Plaza <br> Surat, Gujarat-395006,<br> India</p>
                <p><i class="fas fa-phone"></i> +91 6355470610</p>
                <p><i class="fas fa-envelope"></i> support@auctioneers.com</p>
            </div>
        </div>
    </footer>
    <div class="footer-bottom">
        <p>&copy; 2025 Auctioneers. All Rights Reserved.</p>
        <div class="payment-methods">
            <p>We Accept:</p>
            <a href="#" target="_blank"><img src="images/visa.png" alt="Visa" class="payment-logo"></a>
            <a href="#" target="_blank"><img src="images/mastercard.png" alt="MasterCard" class="payment-logo"></a>
            <a href="#" target="_blank"><img src="images/paypal.png" alt="PayPal" class="payment-logo"></a>
            <a href="#" target="_blank"><img src="images/gpay.png" alt="Discover" class="payment-logo"></a>
        </div>
    </div>

</body>

</html>