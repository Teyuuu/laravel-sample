<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>City Assessor's Office - Bacoor City Egov</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #fdfdfd;
      color: #222;
    }

    /* Navbar */
    header {
      background: #002b5c;
      color: white;
      padding: 15px 50px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    header h1 {
      margin: 0;
      font-size: 22px;
      text-transform: uppercase;
    }

    nav ul {
      margin: 0;
      padding: 0;
      list-style: none;
      display: flex;
      gap: 20px;
    }

    nav a {
      color: white;
      text-decoration: none;
      font-weight: bold;
      transition: 0.3s;
    }

    nav a:hover {
      color: #ffcc00;
    }

    /* Hero Section */
    .hero {
      background: linear-gradient(to right, #f5f7fa, #c3cfe2);
      padding: 80px 20px;
      text-align: center;
    }

    .hero h2 {
      font-size: 40px;
      margin-bottom: 10px;
    }

    .hero p {
      font-size: 18px;
      margin-bottom: 20px;
    }

    .hero .btn {
      background: #002b5c;
      color: white;
      padding: 12px 25px;
      text-decoration: none;
      border-radius: 5px;
    }

    .hero .btn:hover {
      background: #004080;
    }

    /* Services */
    .services {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      padding: 50px;
    }

    .service-box {
      background: #f4f4f4;
      padding: 30px;
      border-radius: 10px;
      text-align: center;
      transition: 0.3s;
    }

    .service-box:hover {
      background: #002b5c;
      color: white;
    }

    .service-box i {
      font-size: 40px;
      margin-bottom: 15px;
      color: #002b5c;
    }

    .service-box:hover i {
      color: #ffcc00;
    }

    /* About Section */
    .about {
      padding: 50px;
      background: #fff;
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 30px;
    }

    .about-text {
      flex: 1;
    }

    .about-text h3 {
      font-size: 28px;
    }

    .about-text p {
      font-size: 16px;
      line-height: 1.6;
    }

    .about-img {
      flex: 1;
    }

    .about-img img {
      width: 100%;
      border-radius: 10px;
    }

    /* Footer */
    footer {
      background: #002b5c;
      color: white;
      padding: 20px;
      text-align: center;
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header>
    <h1>Bacoor City Egov</h1>
    <nav>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Our Services</a></li>
        <li><a href="#">Contact Us</a></li>
        <li><a href="{{ route('login') }}">Login</a></li>
      </ul>
    </nav>
  </header>

  <!-- Hero -->
  <section class="hero">
    <h2>Welcome to City Assessor's Office</h2>
    <p>Your trusted partner in property assessment and documentation</p>
    <a href="{{ route('login') }}" class="btn">Sign In</a>
  </section>

  <!-- Services -->
  <section class="services">
    <div class="service-box">
      <i class="fa-solid fa-building-columns"></i>
      <h3>City Treasurer's Office</h3>
      <p>Payment processing, tax collections, and financial services.</p>
    </div>
    <div class="service-box">
      <i class="fa-solid fa-file-invoice"></i>
      <h3>City Assessor's Office</h3>
      <p>Issuance of tax declarations, certifications, and assessments.</p>
    </div>
    <div class="service-box">
      <i class="fa-solid fa-id-card"></i>
      <h3>Mayor's Permit</h3>
      <p>Business permit processing and compliance assistance.</p>
    </div>
  </section>

  <!-- About -->
  <section class="about">
    <div class="about-text">
      <h3>Who We Are</h3>
      <p>
        We are a team dedicated to providing efficient and transparent public service.  
        Our mission is to make property assessment and documentation hassle-free for all citizens of Bacoor City.
      </p>
    </div>
    <div class="about-img">
      <img src="https://via.placeholder.com/500x300" alt="City Office">
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 Bacoor City Egov. All Rights Reserved.</p>
  </footer>

</body>
</html>
