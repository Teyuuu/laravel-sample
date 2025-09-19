<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bacoor City eGov Website</title>
  <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<!-- Preloader ----------------------------------------------------------------->
  <!-- ===== Enhanced Preloader ===== -->
  <div id="preloader">
    <!-- Floating bubbles background -->
    <div class="bubbles">
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
      <div class="bubble"></div>
    </div>
    
    <div class="clam-container">
      <div class="clam">
        <div class="shell top"></div>
        <div class="pearl"></div>
        <div class="shell bottom"></div>
      </div>
      
      <div class="waves">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
      
      <div class="loading-text">LOADING</div>
      
      <div class="progress-container">
        <div class="progress-bar"></div>
      </div>
    </div>
  </div>

  <!-- Header ------------------------------------------------------------------>
<header>
  <img src="/images/bacoor-logo.png" alt="Bacoor Logo">

  <div class="nav-auth">
    @guest
        <!-- Not logged in -->
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
    @else
        <!-- Logged in -->
        <span>Welcome, {{ Auth::user()->name }}</span>
        <a href="#" class="btn btn-danger"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>
    @endguest
  </div>

  <nav id="nav-menu">
    <ul class="nav-links">
      <li><a href="#" class="active">Home</a></li>
      <li><a href="#about-us">About Us</a></li>
      <li><a href="#services">Our Services</a></li>
      <li><a href="#contact-us">Contact Us</a></li>
    </ul>
    <!-- Hamburger Button -->
    <button class="hamburger" id="hamburger">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </nav>
</header>
  <!-- Hero Section ------------------------------------------------------------>
  <section class="hero">
    <h2>WELCOME TO</h2>
    <h1>BACOOR E-GOV SYSTEM</h1>
    
  </section>
<!-- Grid ----------------------------------------------------------------------->
<!-- Greeting -->
<div class="greeting">
  <h1>👋 Good Day, Welcome to Bacoor City E-Governance!</h1>
  <p>Here’s today’s weather and location info:</p>
</div>

<!-- Info Grid -->
<div class="info-grid">

  <!-- Weather Card -->
  <div class="weather-card">
    <div class="weather-left">
      <h3 class="day">Loading...</h3>
      <p class="date"></p>
      <p class="location">📍</p>
      <div class="temp-box">
        <i id="weather-icon" class="fas fa-sun"></i>
        <h1 class="temp">--°C</h1>
      </div>
      <p class="status">---</p>
    </div>

    <div class="weather-right">
      <div class="details">
        <p>PRECIPITATION <span id="precip">--%</span></p>
        <p>HUMIDITY <span id="humidity">--%</span></p>
        <p>WIND <span id="wind">-- km/h</span></p>
      </div>

      <div class="forecast">
        <div class="day-forecast active">
          <i class="fas fa-sun"></i>
          <span>Today</span>
          <strong id="today-temp">--°C</strong>
        </div>
        <div class="day-forecast">
          <i class="fas fa-cloud"></i>
          <span>Tomorrow</span>
          <strong id="tomorrow-temp">--°C</strong>
        </div>
      </div>  
    </div>
  </div>

  <!-- Map Card -->
  <div class="map-card">
    <h2>📍 Bacoor City Hall</h2>
    <div id="map"></div>
  </div>
</div>

