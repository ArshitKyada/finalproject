<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Client Testimonials</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

    <style>
    .commentsection {
        padding: 3rem 0;
        text-align: center;
        background-color:white;
    }

    .comment-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    h2 {
        font-size: 40px;
        font-weight: bold;
        color: #2d3748;
        margin-bottom: 1px;
    }

    p {
        width: 80%;
        font-size: 16px;
        color: #4a5568;
        margin-top: 0;
    }


    .button {
        padding: 0.5rem;
        border-radius: 9999px;
        border: 1px solid #d1d5db;
        background-color: #fff;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .button i {
        color: rgb(0, 0, 0);
    }
    
    .button i:hover{
        color: rgb(255, 255, 255);
    }

    .button:hover {
        background-color: #0A3D62;
    }

    .testimonial-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
    }

    @media (min-width: 768px) {
        .testimonial-container {
            flex-direction: row;
        }
    }

    .testimonial-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 1rem;
    }

    @media (min-width: 768px) {
        .testimonial-wrapper {
            flex-direction: row;
        }
    }

    .testimonial-card {
        background-color: white;
        padding: 1.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 20rem;
        width: 100%;
        text-align: left;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 15rem;
        position: relative;
        transition: all 0.3s ease-in-out;
    }

    .testimonial-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 0%;
        height: 4px;
        background-color: #0A3D62;
        transition: width 0.3s ease-in-out;
    }

    .testimonial-card:hover::before {
        width: 100%;
    }

    .testimonial-header {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    .testimonial-header img {
        width: 3rem;
        height: 3rem;
        border-radius: 50%;
        margin-right: 1rem;
    }

    .testimonial-header h3 {
        font-size: 1.125rem;
        font-weight: bold;
        color: #2d3748;
        margin: 0;
    }

    .testimonial-header p {
        color: #718096;
        font-size: 0.875rem;
        margin: 0;
    }

    .testimonial-text {
        color: #4a5568;
        margin-bottom: 1rem;
    }

    .quote-icon {
        color:#0A3D62;
        font-size: 1.5rem;
    }
    </style>
</head>

<body>
    <section class="commentsection">
        <div class="container">
            <h2>What Clients Say</h2>
            <p>Explore the world’s best & largest Bidding marketplace with our beautiful Bidding products. We want to be
                a part of your smile, success, and future growth.</p>
            <div class="testimonial-container">
                <button class="button">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <div class="testimonial-wrapper">
                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <img src="images/comment4.jpeg" alt="Portrait of Johan Martin" />
                            <div>
                                <h3>Johan Martin</h3>
                                <p>CEO</p>
                            </div>
                        </div>
                        <p class="testimonial-text">The Pacific Grove Chamber of Commerce would like to thank eLab
                            Communications and Mr. Will Elkadi for all the efforts that assisted me nicely.</p>
                        <i class="fas fa-quote-right quote-icon"></i>
                    </div>
                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <img src="images/comment3.jpeg" alt="Portrait of Jamie Anderson" />
                            <div>
                                <h3>Jamie Anderson</h3>
                                <p>Manager</p>
                            </div>
                        </div>
                        <p class="testimonial-text">Nullam cursus tempor ex. Nullam nec dui id metus consequat congue ac
                            at est. Pellentesque blandit neque at elit tristique tincidunt.</p>
                        <i class="fas fa-quote-right quote-icon"></i>
                    </div>
                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <img src="images/comment6.jpeg" alt="Portrait of John Peter" />
                            <div>
                                <h3>John Peter</h3>
                                <p>Area Manager</p>
                            </div>
                        </div>
                        <p class="testimonial-text">Maecenas vitae porttitor neque, ac porttitor nunc. Duis venenatis
                            lacinia libero. Nam nec augue ut nunc vulputate tincidunt at suscipit nunc.</p>
                        <i class="fas fa-quote-right quote-icon"></i>
                    </div>
                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <img src="images/comment7.jpeg" alt="Portrait of Sophia Williams" />
                            <div>
                                <h3>Sophia Williams</h3>
                                <p>Director</p>
                            </div>
                        </div>
                        <p class="testimonial-text">Sophia's leadership skills are unparalleled. She transformed our
                            business approach with great insights.</p>
                        <i class="fas fa-quote-right quote-icon"></i>
                    </div>

                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <img src="images/comment8.jpeg" alt="Portrait of Daniel Brown" />
                            <div>
                                <h3>Daniel Brown</h3>
                                <p>Marketing Head</p>
                            </div>
                        </div>
                        <p class="testimonial-text">An amazing experience! The professionalism and dedication of the
                            team exceeded my expectations.</p>
                        <i class="fas fa-quote-right quote-icon"></i>
                    </div>

                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            <img src="images/comment9.jpeg" alt="Portrait of Olivia Carter" />
                            <div>
                                <h3>Olivia Carter</h3>
                                <p>Project Manager</p>
                            </div>
                        </div>
                        <p class="testimonial-text">A seamless experience from start to finish! Highly recommended for
                            their expertise and support.</p>
                        <i class="fas fa-quote-right quote-icon"></i>
                    </div>
                </div>
                <button class="button">
                    <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </section>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const testimonials = document.querySelectorAll(".testimonial-card");
        const prevButton = document.querySelector(".fa-arrow-left").parentElement;
        const nextButton = document.querySelector(".fa-arrow-right").parentElement;
        let currentIndex = 0;
        const totalTestimonials = testimonials.length;
        const testimonialsPerView = 3;
        let autoSlide;

        function showTestimonials() {
            testimonials.forEach((testimonial, i) => {
                if (i >= currentIndex && i < currentIndex + testimonialsPerView) {
                    testimonial.style.display = "block";
                } else {
                    testimonial.style.display = "none";
                }
            });
        }

        function nextSlide() {
            currentIndex++;
            if (currentIndex > totalTestimonials - testimonialsPerView) {
                currentIndex = 0;
            }
            showTestimonials();
        }

        function prevSlide() {
            currentIndex--;
            if (currentIndex < 0) {
                currentIndex = totalTestimonials - testimonialsPerView;
            }
            showTestimonials();
        }

        function resetAutoSlide() {
            clearInterval(autoSlide);
            autoSlide = setInterval(nextSlide, 3000);
        }

        prevButton.addEventListener("click", function() {
            prevSlide();
            resetAutoSlide();
        });

        nextButton.addEventListener("click", function() {
            nextSlide();
            resetAutoSlide();
        });

        showTestimonials();
        autoSlide = setInterval(nextSlide, 5000);
    });
    </script>

</body>

</html>