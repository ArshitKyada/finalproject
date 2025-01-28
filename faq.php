<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auctioneers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    .faq-wrapper {
        font-family: Arial, sans-serif;
        background-color: #fff;
        color: #333;
        padding: 20px;
        height: 450px;
        overflow-y: auto; /* Add scrolling for excess content */
    }

    .faq-wrapper .faq-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .faq-wrapper .faq-header h1 {
        font-size: 36px;
        color: #0a2e79;
    }

    .faq-wrapper .faq-header p {
        font-size: 14px;
        color: #0a2e79;
        font-weight: bold;
    }

    .faq-wrapper .faq-section {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 20px;
    }

    .faq-wrapper .faq-column {
        flex: 1;
        min-width: 48%;
        max-width: 48%;
    }

    .faq-wrapper .faq-item {
        margin-bottom: 10px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .faq-wrapper .faq-item:hover {
        background-color: #e6f7ff;
        border-color: #0a2e79;
    }

    .faq-wrapper .faq-item h2 {
        font-size: 18px;
        color: #0a2e79;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 0;
    }

    .faq-wrapper .faq-item h2 i {
        font-size: 14px;
    }

    .faq-wrapper .faq-item p {
        display: none;
        font-size: 14px;
        color: #333;
        margin-top: 10px;
        line-height: 1.6;
    }

    .faq-wrapper .faq-item.active p {
        display: block;
    }

    @media (max-width: 768px) {
        .faq-wrapper .faq-column {
            min-width: 100%;
            max-width: 100%;
        }
    }
</style>

</head>

<body>
    <div class="faq-wrapper" id="faq">
        <div class="faq-header">
            <p>F.A.Q</p>
            <h1>Frequently Asked Questions</h1>
        </div>
        <div class="faq-section">
            <div class="faq-column">
                <div class="faq-item">
                    <h2>What types of items can be sold on an online auction platform? <i
                            class="fas fa-chevron-down"></i>
                    </h2>
                    <p>Almost anything can be sold on our auction platform, including antiques, art, collectibles,
                        electronics, and more.</p>
                </div>
                <div class="faq-item">
                    <h2>How do I participate in an auction? <i class="fas fa-chevron-down"></i></h2>
                    <p>To participate in an auction, you need to register on our platform, browse the available items,
                        and place your bids.</p>
                </div>
                <div class="faq-item">
                    <h2>What happens if I win an item in an auction? <i class="fas fa-chevron-down"></i></h2>
                    <p>If you win an item in an auction, you will receive an email with instructions on how to complete
                        the purchase and arrange for delivery.</p>
                </div>
            </div>
            <div class="faq-column">
                <div class="faq-item">
                    <h2>What is a reserve price in an auction? <i class="fas fa-chevron-down"></i></h2>
                    <p>A reserve price is the minimum amount that the seller is willing to accept for an item. If the
                        bidding does not reach this price, the item will not be sold.</p>
                </div>
                <div class="faq-item">
                    <h2>What payment method are accepted?<i
                            class="fas fa-chevron-down"></i></h2>
                    <p>We accept various payment methods, including credit cards, debit cards, PayPal, and bank transfers. Specific payment options may vary depending on the seller and the item's location.</p>
                </div>
                <div class="faq-item">
                    <h2>How does an online auction work? <i class="fas fa-chevron-down"></i></h2>
                    <p>Online auctions work similarly to traditional auctions. The auctioneer will post items for sale,
                        and users can bid on those items in real-time. The highest bidder at the end of the auction wins
                        the item and gets contacted via email.</p>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.querySelectorAll('.faq-item').forEach(item => {
        item.addEventListener('click', () => {
            // Close all other FAQ items
            document.querySelectorAll('.faq-item').forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });

            // Toggle the clicked FAQ item
            item.classList.toggle('active');
        });
    });
    </script>
</body>

</html>