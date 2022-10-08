<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Odyssey</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="shortcut icon" href="assets/img/icon-48x48.png" >

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
  

  <!-- Template Main CSS File -->
  

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        <h1 class="text-light"><a href="index.php"><span>Odyssey</span></a></h1>
      </div>

											
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="active " href="index.php">Home</a></li>
          <li><a href="Articles.php">Articles</a></li>
          <li><a href="team.php">Team</a></li>
          <?php 
                if(!(isset($_SESSION['email']))){
                    echo '<li><a href="pages-sign-up.html">Sign Up</a></li>';
            }?>
          <li><a href="<?php echo $_SESSION['account_type'].'_'.'Dashboard.php'?>"><?php if(isset($_SESSION['email'])){
	        echo '<div class="col-2"><img src="assets/img/avatar_user.jpg" class="avatar" style="
                vertical-align: middle;
                width: 50px;
                height: 50px;
                border-radius: 50%;"></div>';}?>
            </a></li>
        </ul>

        <i class="bi bi-list mobile-nav-toggle"></i>

      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex justify-cntent-center align-items-center">
    <div id="heroCarousel" class="container carousel carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

      <!-- Slide 1 -->
      <div class="carousel-item active">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown">Welcome to <span>Odyssey</span></h2>
          <p class="animate__animated animate__fadeInUp">Put your first step to open science with us, be a member, become an author, do your own project, submit It, evaluate it & improve it with us. Share your knowledge with the community. Find the newest articles about open science projects, help us to evaluate them, give your ideas about projects and share them with friends. Welcome you all on <span style="font-weight:bolder;">A journey full of adventures.</span></p>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown">Measure Your Science Project...</h2>
          <p class="animate__animated animate__fadeInUp">Join with us as an author or a reviewer today and measure your success.</p>
            <?php
                if (isset($_SESSION['email'])){
                    if($_SESSION['account_type'] === "Author"){
                        echo '<a href="Author_Dashboard.php" class="btn-get-started animate__animated animate__fadeInUp">Join</a>';
                    }else if($_SESSION['account_type'] === "Reviewer"){
                        echo '<a href="Reviewer_Dashboard.php" class="btn-get-started animate__animated animate__fadeInUp">Join</a>';
                    }
                }else{ 
                    echo'<a href="pages-sign-up.html" class="btn-get-started animate__animated animate__fadeInUp">Join</a>';
            }?>
        </div>
      </div>

      <!-- Slide 3 -->

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
      </a>

    </div>
  </section><!-- End Hero -->
    <!-- ======= Our Services Section ======= -->
    <section id="services" class="services sections-bg">
      <div class="container" data-aos="fade-up" >

        <div class="section-header">
          <h2>What you can expect ?</h2>
          <p>The following mentioned services and much more unique features you will be able to access and benefit through our Odyssey Platform</p>
        </div>

        <div class="row gy-4" data-aos="fade-up" data-aos-delay="100" >

          <div class="col-lg-4 col-md-6">
            <div class="service-item  position-relative" style="background-color:#F6F6F6;">
              <div class="icon">
                <i class="bi bi-activity"></i>
              </div>
              <h3>View articles on </h3>
              <p>Follow your favorite authors and find their open science activities and evaluate them.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6">
            <div class="service-item position-relative" style="background-color:#F6F6F6;">
              <div class="icon">
                <i class="bi bi-broadcast"></i>
              </div>
              <h3>Send feedbacks</h3>
              <p>Send your idea about Odyssey Index, what are the improvements needed, and what is your favorite in Odyssey Index.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6">
            <div class="service-item position-relative" style="background-color:#F6F6F6;">
              <div class="icon">
                <i class="bi bi-easel"></i>
              </div>
              <h3>Recommended articles</h3>
              <p>Team Odyssey always tries to get the best projects, and present them to the community. We will provide monthly and weekly best projects according to the Odyssey Index as recommended articles.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6">
            <div class="service-item position-relative" style="background-color:#F6F6F6;">
              <div class="icon">
                <i class="bi bi-bounding-box-circles"></i>
              </div>
              <h3>Get information for your next project</h3>
              <p>Use our dashboard and find what are the areas that are covered by projects and what areas are not covered. Get full detailed articles about existing projects.</p>
              
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6">
            <div class="service-item position-relative" style="background-color:#F6F6F6;">
              <div class="icon">
                <i class="bi bi-calendar4-week"></i>
              </div>
              <h3>Advanced search</h3>
              <p>Search on the ideal participant details to get information for your next open science activity. Get a rough idea about what to expect on your voyage of open science through our advanced search option.</p>
              
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6">
            <div class="service-item position-relative" style="background-color:#F6F6F6;">
              <div class="icon">
                <i class="bi bi-chat-square-text"></i>
              </div>
              <h3>Get Awards</h3>
              <p>Publish your articles, creations and much more in our platform and make your community and help open science to grow while you grow. You would be eligible to earn awards for your contribution towards open science measuring.</p>
              
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>
    </section><!-- End Our Services Section -->
<main id="main">
    <section class="features">
        <div class="container">      
 
          <div class="row" data-aos="fade-up">
            <div class="col-md-5 order-1 order-md-2">
              <img src="assets/img/f1.png " class="img-fluid" alt="">
            </div>
            <div class="col-md-7 pt-5 order-2 order-md-1">
              <h3>What is an open science activity?</h3>
              <p class="fst-italic">
                An open science activity can be considered an activity that has all its data shared among the community.
                The main purpose of the shared data is to spread knowledge on the relevant fields as the activity.
                Open science is an initiative created to make research and innovation projects more effective with improved quality.
              </p>
              <!-- <p>
                Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                culpa qui officia deserunt mollit anim id est laborum
              </p> -->
            </div>
          </div>
 
          <div class="row" data-aos="fade-up">
            <div class="col-md-5">
              <img src="assets/img/f2.png" class="img-fluid" alt="">
            </div>
            <div class="col-md-7 pt-5">
              <h3>What is the Odyssey matric (OI)?</h3>
              <p>The odyssey metric is a score type that can be used to evaluate the effectiveness of any given open science project
                regardless of its outcome. The concept of the metric can be easily explained as an average of multiple marking criteria
                that is used to evaluate the effectiveness. The index value will span between 0 and 100. Most effective activities will be
                granted a higher score and others will be measured accordingly. The index value will change with time and when mentioning the
                index value the accessed date is also required to be alongside.</p>
              <!-- <ul>
                <li><i class="bi bi-check"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                <li><i class="bi bi-check"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                <li><i class="bi bi-check"></i> Facilis ut et voluptatem aperiam. Autem soluta ad fugiat.</li>
              </ul> -->
            </div>
          </div>
 
          <div class="row" data-aos="fade-up">
            <div class="col-md-5 order-1 order-md-2">
              <img src="assets/img/f3.png " class="img-fluid" alt="">
            </div>
            <div class="col-md-7 pt-5 order-2 order-md-1">
              <h3>Why Odyssey index?</h3>
              <p class="fst-italic">
                As of the research we have done toward achieving a solution for the challenge of Measuring open science,
                we were unable to find any platform/matric that can be used to evaluate any activity with a numbered scale.
                Therefore, the OI gives the author/publisher/organizer the ability to evaluate any open science activity with the
                ability to have an easily understandable scoring system. By using the odyssey index we aim to assess open science
                activities and encourage the science community to use the assessed activities as their information. The main aim of the
                odyssey index is not to create competition but to evaluate any open science activity by its effectiveness in the community.
              </p>
            </div>
          </div>
        </div>
    </section>
    <section class="service-details">
      <div class="container">

        <div class="row">
          <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Our Vision</h5>
                <p class="card-text">Be the “Zeus” of the open science world while helping open science enthusiasts to grow.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Our Mission</h5>
                <p class="card-text">Provide accurate results for your open science activity based on our advanced metric system while encouraging the general public to engage more in such activities to make the world a better and an advanced place</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>  
</main>




  <!-- ======= Footer ======= -->
  <footer id="footer" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
 
    <div class="footer-newsletter">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <h4>Our Newsletter</h4>
            <p>Recieve latest information from us</p>
          </div>
          <div class="col-lg-6">
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>
 
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Odyssey</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="#">Odyssey Team for NASA Space Apps 2022</a>
      </div>
    </div>
  </footer>
 <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>