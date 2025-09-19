<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City of Bacoor - Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

</head>
<body>
    <!-- Left Panel -->
    <div class="left-panel">
        INSERT IMAGES (BRB)
    </div>

    <!-- Right Panel -->
    <div class="right-panel">
        <div class="login-container">
            <h2>WELCOME TO THE</h2>
            <h1>CITY OF <span style="color:red;">BACOOR</span></h1>
            <img src="/images/bacoor-logo.png" alt="City Logo">

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-options">
                    <label>
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                    <a href="{{ route('password.request') }}">Forgot Password?</a>
                </div>
                
                <!-- reCAPTCHA placeholder -->
                <div class="form-group">
                    
                </div>
                
                <!-- Social Login -->
<div class="social-login">
  <p class="divider">Or continue with</p>
  <a href="{{ url('auth/google') }}" class="social-btn google">
    <i class="fab fa-google"></i> Sign in with Google
  </a>
  <a href="{{ url('auth/facebook') }}" class="social-btn facebook">
    <i class="fab fa-facebook-f"></i> Sign in with Facebook
  </a>
</div>



                <button type="submit" class="btn">CONTINUE</button>
            </form>

            <div class="extra-links">
                <p>New User? <a href="{{ route('register') }}">SIGN UP HERE</a></p>
                <p><a href="#">Check My Application Status</a></p>
                <p><a href="{{ url('/') }}">⬅ Back to Home</a></p>
            </div>
        </div>
    </div>
</body>
</html>
