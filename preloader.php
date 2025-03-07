<!-- Preloader HTML -->
<div id="preloader" class="preloader">
    <div class="auction-loader">
        <i class="fas fa-gavel gavel"></i>
    </div>
</div>

<!-- Preloader CSS -->
<style>
    /* Preloader Styles */
    .preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #fff; /* Dark background */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        transition: opacity 1s ease-out;
    }

    .auction-loader {
        text-align: center;
    }

    .gavel {
        font-size: 80px;
        color: #0A3D62;
        animation: gavel-bounce 1.5s infinite ease-in-out;
    }

    /* Gavel Bouncing Animation */
    @keyframes gavel-bounce {
        0% { transform: rotate(-20deg); }
        50% { transform: rotate(0deg); }
        100% { transform: rotate(-20deg); }
    }
</style>

<!-- Font Awesome for Gavel Icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Preloader JavaScript -->
<script>
    window.addEventListener('load', function () {
        setTimeout(function () {
            const preloader = document.getElementById('preloader');
            preloader.style.opacity = '0'; // Fade out
            setTimeout(() => { preloader.style.display = 'none'; }, 1000); // Remove after fade
        }, 500); 
    });
</script>
