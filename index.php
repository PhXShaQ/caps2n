  <!DOCTYPE html>
  <html lang="en">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AI Creative Platform</title>
  <link rel="shortcut icon" href="logonam.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
   <canvas id="particles"></canvas>
  <style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
  }

  body {
    background: #0f0f0f;
    color: white;
    overflow-x: hidden;
  }

  header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 5%;
    flex-wrap: wrap; 
    gap: 20px;
  }

  .logo {
  font-weight: bold;
  font-size: 20px;
  }

  nav a {
  margin: 0 15px;
  color: #ccc;
  text-decoration: none;
  }

  nav a:hover {
  color: white;
  }

     
.auth {
    display: flex;
    gap: 15px;
}

.buttons {
    display: flex;
    gap: 15px;
}

.buttons a {
    text-decoration: none;
    padding: 10px 22px;
    border-radius: 25px;
    background-color: #000;
    color: #fff;
    font-weight: 500;
    font-family: Arial, sans-serif;
    transition: 0.3s ease;
}

.auth a {
    text-decoration: none;
    padding: 10px 22px;
    border-radius: 25px;
    background-color: #000;
    color: #fff;
    font-weight: 500;
    font-family: Arial, sans-serif;
    transition: 0.3s ease;
}

.auth a:hover {
    background-color: #222;
    transform: scale(1.05);
}

.login {
background: transparent;
color: white;
}

.signup {
background: white;
color: black;
}

.hero {
display: flex;
justify-content: space-between;
padding: 80px 60px;
}

.hero-left {
max-width: 55%;
}

.hero-left h1 {
font-size: 60px;
line-height: 1.1;
}

.hero-left p {
margin-top: 20px;
color: #aaa;
}

.buttons {
margin-top: 30px;

}

.buttons button {
padding: 12px 24px;
border-radius: 25px;
border: none;
margin-right: 10px;
cursor: pointer;
}

.primary {
background: white;
color: black;
}

.secondary {
background: #1f1f1f;
color: white;
}

.hero-right {
flex: 1 1 400px;
display: flex;
justify-content: center;
    }

.golo {
  display: flex;
  align-items: center;
  gap: 10px;
}

img {
  width: 40px;
  height: 40px;
}

h2 {
  font-family: Arial, sans-serif;
}

/* NAV FIX */
nav {
  display: flex;
  gap: 15px;
  flex-wrap: wrap;
}

/* NAV ITEM */
.nav-item {
  position: relative;
  padding-bottom: 10px;
}

nav a {
  color: #ccc;
  text-decoration: none;
  font-size: 14px;
}

/* MEGA MENU */
.mega-menu {
  position: absolute;
  top: 40px;
  left: 0;
  width: 250px; /* Reduced fixed width for desktop */
  background: #1a1a1a;
  padding: 20px;
  border-radius: 12px;
  display: flex;
  flex-direction: column; /* Stack columns by default */
  gap: 15px;
  opacity: 0;
  visibility: hidden;
  transform: translateY(10px);
  transition: 0.3s ease;
  z-index: 100;
  border: 1px solid #333;
}

