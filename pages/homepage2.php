<?php
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
<title>AI Creative Platform</title>
<link rel="shortcut icon" href="logonam.png" type="image/x-icon">
<script src="https://unpkg.com/lucide@latest"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<link rel="stylesheet" href="../css/homepage.css">

</head>
<body>

<header>
  <div class="golo">
    <img src="../logonam.png"/>
    <h2>Kevin Angel's</h2>
  </div>

  
  <nav class="nav-container">

  
  <div class="nav-item">
    <a href="#" class="nav-link">Kevin's Creative</a>
    <div class="mega-menu">
      <div class="column">
        <h3>Products<h3>
        <div class="p-wrapper">
          <p><strong>Overview</strong></p>
          <div class="sub-details"> Pro-grade voice generation tools.</div>
        </div>
        <div class="p-wrapper">
          <p><strong>Studio</strong></p>
          <div class="sub-details">Pro-grade voice generation tools.</div>
        </div>
        <div class="p-wrapper">
          <p><strong>Voice Library</strong></p>
          <div class="sub-details">Pro-grade voice generation tools.</div>
        </div>
      </div>
      <div class="column">
        <h3>Create</h3>
        <div class="p-wrapper">
          <p><strong>Speech to Text</strong></p>
          <div class="sub-details">Create a digital twin of your voice.</div>
        </div>
        <div class="p-wrapper">
          <p><strong>Voice Cloning</strong></p>
          <div class="sub-details">Create a digital twin of your voice.</div>
        </div>
      </div>
    </div>
  </div>

    

  <div class="nav-item">
    <a href="#" class="nav-link">Kevin's Agent</a>
    <div class="mega-menu">
      <div class="column">
        <h4>Learn</h4>
        <div class="p-wrapper">
          <p><strong>Blog</strong></p>
          <div class="sub-details">Latest updates in AI tech.</div>
        </div>
      </div>
    </div>
  </div>

  <div class="nav-item">
    <a href="#" class="nav-link">API</a>
    <div class="mega-menu">
      <div class="column">
        <h4>Learn</h4>
        <div class="p-wrapper">
          <p><strong>Blog</strong></p>
          <div class="sub-details">Latest updates in AI tech.</div>
        </div>
      </div>
    </div>
  </div>

   <div class="nav-item">
    <a href="#" class="nav-link">Enterprice</a>
    <div class="mega-menu">
      <div class="column">
        <h4>Products</h4>
        <div class="p-wrapper">
          <p><strong>AI Studio</strong></p>
          <div class="sub-details">Pro-grade voice generation tools.</div>
        </div>
      </div>
      <div class="column">
        <h4>Create</h4>
        <div class="p-wrapper">
          <p><strong>Voice Cloning</strong></p>
          <div class="sub-details">Create a digital twin of your voice.</div>
        </div>
      </div>
    </div>
  </div>

  <div class="nav-item">
    <a href="#" class="nav-link">Resources</a>
    <div class="mega-menu">
      <div class="column">
        <h4>Learn</h4>
        <div class="p-wrapper">
          <p><strong>Blog</strong></p>
          <div class="sub-details">Latest updates in AI tech.</div>
        </div>
      </div>
    </div>
  </div>

  <div class="nav-item">
    <a href="#" class="nav-link">Pricing</a>
    <div class="mega-menu">
      <div class="column">
        <h4>Learn</h4>
        <div class="p-wrapper">
          <p><strong>Blog</strong></p>
          <div class="sub-details">Latest updates in AI tech.</div>
        </div>
      </div>
    </div>
  </div>

</nav>

  <div class="profile-trigger" onclick="toggleAccountModal()">
    <div class="avatar-circle"><?php echo $initial; ?></div>
  </div>

  <div id="accountModal" class="account-modal hidden">
    <div class="modal-header">
      <span><?php echo $userEmail; ?></span>
      <button class="close-x" onclick="toggleAccountModal()">&times;</button>
    </div>

    <div class="avatar-large"><?php echo $initial; ?></div>
    <h2>Hi, User!</h2>
    <a href="https://myaccount.google.com/" target="_blank" rel="noopener noreferrer" class="manage-btn" style="display: flex; align-items: center; justify-content: center; gap: 8px;">
    Manage your Google Account
    <i data-lucide="external-link" style="width: 14px; height: 14px;"></i>
    </a>

    <div class="account-actions">
      <a href="logout.php" class="action-row">Sign out</a>
    </div>
  </div>
</header>

<section class="hero">
  <div class="hero-left">

    <h1 class="ml5">
      <span class="text-wrapper">
          
          <span class="letters letters-right"> With simple, fast, and</span>
          <span class="letters letters-left"> accurate transcription,</span>
          <span class="letters letters-right"> Kevin's angels work for you</span>
          
      </span>
    </h1>
   
    

    <div class="buttons">
      <a href="design1.php" target="_blank" rel="noopener noreferrer">
          <div class="buttons">
            <button class="secondary" onclick="openNewWindow()">Let get start</button>
        </div>
      </a>
    </div>
  </div>

  <div class="hero-right">
    Kevin's is a single platform to generate, edit, and localize premium audio and video in minutes. Powering millions of creators, marketing teams, and media companies worldwide.
  </div>
</section>

<div class="eleven-container">
    <div class="tabs-nav">
        <button class="tab-btn active" onclick="slideTo(0)">Start Meeting</button>
        <button class="tab-btn" onclick="slideTo(1)">Summary</button>
        <button class="tab-btn" onclick="slideTo(2)">Audio to Text</button>
        <button class="tab-btn" onclick="slideTo(3)">Voice Cloning</button>
    </div>

    <div class="slider-window">
        <div class="slider-track" id="mainTrack">
            
            <section class="slide-item">
                <div class="content-box">
                    <h3>Text to Speech</h3>
                    <p>Transform text into lifelike speech across 70+ languages.</p>
                    </div>
            </section>

            <section class="slide-item">
                <div class="content-box">
                    <h3>AI Music Generation</h3>
                    <p>Create unique background tracks for your projects.</p>
                </div>
            </section>

            <section class="slide-item">
                <div class="content-box">
                    <h3>Speech to Text</h3>
                    <div class="upload-card">
                        <i data-lucide="upload-cloud"></i>
                        <p>Upload MP3</p>
                    </div>
                </div>
            </section>

            <section class="slide-item">
                <div class="content-box">
                    <h3>Voice Cloning</h3>
                    <p>Clone your own voice with just a few minutes of audio.</p>
                </div>
            </section>

        </div>
    </div>
</div>

<script src="../script/homepage.js"></script>

</body>
  <?php include "../pages/footer.php"; ?>
</html>