<!-- Google Maps Script -->
<script async 
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTJ8xFYlr_rPd859VR_4Lpc-LF99vtAjg&callback=initMap">
</script>

  <!-- Services ---------------------------------------------------------------->
  <section id="services" class="services">
    <a href="/mayor-permit" class="service-card">
      <div class="icon-circle">
        <img src="{{ asset('images/icons/mayor.png') }}" alt="Mayor Icon">
      </div>
      <h3>Mayor’s Permit</h3>
      <p>---▶ Apply</p>
      </div>
    </a>

    <a href="/business" class="service-card">
      <div class="icon-circle">
        <img src="{{ asset('images/icons/business.png') }}" alt="Business Icon">
      </div>
      <h3>Application for Business & Building Permits</h3>
      <p>---▶ Apply</p>
      </div>
    </a>

    <a href="/real" class="service-card">
      <div class="icon-circle">
        <img src="{{ asset('images/icons/real.png') }}" alt="Real Icon">
      </div>
      <h3>Appointment for Real Property Tax, Business & Building Permits</h3>
      <p>---▶ Apply</p>
      </div>
    </a>

    <a href="/solidarity" class="service-card">
      <div class="icon-circle">
        <img src="{{ asset('images/icons/solidarity.png') }}" alt="Solidarity Icon">
      </div>
      <h3>Solidarity Route Online Registration System</h3>
      <p>---▶ Apply</p>
      </div>
    </a>
    
  </section>

  <!-- About ------------------------------------------------------------------->
  <section id="about-us" class="about">
    <div class="about-text">
      <h2>WHO WE ARE</h2>
      <p>We are the perfect team for home interior decoration. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
      <div class="about-stats">
        <div class="stat">
          <h3>15Y</h3>
          <p>Experience</p>
        </div>
        <div class="stat">
          <h3>25+</h3>
          <p>Best Team</p>
        </div>
        <div class="stat">
          <h3>500+</h3>
          <p>Total Clients</p>
        </div>
      </div>
    </div>
    <div class="gallery">
      <img src="{{ asset('images/gallery/pic1.jpg') }}" alt="Picture 1">
      <img src="{{ asset('images/gallery/pic2.jpg') }}" alt="Picture 2">
      <img src="{{ asset('images/gallery/pic3.jpg') }}" alt="Picture 3">
      <img src="{{ asset('images/gallery/pic4.jpg') }}" alt="Picture 4">
      <img src="{{ asset('images/gallery/pic5.jpg') }}" alt="Picture 5">
    </div>

  </section>

  <!-- Testimonials ------------------------------------------------------------>
  <section class="testimonials">
    <h2>OUR TESTIMONIAL FROM BEST CLIENTS</h2>
    <div class="testimonial-box">
      <p>“Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.”</p>
    </div>
    <p><strong>John D</strong> - Department Head</p>
  </section>

  <!-- Footer ------------------------------------------------------------------>
  <footer class="footer">
    <div>
      <h4>Information</h4>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div>
    <div>
      <h4>Navigation</h4>
      <ul>
        <li><a href="#">Homepage</a></li>
        <li><a href="#">Our Services</a></li>
      </ul>
    </div>
    <div>
      <section id="contact us" ><h4>Contact Us</h4>
      <p>Bacoor City, Cavite</p>
      <p>Email: info@example.com</p>
      <input type="email" placeholder="Enter email">
      <button>Subscribe</button>
    </div>
  </footer>
  <div class="footer-bottom">
    All Rights Reserved - 2025 © | Disclaimer | Privacy Policy | Terms
  </div>
   
  <!-- ===== Preloader Script ===== -------------------------------------------->
  <script>
    // Enhanced preloader with progress simulation and smooth fade out
    document.addEventListener("DOMContentLoaded", function() {
      const preloader = document.getElementById("preloader");
      let progress = 0;
      
      // Simulate loading progress
      const progressInterval = setInterval(() => {
        progress += Math.random() * 15;
        if (progress >= 100) {
          progress = 100;
          clearInterval(progressInterval);
          
          // Wait a moment then fade out
          setTimeout(() => {
            preloader.classList.add('fade-out');
            
            // Remove from DOM after animation
            setTimeout(() => {
              preloader.style.display = 'none';
            }, 800);
          }, 500);
        }
      }, 200);
    });

    // Ensure preloader is hidden even if script fails
    window.addEventListener("load", function() {
      setTimeout(() => {
        const preloader = document.getElementById("preloader");
        if (preloader && preloader.style.display !== 'none') {
          preloader.classList.add('fade-out');
          setTimeout(() => {
            preloader.style.display = 'none';
          }, 800);
        }
      }, 3000); // Maximum 3 seconds
    });
  </script>
  <script src="{{ asset('js/nav.js') }}"></script>
 
</body>
</html>
