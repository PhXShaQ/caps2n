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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
   <canvas id="particles"></canvas>
   <link rel="stylesheet" href="../css/homepage.css">
  
  
  </head>
  <body>

  <header>
    <div class="golo">
      <img src="../logonam.png" alt="logo"/>
      <h2>Kevin's Angel</h2>
    </div>

    <nav>

    <!-- ITEM 1 -->
    <div class="nav-item">
      <a href="#">Kevinsangel Creative</a>
      <div class="mega-menu">
        <div class="column">
          <h4>Products</h4>
          <p>Overview</p>
          <p>Studio</p>
          <p>Voice Library</p>
        </div>
        <div class="column">
          <h4>Create</h4>
          <p>Text to Speech</p>
          <p>Voice Cloning</p>
        </div>
      </div>
    </div>

    <!-- ITEM 2 -->
    <div class="nav-item">
      <a href="#">Kevins Agents</a>
      <div class="mega-menu">
        <div class="column">
          <h4>Agents</h4>
          <p>AI Agents</p>
          <p>Automation</p>
        </div>
        <div class="column">
          <h4>Tools</h4>
          <p>Chatbot</p>
          <p>Assistant API</p>
        </div>
      </div>
    </div>

    <!-- ITEM 3 -->
    <div class="nav-item">
      <a href="#">ElevenAPI</a>
      <div class="mega-menu">
        <div class="column">
          <h4>API</h4>
          <p>Docs</p>
          <p>Authentication</p>
        </div>
        <div class="column">
          <h4>Developers</h4>
          <p>SDKs</p>
          <p>Examples</p>
        </div>
      </div>
    </div>

    <!-- ITEM 4 -->
    <div class="nav-item">
      <a href="#">Resources</a>
      <div class="mega-menu">
        <div class="column">
          <h4>Learn</h4>
          <p>Blog</p>
          <p>Tutorials</p>
        </div>
      </div>
    </div>

    <!-- ITEM 5 -->
    <div class="nav-item">
      <a href="#">Enterprise</a>
      <div class="mega-menu">
        <div class="column">
          <h4>Business</h4>
          <p>Solutions</p>
          <p>Security</p>
        </div>
      </div>
    </div>

    <!-- ITEM 6 -->
    <div class="nav-item">
      <a href="#">Pricing</a>
      <div class="mega-menu">
        <div class="column">
          <h4>Plans</h4>
          <p>Free</p>
          <p>Pro</p>
          <p>Enterprise</p>
        </div>
      </div>
    </div>

  </nav>
  
    <div class="profile-trigger" onclick="toggleAccountModal()">
    <div class="avatar-circle"><?php echo $initial; ?></div>
  </div>

  
  </header>

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

  <section class="hero">
    <div class="hero-left">
      <h1>The AI creative platform to bring your content to life</h1>

      <div class="buttons">
        <a href="designhome.php">Lets Get Start</a>
        
      </div>
    </div>

    <div class="hero-right">
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          
          <div class="carousel-item active">
            <img src="image1.jpg" class="d-block w-100" alt="Slide 1">
          </div>

          <div class="carousel-item">
            <img src="image1.jpg" class="d-block w-100" alt="Slide 2">
          </div>

          <div class="carousel-item">
            <img src="image1.jpg" class="d-block w-100" alt="Slide 3">
          </div>

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>

      </div>
    </div>
  </section>
  
  <div class="eleven-container">
    <div class="tabs-nav">
        <button class="tab-btn active" onclick="slideTo(0)">Text to Speech</button>
        <button class="tab-btn" onclick="slideTo(1)">Music</button>
        <button class="tab-btn" onclick="slideTo(2)">Speech to Text</button>
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
  <?php include "footer.php"; ?>

  </body>
  <script src="../script/homepage.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  
  </html>
