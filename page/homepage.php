  <?php

  // I-paste din ito sa pinakataas ng homepage2.php at iba pang pages
$cookie_lifetime = 30 * 24 * 60 * 60; 
session_set_cookie_params([
    'lifetime' => $cookie_lifetime,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => false, // Gawing true kung naka-HTTPS sa live domain
    'httponly' => true,
    'samesite' => 'Strict'
]);
  session_start();
  if (!isset($_SESSION['user_id'])) {
      header("Location: loginform.php");
      exit();
  }
  $userEmail = $_SESSION['email'] ?? 'User';
  $initial = strtoupper(substr($userEmail, 0, 1));

?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Slider | Kevin's Angel</title>

    <style>
    body {
        margin: 0;
        background: #000;
        color: #fff;
        font-family: 'Inter', Arial, sans-serif;
    }

    
    /* LOGO CONTAINER STYLE */
.logo-wrapper {
    position: absolute;
    top: 30px; /* Distansya mula sa itaas */
    left: 10%; /* Kapantay ng iyong .content */
    z-index: 2000; /* Mas mataas sa lahat ng element */
    display: flex;
    align-items: center;
    gap: 15px;
}

img {
    width: 5px; /* I-adjust base sa laki ng logo mo */
    height: auto;
}

.logo-text {
    font-size: 24px;
    font-weight: 600;
    color: #fff;
    margin: 0;
    letter-spacing: 1px;
    
}

    /* SLIDER */
    .slider {
        height: 100vh;
        position: relative;
        overflow: hidden;
    }

    .slider .list .item {
       position: absolute;
        inset: 0;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.8s ease;  
    }

    .slider .list .item.active {
       opacity: 1;
        visibility: visible;
        z-index: 2;

    }

    .slider .list .item img {
    transform: scale(1.05);
    transition: transform 0.8s ease;
}

.slider .list .item.active img {
    transform: scale(1);
}

    .slider img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* DARK OVERLAY */
    .slider .item::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, #000 30%, transparent);
    }

    /* CONTENT */
    .content {
        position: absolute;
        top: 30%;
        left: 10%;
        z-index: 2;
        max-width: 600px;
    }

    .content h2 {
        font-size: 60px;
        margin: 0;
    }

    /* GET STARTED BUTTON */
    .get-started-btn {
        margin-top: 25px;
        padding: 12px 35px;
        background-color: #fff;
        color: #000;
        border: none;
        border-radius: 50px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
        display: inline-block;
        text-decoration: none;
    }

    .get-started-btn:hover {
        background-color: #e0e0e0;
        transform: scale(1.05);
    }

    /* TEXT ANIMATION */
    .slider .item.active .content h2,
    .slider .item.active .content p,
    .slider .item.active .get-started-btn {
        transform: translateY(30px);
        opacity: 0;
        filter: blur(50px);
        animation: showText 0.6s forwards;
    }

    .slider .item.active .content h2 { animation-delay: 0.3s; }
    .slider .item.active .content p { animation-delay: 0.5s; }
    .slider .item.active .get-started-btn { animation-delay: 0.7s; }

    @keyframes showText {
        to {
            transform: translateY(0);
            opacity: 1;
            filter: blur(0);
        }
    }

    /* NAVIGATION BAR */
    .navbar {
        position: absolute;
        bottom: 50px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        align-items: center;
        gap: 30px;
        background: rgba(18, 18, 18, 0.8);
        padding: 10px 40px;
        border-radius: 50px;
        z-index: 1000;
        backdrop-filter: blur(10px);
    }

    .nav-item {
        cursor: pointer;
        color: #aaa;
        font-size: 16px;
        font-weight: 500;
        transition: 0.3s;
        padding: 12px 25px;
        white-space: nowrap;
    }

    .nav-item:hover { color: #fff; }

    .nav-item.active {
        color: #fff;
        background: #1a1a1a;
        border-radius: 40px;
    }


/* Siguraduhin na ang .slider ay relative */
.slider {
    position: relative;
}

    /* ZOOM EFFECT */
    

    </style>
    </head>

    <body>

        <div class="slider">
           
            <div class="logo-wrapper">
                
                <h2 class="logo-text">Kevin's Angel</h2>
            </div>

            <div class="list">
                <!-- SLIDE 01 -->
                <div class="item active">
                    <img src="image1.jpg">
                    <div class="content">
                        <p>AI Synthesis</p>
                        <h2>Meeting</h2>
                        <p>Convert your written text into natural-sounding speech using professional-grade AI voices.</p>
                        <a href="registration.php" class="get-started-btn">Get Started</a>
                    </div>
                </div>

                <!-- SLIDE 02 -->
                <div class="item">
                    <img src="image2.png">
                    <div class="content">
                        <p>AI Audio</p>
                        <h2>Voice Cloning</h2>
                        <p>Generate high-fidelity music tracks and arrangements perfectly suited for your projects.</p>
                        <a href="registration.php" class="get-started-btn">Get Started</a>
                    </div>
                </div>

                <!-- SLIDE 03 -->
                <div class="item">
                    <img src="image4.png">
                    <div class="content">
                        <p>Transcription</p>
                        <h2>Audio To Text</h2>
                        <p>Accurately transcribe meeting records and interviews in real-time with ultra-low latency.</p>
                        <a href="registration.php" class="get-started-btn">Get Started</a>
                    </div>
                </div>

                <!-- SLIDE 04 -->
                <div class="item">
                    <img src="image2.png">
                    <div class="content">
                        <p>Voice Cloning</p>
                        <h2>Voice Cloning</h2>
                        <p>Create a digital twin of your own voice for personalized automated summaries.</p>
                        <a href="registration.php" class="get-started-btn">Get Started</a>
                    </div>
                </div>
            </div>

            <!-- NAVBAR -->
            <div class="navbar">
                <div class="nav-item active" data-index="0">Speech to Text</div>
                <div class="nav-item" data-index="1">Voice Cloning</div>
                <div class="nav-item" data-index="2">Audio to Text</div>
                <div class="nav-item" data-index="3">Voice Cloning</div>
            </div>
        </div>

        <script>
        let slider = document.querySelector('.slider');
        let items = document.querySelectorAll('.slider .list .item');
        let navItems = document.querySelectorAll('.nav-item');

        function showSlide(index) {
            items.forEach(item => item.classList.remove('active'));
            navItems.forEach(nav => nav.classList.remove('active'));

            items[index].classList.add('active');
            navItems[index].classList.add('active');

            slider.classList.remove('next');
            void slider.offsetWidth; // Reset animation
            slider.classList.add('next');
        }

        navItems.forEach((nav, index) => {
            nav.addEventListener('click', () => {
                showSlide(index);
            });
        });
        </script>

    </body>
</html>