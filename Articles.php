<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Articles</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="shortcut icon" href="assets/img/icon-48x48.png" >
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
  <link href="assets/css/app.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/custom css/blog_customized.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <?php
        $servername = "localhost";
        $username = "";
        $password = "";
        $DBname = "";
        
        $conn = new mysqli($servername, $username, $password, $DBname);
    
        if ($conn->connect_error){
            die("Connection Failed:". $conn->connect_error);
        }
        $category = $sub_category = $activity = '';
        if (isset($_SESSION['Array'])){
            $category = $_SESSION['Array'][1];
            $sub_category = $_SESSION['Array'][2];
            $activity = $_SESSION['Array'][3];
        }
        $result_status = 0;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $category = $_POST["category"];
            $sub_category = $_POST["sub-category"];
            $activity = $_POST["activity"];
        }else{
            $sql_top = "SELECT*FROM article_info
                        ORDER BY marks_obtained DESC
                        LIMIT 3";
            $result_top = $conn->query($sql_top); 
            $result_status = 1;
        }
        $sql = "SELECT*FROM article_info
                WHERE category = '$category' AND sub_category='$sub_category' AND activity='$activity' 
                ORDER BY marks_obtained DESC";
                    
        $result = $conn->query($sql); 
    ?>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center ">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        <h1 class="text-light"><a href="index.php"><span>Odyssey</span></a></h1>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a  href="index.php">Home</a></li>
          <li><a class="active " href="Articles.php">Articles</a></li>
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
  

    <main id="main">

      <!-- ======= Recent Blog Posts Section ======= -->
    <section id="recent-posts" class="recent-posts sections-bg">
        <div class="container" data-aos="fade-up">
  
            <div class="section-header">
                <h2>
                    <?php
                        if ($result->num_rows>0){
                            echo $category.' Articles';
                        }else if($result_status == 1){
                            echo 'Top Articles';
                        }
                        else if($result->num_rows === 0){
                            echo 'Sorry! no result found :(';
                        }
                    ?>
                </h2>
                <p>Didn't you find what you were looking for ? Then, use our advanced search <br>to search for more</p>
                <br>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <div class="row">
        	    	    <div class="col">
        	    		    <div class="card">
        	    			    <div class="card-header">
        	    				    <h5 class="card-title mb-0">Category</h5>
        	    			    </div>
        	    			    <div class="card-body">
        	    				    <select class="form-select mb-3" name="category" id="category" required>
        	    				    	<option value="" selected="selected" disabled>Select Category</option>
        	    				    </select>
        	    			    </div>
        	    		    </div>
        	    	    </div>
        	    	    <div class="col">
        	    		    <div class="card">
        	    			    <div class="card-header">
        	    				    <h5 class="card-title mb-0">Sub Category</h5>
        	    			    </div>
        	    			    <div class="card-body">
        	    				    <select class="form-select mb-3" name="sub-category" id="sub-category"  required>
        	    				    	<option value="" selected="selected" disabled>Select Category   </option>
        	    				    </select>
        	    			    </div>
        	    		    </div>
        	    	    </div>
        	    	    <div class="col">
        	    		    <div class="card">
        	    			    <div class="card-header">
        	    				    <h5 class="card-title mb-0">Science Activity</h5>
        	    			    </div>
        	    			    <div class="card-body">
        	    				    <select class="form-select mb-3" name="activity" id="activity" required>
        	    				    	<option value="" selected="selected" disabled>Select Sub Category   </option>
        	    				    </select>
        	    			    </div>
        	    		    </div>
        	    	    </div>
        	        </div>
        	        <div class="card-body">
        	            <button type="submit" class="btn btn-primary btn-lg active" >Search
        	            <i class="fa fa-search" aria-hidden="true"></i></button>
        	        </div>
                </form>
            </div>
            <div class="row gy-4"><!-- start post item -->
                <?php 
                    if($result_status === 1){
                        if ($result_top->num_rows > 0) {
                            $rank = 1;
                            $mark_check = 0;
                            while($row = $result_top->fetch_assoc()) {
                                $title = $row['title'];
                                $mark = $row['marks_obtained'];
                                $email = $row['email'];
                                $date = $row['submitted_on'];
                                $article_id = $row['article_id'];
                                $category = $row['category'];
                                $sub_category = $row['sub_category'];
                                $activity = $row['activity'];
                                
                                if ($mark < $mark_check){
                                    $rank++;
                                }
                                $mark_check = $mark;
                                $sql = "SELECT authors_info.name FROM authors_info 
                                        INNER JOIN article_info ON authors_info.email = article_info.email
                                        WHERE authors_info.email = '$email'";
                                
                                $author_data = $conn->query($sql)->fetch_assoc();
                                $author_name = $author_data['name'];
                                if (isset($_SESSION['email'])){
                                    $href = "article_view.php";
                                }else{
                                    $href = "pages-sign-up.html";
                                    $status = TRUE;
                                    $_SESSION['Array'] = array($status,$category,$sub_category,$activity);
                                }
                                echo'
                                    <div class="col-xl-4 col-md-6">
                                        <a href="'.$href.'?id='.$article_id.'">
                                        <article>
                                            <div class="post-img">
                                                <img src="assets/img/1.jpg" alt="" class="img-fluid">
                                            </div>
                                            <p class="post-category">'.$sub_category.' | '.$activity.'<br>
                                            <small>
                                                <i class="fa fa-trophy" aria-hidden="true"></i>&nbsp;Rank : '.$rank.' | Total-Mark : '.$mark.'
                                            </small>
                                            </p>
                                            <h2 class="title">
                                                '.$title.'
                                            </h2>
                                            <div class="d-flex align-items-center">
                                                <img src="assets/img/avatar_user.jpg" alt="" class="img-fluid post-author-img flex-shrink-0">
                                                <div class="post-meta">
                                                    <p class="post-author">'.$author_name.'</p>
                                                    <p class="post-date">
                                                        <time datetime="2022-01-01">'.$date.'</time>
                                                    </p>
                                                </div>
                                            </div>
                                        </article></a>
                                    </div>';
                            }
                        }
                    }
                ?>
                <?php 
                    if ($result->num_rows > 0) {
                        $rank = 1;
                        $mark_check = 0;
                        while($row = $result->fetch_assoc()) {
                            $title = $row['title'];
                            $mark = $row['marks_obtained'];
                            $email = $row['email'];
                            $date = $row['submitted_on'];
                            $article_id = $row['article_id'];
                            
                            if ($mark < $mark_check){
                                $rank++;
                            }
                            $mark_check = $mark;
                            
                            $sql = "SELECT authors_info.name FROM authors_info 
                                    INNER JOIN article_info ON authors_info.email = article_info.email
                                    WHERE authors_info.email = '$email'";
                            
                            $author_data = $conn->query($sql)->fetch_assoc();
                            $author_name = $author_data['name'];
                            if (isset($_SESSION['email'])){
                                $href = "article_view.php";
                            }else{
                                $href = "pages-sign-up.html";
                                $status = TRUE;
                                $_SESSION['Array'] = array($status,$category,$sub_category,$activity);
                            }
                            echo'
                                <div class="col-xl-4 col-md-6">
                                    <a href="'.$href.'?id='.$article_id.'">
                                    <article>
                                        <div class="post-img">
                                            <img src="assets/img/1.jpg" alt="" class="img-fluid">
                                        </div>
                                        <p class="post-category">'.$sub_category.' | '.$activity.'<br>
                                        <small>
                                            Rank : '.$rank .' | Total-Mark : '. $mark.'
                                        </small>
                                        </p>
                                        <h2 class="title">
                                            '.$title.'
                                        </h2>
                                        <div class="d-flex align-items-center">
                                            <img src="assets/img/avatar_user.jpg" alt="" class="img-fluid post-author-img flex-shrink-0">
                                            <div class="post-meta">
                                                <p class="post-author">'.$author_name.'</p>
                                                <p class="post-date">
                                                    <time datetime="2022-01-01">'.$date.'</time>
                                                </p>
                                            </div>
                                        </div>
                                    </article></a>
                                </div>';
                        }
                    }
                $conn->close();
                ?>
                <!-- End post list item -->
            </div><!-- End recent posts list -->
        </div>
    </section><!-- End Recent Blog Posts Section -->

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
    <script>
		var Selection = {
			"Physics":{
				"Acoustic":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"],
				"Atomic And Molecular":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"],
				"Classical Mchanics":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"],
				"Crystallography":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"],
				"Electricity And Magnetism":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"],
				"Thermodynamics":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"]
			},
			"Computer Science":{
				"Computer Architecture":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"],
				"Artificial Inteligence":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"],
				"Algorithms And Data Structures":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"],
				"Information Technology":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"],
				"Machine Learning":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"],
				"Cryptography":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"],
				"Software Engineering":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"],
				"Data Science":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"]
			},
			"Astronomy":{
				"General Astronomy":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"],
				"Rocketry":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"],
				"Astro Physics":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"],
				"Cosmology":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"],
				"Astrophotography":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"],
				"Observation":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"]
			},
			"Biology":{
				"Anatomy":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"], 
				"Botany":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"],
				"Zoology":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"],
				"Genetics":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"],
				"Ecology":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"],
				"Marine Biology":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"],
				"Neurobiology":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"],
				"Paleontology":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"]
			}
		}

		window.onload = function() {
			var categorySel = document.getElementById("category");
			var subCategory_Sel = document.getElementById("sub-category");
			var activitySel = document.getElementById("activity");
			for (var x in Selection) {
				categorySel.options[categorySel.options.length] = new Option(x, x);
			}

			categorySel.onchange = function() {
				subCategory_Sel.length = 1;
				activitySel.length = 1;
				for (var y in Selection[this.value]) {
					subCategory_Sel.options[subCategory_Sel.options.length] = new Option(y, y);
				}
			}
			subCategory_Sel.onchange = function() {
				activitySel.length = 1;
				var z = Selection[categorySel.value][this.value];

				for (var i = 0; i < z.length; i++) {
					activitySel.options[activitySel.options.length] = new Option(z[i], z[i]);
				}
			}
		}
	</script>
</body>

</html>