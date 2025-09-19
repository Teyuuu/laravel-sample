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
  
  <!-- Flash Messages -->
  @if(session('success'))
    <div class="alert alert-success" style="position: fixed; top: 20px; right: 20px; z-index: 9999; background: #4CAF50; color: white; padding: 15px; border-radius: 5px; box-shadow: 0 4px 12px rgba(0,0,0,0.3);">
      {{ session('success') }}
    </div>
  @endif
  
  @if(session('error'))
    <div class="alert alert-error" style="position: fixed; top: 20px; right: 20px; z-index: 9999; background: #f44336; color: white; padding: 15px; border-radius: 5px; box-shadow: 0 4px 12px rgba(0,0,0,0.3);">
      {{ session('error') }}
    </div>
  @endif
  
  @if(session('info'))
    <div class="alert alert-info" style="position: fixed; top: 20px; right: 20px; z-index: 9999; background: #2196F3; color: white; padding: 15px; border-radius: 5px; box-shadow: 0 4px 12px rgba(0,0,0,0.3);">
      {{ session('info') }}
    </div>
  @endif
  
  <script>
    // Auto-hide flash messages after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
      const alerts = document.querySelectorAll('.alert');
      alerts.forEach(function(alert) {
        setTimeout(function() {
          alert.style.opacity = '0';
          alert.style.transform = 'translateX(100%)';
          setTimeout(function() {
            alert.remove();
          }, 300);
        }, 5000);
      });
    });
  </script>

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

<script>
function initMap() {
  try {
    // Check if the map container exists
    const mapElement = document.getElementById("map");
    if (!mapElement) {
      console.error("Map container not found");
      return;
    }
    
    // Bacoor City Hall coordinates
    const bacoorCityHall = { lat: 14.43121903077729, lng:  120.96818005233645 };
    
    // Create the map
    const map = new google.maps.Map(mapElement, {
      zoom: 16,
      center: bacoorCityHall,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      mapTypeControl: true,
      streetViewControl: true,
      fullscreenControl: true,
      zoomControl: true,
      styles: [
        {
          featureType: "poi",
          elementType: "labels",
          stylers: [{ visibility: "off" }]
        },
        {
          featureType: "administrative",
          elementType: "labels",
          stylers: [{ visibility: "simplified" }]
        }
      ]
    });
    
    // Create a custom marker icon
    const markerIcon = {
      url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`
        <svg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
          <circle cx="20" cy="20" r="18" fill="#004aad" stroke="#fff" stroke-width="2"/>
          <text x="20" y="26" text-anchor="middle" fill="white" font-family="Arial" font-size="16">🏛️</text>
        </svg>
      `),
      scaledSize: new google.maps.Size(40, 40),
      anchor: new google.maps.Point(20, 20)
    };
    
    // Create a marker for Bacoor City Hall
    const marker = new google.maps.Marker({
      position: bacoorCityHall,
      map: map,
      title: "Bacoor City Hall",
      icon: markerIcon,
      animation: google.maps.Animation.DROP
    });
    
    // Create an info window with enhanced content
    const infoWindow = new google.maps.InfoWindow({
      content: `
        <div style="padding: 15px; max-width: 250px;">
          <h3 style="margin: 0 0 10px 0; color: #004aad; font-size: 16px;">
            🏛️ Bacoor City Hall
          </h3>
          <p style="margin: 0 0 8px 0; color: #333; font-size: 14px;">
            <strong>City Government Center</strong><br>
            Bacoor, Cavite, Philippines
          </p>
          <p style="margin: 0; color: #666; font-size: 12px;">
            📍 Coordinates: ${bacoorCityHall.lat.toFixed(6)}, ${bacoorCityHall.lng.toFixed(6)}
          </p>
          <div style="margin-top: 10px;">
            <button onclick="window.open('https://maps.google.com/?q=${bacoorCityHall.lat},${bacoorCityHall.lng}', '_blank')" 
                    style="background: #004aad; color: white; border: none; padding: 5px 10px; border-radius: 3px; cursor: pointer; font-size: 12px;">
              Open in Google Maps
            </button>
          </div>
        </div>
      `
    });
    
    // Add click event to marker
    marker.addListener("click", () => {
      infoWindow.open(map, marker);
    });
    
    // Open info window by default
    infoWindow.open(map, marker);
    
    // Add map bounds to ensure proper view
    const bounds = new google.maps.LatLngBounds();
    bounds.extend(bacoorCityHall);
    map.fitBounds(bounds);
    
    // Add a small padding to the bounds
    google.maps.event.addListenerOnce(map, 'bounds_changed', function() {
      if (map.getZoom() > 18) map.setZoom(16);
    });
    
    console.log("Google Maps initialized successfully");
  } catch (error) {
    console.error("Error initializing Google Maps:", error);
    // Fallback: show a message if map fails to load
    const mapElement = document.getElementById("map");
    if (mapElement) {
      mapElement.innerHTML = "<div style='padding: 20px; text-align: center; color: #666;'><p>📍 Bacoor City Hall</p><p>City Government Center<br>Bacoor, Cavite, Philippines</p></div>";
    }
  }
}

// Handle Google Maps API loading errors
window.gm_authFailure = function() {
  console.error("Google Maps API authentication failed");
  const mapElement = document.getElementById("map");
  if (mapElement) {
    mapElement.innerHTML = "<div style='padding: 20px; text-align: center; color: #666;'><p>📍 Bacoor City Hall</p><p>City Government Center<br>Bacoor, Cavite, Philippines</p><p style='color: #999; font-size: 12px;'>Map temporarily unavailable</p></div>";
  }
};
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
