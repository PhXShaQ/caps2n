<?php
// Include your session check at the very top
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

    /* --- GLOBAL TOP NAVIGATION BAR --- */
    .top-header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        box-sizing: border-box;
        padding: 20px 5%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: transparent; 
        z-index: 3000; 
    }

    /* LOGO CONTAINER STYLE */
    .logo-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    /* FIX: Targeted the HTML img element correctly and gave it an optimal height */
    .logo-wrapper img {
        height: 40px;
        width: auto;
        object-fit: contain;
    }

    .logo-text {
        font-size: 22px;
        font-weight: 600;
        color: #fff;
        margin: 0;
        letter-spacing: 1px;
    }

    /* USER PROFILE ACTION OVERLAYS */
    .header-actions {
        position: relative; 
    }

    /* Tiny nav trigger button at top right corner */
    .user-avatar {
        width: 40px;
        height: 40px;
        background: #6347f9; 
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s ease;
        user-select: none;
    }

    .user-avatar:hover {
        transform: scale(1.05);
        box-shadow: 0 0 10px rgba(99, 71, 249, 0.5);
    }

    /* --- DROPDOWN MODAL --- */
    .profile-modal {
        position: absolute;
        top: 55px;
        right: 0;
        width: 280px;
        background: #131419; 
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 20px; 
        padding: 25px 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.6);
        display: none; 
        flex-direction: column;
        align-items: center; 
        z-index: 4000;
    }

    .profile-modal.show {
        display: flex;
    }

    /* Large internal modal profile circle */
    .modal-avatar-large {
        width: 65px;
        height: 65px;
        background: #6347f9;
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 24px;
        margin-bottom: 15px;
    }

    .modal-username {
        font-size: 18px;
        font-weight: 600;
        color: #fff;
        margin: 0 0 4px 0;
        text-align: center;
    }

    .modal-email {
        font-size: 13px;
        color: #6a6d7c; 
        margin: 0 0 20px 0;
        text-align: center;
        word-break: break-all;
    }

    /* Manage Account Action Button style */
    .modal-manage-btn {
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #4d3bb2;
        background: transparent;
        color: #a496f9;
        padding: 10px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 500;
        text-align: center;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        margin-bottom: 15px;
        transition: 0.2s ease;
    }

    .modal-manage-btn:hover {
        background: rgba(99, 71, 249, 0.1);
        color: #fff;
    }

    /* Red Sign Out action button style */
    .modal-logout-btn {
        width: 100%;
        box-sizing: border-box;
        background: #211518; 
        color: #f25c5c;
        border: none;
        padding: 12px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
        text-align: center;
        text-decoration: none;
        transition: 0.2s ease;
    }

    .modal-logout-btn:hover {
        background: #dd3b3b;
        color: #fff;
    }

    /* --- SLIDER --- */
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
        object-position: center;
        filter: brightness(0.6) contrast(1.1); 
        transform: scale(1.08);
        transition: transform 8s ease;
    }

    .slider .item.active img {
        transform: scale(1);
    }

    /* DARK OVERLAY */
    .slider .item::after {
        content: '';
        position: absolute;
        inset: 0;
        background:
            linear-gradient(to right, rgba(0,0,0,0.75), rgba(0,0,0,0.2)),
            linear-gradient(to top, rgba(0,0,0,0.9), transparent);
    }

    /* CONTENT */
    .content {
        position: absolute;
        top: 35%; 
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

    /* BOTTOM SLIDER CONTROLS NAVIGATION */
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
    </style>
    </head>

    <body>

        <header class="top-header">
            <div class="logo-wrapper">
                <img src="../logonam.png" alt="logo"/>
                <h2 class="logo-text">Kevin's Angel</h2>
            </div>
            
            <div class="header-actions">
                <div class="user-avatar" id="avatarTrigger">
                    <?php echo $initial; ?>
                </div>

                <div class="profile-modal" id="profileModal">
                    <div class="modal-avatar-large">
                        <?php echo $initial; ?>
                    </div>
                    <h3 class="modal-username">Kevin Angel User</h3>
                    <p class="modal-email"><?php echo htmlspecialchars($userEmail); ?></p>
                    
                    <a href="#" class="modal-manage-btn">
                        Manage your Google Account 
                        <span style="font-size:11px; margin-left:2px;">↗</span>
                    </a>
                    
                    <a href="logout.php" class="modal-logout-btn">Sign Out</a>
                </div>
            </div>
        </header>

        <div class="slider">
            <div class="list">
                <div class="item active">
                    <img src="image2.png">
                    <div class="content">
                        <p>AI Synthesis</p>
                        <h2>Speech to Text</h2>
                        <p>Transform your natural-sounding speech scripts and written text into flawless, using advanced AI vocal synthesis.</p>
                        <a href="design1.php" class="get-started-btn">Get Started</a>
                    </div>
                </div>

                <div class="item">
                    <img src="image5.png">
                    <div class="content">
                        <p>AI Audio</p>
                        <h2>Voice Cloning</h2>
                        <p>Craft custom AI vocal tracks and professional audio arrangements tailored specifically to your project's unique style.</p>
                        <a href="design2.php" class="get-started-btn">Get Started</a>
                    </div>
                </div>

                <div class="item">
                    <img src="image4.png">
                    <div class="content">
                        <p>Transcription</p>
                        <h2>Audio To Text</h2>
                        <p>Automatically convert meeting recordings, lectures, and interviews into accurate text formats with ultra-low latency.</p>
                        <a href="design3.php" class="get-started-btn">Get Started</a>
                    </div>
                </div>

                <div class="item">
                    <img src="image2.png">
                    <div class="content">
                        <p>Voice Cloning</p>
                        <h2>Voice Cloning</h2>
                        <p>Create a digital twin of your own voice for personalized automated summaries.</p>
                        <a href="design4.php" class="get-started-btn">Get Started</a>
                    </div>
                </div>
            </div>

            <div class="navbar">
                <div class="nav-item active" data-index="0">Speech to Text</div>
                <div class="nav-item" data-index="1">Voice Cloning</div>
                <div class="nav-item" data-index="2">Audio to Text</div>
                <div class="nav-item" data-index="3">Voice Cloning</div>
            </div>
        </div>

        <script>
        // --- SLIDER INTERACTION LOGIC ---
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

        // --- AVATAR MODAL MODIFICATION ---
        const avatarTrigger = document.getElementById('avatarTrigger');
        const profileModal = document.getElementById('profileModal');

        // Toggle modal visibility when avatar is clicked
        avatarTrigger.addEventListener('click', (e) => {
            e.stopPropagation(); 
            profileModal.classList.toggle('show');
        });

        // Close the modal instantly if the user clicks anywhere outside of it
        document.addEventListener('click', (e) => {
            if (!profileModal.contains(e.target) && e.target !== avatarTrigger) {
                profileModal.classList.remove('show');
            }
        });
        </script>

    </body>
</html>