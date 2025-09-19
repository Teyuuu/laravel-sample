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

// Coordinates for Bacoor City Hall
const latitude = 14.4064;
const longitude = 120.9408;

const weatherMap = {
  0: { icon: "fas fa-sun", text: "Clear sky" },
  1: { icon: "fas fa-sun", text: "Mainly clear" },
  2: { icon: "fas fa-cloud-sun", text: "Partly cloudy" },
  3: { icon: "fas fa-cloud", text: "Overcast" },
  45: { icon: "fas fa-smog", text: "Fog" },
  48: { icon: "fas fa-smog", text: "Depositing rime fog" },
  51: { icon: "fas fa-cloud-rain", text: "Light drizzle" },
  61: { icon: "fas fa-cloud-showers-heavy", text: "Rain" },
  71: { icon: "fas fa-snowflake", text: "Snowfall" },
  80: { icon: "fas fa-cloud-showers-heavy", text: "Rain showers" },
  95: { icon: "fas fa-bolt", text: "Thunderstorm" }
};

async function fetchWeather() {
  try {
    const response = await fetch(
      `https://api.open-meteo.com/v1/forecast?latitude=${latitude}&longitude=${longitude}&current_weather=true&hourly=relative_humidity_2m,precipitation_probability,windspeed_10m&daily=temperature_2m_max,temperature_2m_min&timezone=auto`
    );
    const data = await response.json();

    // Current weather
    const current = data.current_weather;
    const weather = weatherMap[current.weathercode] || { icon: "fas fa-question", text: "Unknown" };

    // Fill left card
    document.querySelector(".day").textContent = "Today";
    document.querySelector(".date").textContent = new Date().toDateString();
    document.querySelector(".location").textContent = "📍 Bacoor City Hall";
    document.querySelector(".temp").textContent = current.temperature + "°C";
    document.querySelector(".status").textContent = weather.text;
    document.getElementById("weather-icon").className = weather.icon;

    // Fill right card details
    const currentHour = new Date().getHours();
    document.getElementById("precip").textContent =
      data.hourly.precipitation_probability[currentHour] + "%";
    document.getElementById("humidity").textContent =
      data.hourly.relative_humidity_2m[currentHour] + "%";
    document.getElementById("wind").textContent =
      current.windspeed + " km/h";

    // Forecast
    document.getElementById("today-temp").textContent =
      data.daily.temperature_2m_max[0] + "°C";
    document.getElementById("tomorrow-temp").textContent =
      data.daily.temperature_2m_max[1] + "°C";
  } catch (error) {
    console.error("Weather API error:", error);
  }
}

fetchWeather();

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