/* SHOW ON HOVER */
.nav-item:hover .mega-menu {
  opacity: 1;
  visibility: visible;
  transform: translateY(0);
}
.hero {
      display: flex;
      justify-content: space-between;
      padding: 60px 5%;
      flex-wrap: wrap; /* CRITICAL FOR MOBILE */
      gap: 40px;
  }

  .hero-left {
      max-width: 100%; /* Changed from 55% */
      flex: 1 1 500px; /* Grows but stays base-size */
  }

  .hero-left h1 {
      font-size: clamp(32px, 8vw, 60px); /* Adjusts size based on screen */
      line-height: 1.1;
  }

  .hero-right {
      flex: 1 1 600px;   /* allows it to grow */
      display: flex;
      justify-content: center;
  }

  .hero-right .carousel {
    width: 100%;
    max-width: 500px;   /* control width */
      box-shadow: 0 20px 60px rgba(0,0,0,0.5);
  }

  .hero-right .carousel-inner {
    height: 300px;      /* control height */
  }

  .hero-right .carousel-item {
    height: 300px;
  }

  .hero-right .carousel-item img {
    height: 100%;
    width: 100%;
    object-fit: cover;  /* VERY IMPORTANT */
    border-radius: 15px;
  }

  .hero-left,
  .hero-right {
    flex: 1 1 500px;
  }


  .cards {
      display: flex;
      gap: 20px;
      padding: 40px 5%;
      flex-wrap: wrap; /* Stacks cards on mobile */
  }

  .card {
      flex: 1 1 280px; /* Minimum width of 280px before stacking */
      height: 200px;
      background: #1c1c1c;
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #888;
  }


  /* COLUMNS */
  .column {
    flex: 1;
  }

  .column h4 {
    margin-bottom: 10px;
    color: #aaa;
    font-size: 14px;
  }

  .column p {
    margin: 8px 0;
    font-size: 13px;
    color: #ccc;
    cursor: pointer;
    transition: 0.2s;
  }

  .column p:hover {
    color: white;
    transform: translateX(5px);
  }

  nav {
    display: flex;
    gap: 20px;
    position: relative;
  }

  .nav-item {
    position: relative;
  }

  /* make dropdown align nicely per item */
  .mega-menu {
    position: absolute;
    top: 40px;
    left: 0;
    min-width: 300px;
  }
  .nav-item {
    padding-bottom: 10px;
  }
  
  /* slide */
  
  .eleven-container {
    max-width: 1000px;
    margin: 50px auto;
    background: #181a1b;
    border-radius: 24px;
    overflow: hidden;
    padding-bottom: 30px;
  }

  .tabs-nav {
    display: flex;
    justify-content: center;
    gap: 15px;
    padding: 20px;
    background: rgba(0,0,0,0.2);
  }

  .tab-btn {
    background: transparent;
    border: none;
    color: #888;
    cursor: pointer;
    padding: 10px 20px;
    border-radius: 20px;
    transition: 0.3s;
  }

  .tab-btn.active {
    background: #fff;
    color: #000;
  }

  /* SLIDER LOGIC */
  .slider-window {
    width: 100%;
    overflow: hidden; /* Itatago ang ibang slides */
  }

  .slider-track {
      display: flex;
      width: 400%; /* 4 slides = 400% */
      transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1); /* Smooth slide */
  }

  .slide-item {
      width: 100%; /* Isang slide ay kakain ng buong window width */
      padding: 40px;
      display: flex;
      justify-content: center;
  }

  .content-box {
      background: #222;
      width: 90%;
      padding: 40px;
      border-radius: 20px;
      min-height: 300px;
  }






 #particles {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        background: #0f172a; /* dark background */
        }

        .dashboard-content {
        position: relative;
        z-index: 1;
        }



          @media (max-width: 768px) {
    header {
        justify-content: center;
        text-align: center;
        display: flex;
    }

    nav {
      display: none;
    }

    .mega-menu {
        display: none; /* Recommended: Hide mega menus on mobile and use a burger menu instead */
    }

    .auth {
        width: 100%;
        display: flex;
        justify-content: center;
        margin-top: 10px;
        
    }

    .slider-window {
      width: 60%;
    }
    
  }
  </style>
  
  </head>
  <body>

  <header>
    <div class="golo">
      <img src="logonam.png"/>
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
  
    <div class="auth">
      <a href="pages/loginform.php">Login</a>
      <a href="pages/registrationform.php">Sign-up</a>
    </div>
  </header>

  <section class="hero">
    <div class="hero-left">
      <h1>The AI creative platform to bring your content to life</h1>

      <div class="buttons">
        <a href="mycapstone/pages/registrationform.php">Sign-up</a>
        <button class="secondary">Contact sales</button>
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


<script>
    function slideTo(index) {
    const track = document.getElementById('mainTrack');
    const buttons = document.querySelectorAll('.tab-btn');

    // 1. Move the track (100% / 4 slides = 25% movement per slide)
    // Pero since container width ang usapan, move by -25% each step
    const percentage = index * 25;
    track.style.transform = `translateX(-${percentage}%)`;

    // 2. Update Active Button Style
    buttons.forEach((btn, i) => {
        if (i === index) {
            btn.classList.add('active');
        } else {
            btn.classList.remove('active');
        }
    });
}




const canvas = document.getElementById("particles");
const ctx = canvas.getContext("2d");

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

let particlesArray = [];
const numberOfParticles = 120;

const mouse = {
  x: null,
  y: null,
  radius: 120
};

window.addEventListener("mousemove", function (event) {
  mouse.x = event.x;
  mouse.y = event.y;
});

window.addEventListener("resize", function () {
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
});

class Particle {
  constructor() {
    this.x = Math.random() * canvas.width;
    this.y = Math.random() * canvas.height;
    this.size = Math.random() * 3 + 1;
    this.speedX = Math.random() * 1 - 0.5;
    this.speedY = Math.random() * 1 - 0.5;
  }

  update() {
    this.x += this.speedX;
    this.y += this.speedY;

    // Bounce on edges
    if (this.x > canvas.width || this.x < 0) {
      this.speedX *= -1;
    }
    if (this.y > canvas.height || this.y < 0) {
      this.speedY *= -1;
    }

    // Mouse interaction
    let dx = mouse.x - this.x;
    let dy = mouse.y - this.y;
    let distance = Math.sqrt(dx * dx + dy * dy);

    if (distance < mouse.radius) {
      this.x -= dx / 20;
      this.y -= dy / 20;
    }
  }

  draw() {
    ctx.fillStyle = "white";
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
    ctx.fill();
  }
}

function init() {
  particlesArray = [];
  for (let i = 0; i < numberOfParticles; i++) {
    particlesArray.push(new Particle());
  }
}

function connect() {
  for (let a = 0; a < particlesArray.length; a++) {
    for (let b = a; b < particlesArray.length; b++) {
      let dx = particlesArray[a].x - particlesArray[b].x;
      let dy = particlesArray[a].y - particlesArray[b].y;
      let distance = dx * dx + dy * dy;

      if (distance < 10000) {
        ctx.strokeStyle = "rgba(255,255,255,0.1)";
        ctx.lineWidth = 1;
        ctx.beginPath();
        ctx.moveTo(particlesArray[a].x, particlesArray[a].y);
        ctx.lineTo(particlesArray[b].x, particlesArray[b].y);
        ctx.stroke();
      }
    }
  }
}

function animate() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  for (let i = 0; i < particlesArray.length; i++) {
    particlesArray[i].update();
    particlesArray[i].draw();
  }

  connect();
  requestAnimationFrame(animate);
}

init();
animate();




</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  </body>
  <?php include "../caps/pages/footer.php"; ?>
  </html>
