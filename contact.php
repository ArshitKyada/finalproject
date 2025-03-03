<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auctioneers</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Adding background color to the contact section */
        .contact-section {
            background-color: #f3f4f6;
            padding: 40px 20px;
        }
        
        .contact-header h1 {
            text-align: center;
            color: #0a2e79;
        }
        
        .contact-container {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }
        
        .contact-info {
            flex: 1;
            padding-right: 20px;
        }
        
        .info-item {
            margin-bottom: 20px;
        }
        
        .info-item i {
            font-size: 24px;
            color: #0a2e79;
            margin-right: 10px;
        }
        
        .info-item h3 {
            color: #0a2e79;
            font-size: 18px;
            margin-bottom: 5px;
        }
        
        .info-item p {
            font-size: 14px;
            color: #333;
        }
        
        .contact-form {
            flex: 1;
            padding-left: 20px;
        }
        
        .contact-form h3 {
            color: #0a2e79;
            margin-bottom: 20px;
        }
        
        .contact-form form input,
        .contact-form form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        .contact-form form button {
            background-color: #0a2e79;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .contact-form form button:hover {
            background-color: #083b6b;
        }
    </style>
</head>

<body>
    <div class="contact-section" id="contact">
        <div class="contact-header">
            <h1>Contact Us</h1>
        </div>
        <div class="contact-container">
            <div class="contact-info">
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>Address</h3>
                    <p>224-Rise on plaza,<br> Surat, Gujarat, India 395006</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-phone-alt"></i>
                    <h3>Call Us</h3>
                    <p>+91 5589554885<br> +91 6678254445 </p>
                </div>
                <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <h3>Email Us</h3>
                    <p>info@example.com<br> contact@example.com</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-clock"></i>
                    <h3>Opening Hours</h3>
                    <p>Monday - Friday<br> 9:00AM - 05:00PM</p>
                </div>
            </div>
            <div class="contact-form">
                <h3>Send Us a Message</h3>
                <form style="padding-right: 20px;">
                    <input type="text" placeholder="Your Name" required>
                    <input type="email" placeholder="Your Email" required>
                    <input type="text" placeholder="Subject">
                    <textarea placeholder="Message" required></textarea>
                    <button type="submit">Send Message</button>
                </form>
            </div>
        </div>
    </div>

    <?php 
        include 'footer.php';
    ?>
</body>

</html>
