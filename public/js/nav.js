document.addEventListener("DOMContentLoaded", () => {
  const sections = document.querySelectorAll("section");
  const navLinks = document.querySelectorAll("nav ul li a");

  window.addEventListener("scroll", () => {
    let current = "";

    sections.forEach(section => {
      const sectionTop = section.offsetTop - 100; // adjust for header height
      const sectionHeight = section.clientHeight;
      if (pageYOffset >= sectionTop && pageYOffset < sectionTop + sectionHeight) {
        current = section.getAttribute("id");
      }
    });

    navLinks.forEach(link => {
      link.classList.remove("active");
      if (link.getAttribute("href") === "#" + current) {
        link.classList.add("active");
      }
    });
  });

  // Optional: make click also highlight immediately
  navLinks.forEach(link => {
    link.addEventListener("click", () => {
      navLinks.forEach(l => l.classList.remove("active"));
      link.classList.add("active");
    });
  });
});

const apiKey = "fd53018d3da7c2fbd618bf32a9e7e9e8";

  async function getWeather(city = "Bacoor") {
    try {
      const res = await fetch(`https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`);
      const data = await res.json();

      document.querySelector(".day").textContent = new Date().toLocaleDateString("en-US", { weekday: "long" });
      document.querySelector(".date").textContent = new Date().toLocaleDateString();
      document.querySelector(".location").textContent = `📍 ${data.name}, ${data.sys.country}`;
      document.querySelector(".temp").textContent = `${Math.round(data.main.temp)}°C`;
      document.querySelector(".status").textContent = data.weather[0].description;
      document.querySelector("#humidity").textContent = `${data.main.humidity}%`;
      document.querySelector("#wind").textContent = `${data.wind.speed} km/h`;
      document.querySelector("#today-temp").textContent = `${Math.round(data.main.temp)}°C`;

      // Change weather icon dynamically
      const icon = data.weather[0].main.toLowerCase();
      const iconEl = document.querySelector("#weather-icon");
      if (icon.includes("cloud")) iconEl.className = "fas fa-cloud";
      else if (icon.includes("rain")) iconEl.className = "fas fa-cloud-showers-heavy";
      else if (icon.includes("clear")) iconEl.className = "fas fa-sun";
      else if (icon.includes("snow")) iconEl.className = "fas fa-snowflake";
      else iconEl.className = "fas fa-smog";

    } catch (err) {
      alert("City not found!");
    }
  }

  getWeather(); // load default Paris

const hamburger = document.querySelector('.hamburger');
const navLinks = document.querySelector('.nav-links');

  hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('active');
    navLinks.classList.toggle('active');
  });

  // Initialize Map
  function initMap() {
    const bacoorCityHall = { lat: 14.4593576, lng: 120.9591243 };

    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 16,
      center: bacoorCityHall,
      disableDefaultUI: true, // removes all default controls
      draggable: false,       // prevent dragging
      scrollwheel: false,     // disable zoom with scroll
      disableDoubleClickZoom: true, // prevent zoom on double click
    });

    new google.maps.Marker({
      position: bacoorCityHall,
      map: map,
      title: "Bacoor City Hall",
    });
  }

async 
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTJ8xFYlr_rPd859VR_4Lpc-LF99vtAjg&callback=initMap"