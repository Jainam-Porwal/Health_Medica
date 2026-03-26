<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/database.php';

// Check if user is logged in
$is_logged_in = isset($_SESSION['user_id']);
$user_name = $_SESSION['full_name'] ?? '';

// Get current page for active nav highlighting
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title><?php echo isset($page_title) ? $page_title . ' - Health Medica' : 'Health Medica'; ?></title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <!-- nice select -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha256-mLBIhmBvigTFWPSCtvdu6a76T+3Xyt+K571hupeFLg4=" crossorigin="anonymous" />
  <!-- datepicker -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>

<body class="<?php echo isset($is_sub_page) && $is_sub_page ? 'sub_page' : ''; ?>">

  <div class="hero_area">
    <!-- header section starts -->
    <header class="header_section">
      <div class="header_top">
        <div class="container">
          <div class="contact_nav">
            <a href="">
              <i class="fa fa-phone" aria-hidden="true"></i>
              <span>
                Call : +01 123455678990
              </span>
            </a>
            <a href="">
              <i class="fa fa-envelope" aria-hidden="true"></i>
              <span>
                Email : demo@gmail.com
              </span>
            </a>
            <a href="">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
              <span>
                Location
              </span>
            </a>
          </div>
        </div>
      </div>
      <div class="header_bottom">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="index.php">
              <img src="images/logo.png" alt="Health Medica Logo" style="height: 48px; margin-right: 10px;">
              <span>Health Medica</span>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <div class="d-flex mr-auto flex-column flex-lg-row align-items-center">
                <ul class="navbar-nav  ">
                  <li class="nav-item <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item <?php echo ($current_page == 'about.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="about.php"> About</a>
                  </li>
                  <li class="nav-item <?php echo ($current_page == 'treatment.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="treatment.php">Treatment</a>
                  </li>
                  <li class="nav-item <?php echo ($current_page == 'doctor.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="doctor.php">Doctors</a>
                  </li>
                  <li class="nav-item <?php echo ($current_page == 'testimonial.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="testimonial.php">Testimonial</a>
                  </li>
                  <li class="nav-item <?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="contact.php">Contact Us</a>
                  </li>
                </ul>
              </div>
              <div class="quote_btn-container">
                <?php if ($is_logged_in): ?>
                  <a href="dashboard.php">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>
                      <?php echo htmlspecialchars($user_name); ?>
                    </span>
                  </a>
                  <a href="logout.php">
                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                    <span>
                      Logout
                    </span>
                  </a>
                <?php else: ?>
                  <a href="login.php">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>
                      Login
                    </span>
                  </a>
                  <a href="signup.php">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>
                      Sign Up
                    </span>
                  </a>
                <?php endif; ?>
                <form class="form-inline">
                  <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                    <i class="fa fa-search" aria-hidden="true"></i>
                  </button>
                </form>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </header>
    <!-- end header section -->
