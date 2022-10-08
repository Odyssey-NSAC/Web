<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Article View</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
 <link rel="shortcut icon" href="assets/img/icon-48x48.png" >

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"></script>

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" rel="stylesheet"/>

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
    <style>
        #heart,#thumbsUp,#insightFull:hover{
            cursor:pointer;
            padding-right:15px;
        }
    </style>
    	<script>
		tinymce.init({
		  selector: '#mytextarea',
		  plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect',
		  toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
		  tinycomments_mode: 'embedded',
		  tinycomments_author: 'Author name',
		  mergetags_list: [
			{ value: 'First.Name', title: 'First Name' },
			{ value: 'Email', title: 'Email' },
		  ],
		});
	</script>

	<script type="text/javascript">
        function preventBack() { window.history.forward(); }
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };
    </script>
    
    <script>
        $(document).ready(function(e){
            // Submit form data via Ajax
            $("#fupForm").on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'feedback.php',
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function(){
                        $('.submitBtn').attr("disabled","disabled");
                        $('#fupForm').css("opacity",".5");
                    },
                    success: function(response){
                        if(response.status === 1){
                            $('#fupForm')[0].reset();
                            alert(response.message);
                            document.getElementById('feedback').innerHTML = 'You already submitted a feedback to this article';
                        }else{
                            alert(response.message);
                        }
                    }
                });
            });
        });
    </script>
    
    <script>
        $(document).ready(function(e){
            // Submit form data via Ajax
            $("#follow").on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'follow.php',
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function(){
                        $('.followBtn').attr("disabled","disabled");
                    },
                    success: function(response){
                        if(response.status === 1){
                            $('#follow')[0].reset();
                            alert('done');
                        }else{
                            alert(response.message);
                        }
                    }
                });
            });
        });
    </script>

</head>

<body>
    <?php 
        unset($_SESSION['Array']);
        $article_id = $_GET['id'];
        $servername = "localhost";
        $username = "";
        $password = "";
        $DBname = "";
        
        $conn = new mysqli($servername, $username, $password, $DBname);
        $result_status = 0;
        if ($conn->connect_error){
            die("Connection Failed:". $conn->connect_error);
        }
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        if(isset($_POST['comment'])){
            $comment = $_POST['comment'];
            $comment_insert_sql = "INSERT INTO article_comment(article_id, email, name,  comment_body,submitted_on)
                                    VALUES('$article_id', '$email', '$name', '$comment',NOW())";
            //unset($_POST['comment']);
            if ($conn->query($comment_insert_sql) === TRUE) {
                echo "<script> alert('Your comment is posted')</script>";
            } else {
                echo "<script>OOps!We couldn't post your comment</script>";
            }

        }
        $articleInfo_sql = "SELECT*FROM article_info
                        WHERE article_id = '$article_id'";
        
        $result = $conn->query($articleInfo_sql); 
        $article_row = $result->fetch_assoc();
        $article_activity = $article_row['activity'];
        $f_name = $article_row['f_name'];
        
        $author_email = $article_row['email'];
        $_SESSION['author_email'] = $author_email;
        $author_sql = "SELECT authors_info.name, authors_info.country, authors_info.associated, authors_info.interest_category FROM authors_info 
                        INNER JOIN article_info ON authors_info.email = article_info.email
                        WHERE authors_info.email = '$author_email'";
                
        $result = $conn->query($author_sql); 
        $author_row = $result->fetch_assoc();
        
        $articles_sql = "SELECT article_id,title, submitted_on, marks_obtained, activity
                        FROM article_info
                        WHERE email = '$author_email'
                        ORDER BY marks_obtained DESC
                        LIMIT 5";
        $result = $conn->query($articles_sql);
        
        $activity_count = "SELECT COUNT(activity) AS count,activity 
                           FROM article_info WHERE email = '$author_email' 
                           GROUP BY activity";
        
        $count_result = $conn->query($activity_count);
        
        $comment_sql = "SELECT*FROM article_comment
                        WHERE article_id = '$article_id'";
        $comment_result = $conn->query($comment_sql);
        
        $questions_sql = "SELECT*FROM questionnaires
                          WHERE feedback_type='global' AND activity='$article_activity'";
        $questionnaires = $conn->query($questions_sql);
        
        $mark_submission_check_sql = "SELECT*FROM global_mark
                                      WHERE article_id='$article_id' AND email='$email'"; 
        $mark_submission_result = $conn->query($mark_submission_check_sql);
        
        $follow_check_query = "SELECT*FROM follow
                                WHERE author_email ='$author_email' AND reviewer_email = '$email'";
        
        $follow_check = $conn->query($follow_check_query);
    ?>
    
    <header id="header" class="fixed-top d-flex align-items-center ">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        <h1 class="text-light"><a href="index.php"><span>Odyssey</span></a></h1>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="Articles.php">Articles</a></li>
          <a href="article_view.php" class="active">Article View</a></li>
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
  </header>
  <main id="main">
    <!-- ======= Blog Single Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-8 entries">

            <article class="entry entry-single">

              <div class="entry-img">
                <img src="assets/img/1.jpg" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title">
                  <?php echo $article_row['title']; ?>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="bi bi-person"></i>0</li>
                  <li class="d-flex align-items-center"><i class="bi bi-clock"></i><?php echo $article_row['submitted_on']; ?></li>
                  <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i>0</li>
                </ul>
                <ul>
                    <li class="d-flex align-items-center"><small>Ideal for |&nbsp;&nbsp;<i class="bi bi-mortarboard"></i><?php echo ''.$article_row['edu_status'].' --- '; ?>
                    <i class="bi bi-people"></i><?php echo $article_row['age_range'].' Years'; ?></small></li>
                </ul>
              </div>

              <div class="entry-content">
                <blockquote>
                    <h4 class="h4" style="text-align:left;">Abstract</h4>
                    <p style="text-align:justify;font-size:16px;"><?php echo $article_row['abstract']; ?></p>
                </blockquote>

                <p>
                    <h4 class="h4" style="text-align:left;">Description</h4>
                    <p style="padding-left:20px;text-align:justify;"><?php echo $article_row['description']; ?></p>
                </p>
                <div class="embed-responsive embed-responsive-16by9">
                  <iframe src=
                    "uploads/<?php echo $f_name;?>" 
                    width="800" 
                    height="800"></iframe>
                </div>
              </div>

              <div class="entry-footer">
                <i class="fa fa-heart-o" id="heart" onclick="heart()" style="color:black;font-size:25px;"></i>
                <i class="fa fa-thumbs-o-up" id="thumbsUp" onclick="thumbsUp()" style="color:black;font-size:25px;"></i>
                <i class="fa fa-lightbulb-o" id="insightFull" onclick="insightFull()" style="color:black;font-size:25px;"></i>
              </div>

            </article><!-- End blog entry -->

            <div class="blog-comments">

              <h4 class="comments-count">
                  <?php if($comment_result->num_rows === 1){
                            echo $comment_result->num_rows.' Comment'; 
                        }else{
                            echo $comment_result->num_rows.' Comments';
                        }?>
                    </h4>
                <?php 
                    while($row = $comment_result->fetch_assoc()) {
                        $comment = $row['comment_body'];
                        $name = $row['name'];
                        $date = $row['submitted_on'];
                        
                          echo '<div id="comment-1" class="comment">
                                    <div class="d-flex">
                                      <div class="comment-img"><img src="assets/img/avatar_user.jpg" class="img-fluid rounded-circle mb-2" alt=""></div>
                                      <div>
                                        <h5>'.$name.'<a href="#" class="reply"><i class="bi bi-reply-fill"></i> Reply</a></h5>
                                        <time datetime="2020-01-01">'.$date.'</time>
                                        <p>'.$comment.'</p>
                                      </div>
                                    </div>
                                  </div>';
                        }
                ?>

              <div class="reply-form">
                <h4>Leave a Reply</h4>
                <p>Give your suggesions to improve this article</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id=<?php echo $article_id;?>" method="post">
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <input name="name" type="hidden" class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                      <input name="email" type="hidden" class="form-control">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col form-group">
                      <textarea name="comment" class="form-control" placeholder="Your Comment*"></textarea>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Post Comment</button>

                </form>

              </div>

            </div><!-- End blog comments -->

          </div><!-- End blog entries list -->
          
            <div class="col-lg-4">

                <div class="sidebar">
                    <div class="card-header">
			            <h5 class="sidebar-title">Author Info</h5>
			        </div>
			    <div class="card-body text-center">
				    <img src="assets/img/avatar_user.jpg" alt="#" class="img-fluid rounded-circle mb-2" width="128" height="128" />
				    <h5 class="card-title mb-0"><?php echo $author_row['name'];?></h5>
				<div class="text-muted mb-2">
				    Associated With <?php echo $author_row['associated']; ?><br>
				    <?php echo $author_row['country']; ?></div>
				<form id="follow" enctype="multipart/form-data">
				<div><?php 
				if($follow_check->num_rows === 0){
					echo '<button type="submit" class="btn btn-primary btn-sm followBtn">Follow&nbsp;<i class="bi bi-person-plus"></i></button>';
				}else{
				    echo '<button type="submit" class="btn btn-primary btn-sm followBtn" disabled>Following&nbsp;<i class="bi bi-check"></i></button>';}?>
				</div>
				</form>
			    </div> 
                  <h3 class="sidebar-title">Activities</h3>
                  <div class="sidebar-item categories">
                    <ul>
                        <?php 
                            while($row=$count_result->fetch_assoc()){
                                $count = $row['count'];
                                $activity = $row['activity'];
                                echo "<li>$activity<span>($count)</span></li>";
                            };?>
                    </ul>
                  </div><!-- End sidebar categories-->

              <h3 class="sidebar-title">Author's Top Articles</h3>
                <?php 
                    while($row = $result->fetch_assoc()) {
                        $title = $row['title'];
                        $mark = $row['marks_obtained'];
                        $date = $row['submitted_on'];
                        $article_id = $row['article_id'];
                          echo 
                            '<div class="sidebar-item recent-posts">
                                <div class="post-item ">
                                    <img src="assets/img/1.jpg" alt="">
                                    <h4><a href="article_view.php?id='.$article_id.'">'.$title.'</a></h4>
                                    <time datetime="2020-01-01">'.$date.' | Mark : '.$mark.'</time>
                                </div>
                            </div>';
                    }
                ?>
                <div class="card-body">
	    			<h5 class="sidebar-title">Intrested Fields</h5>
	    			<a href="#" class="badge bg-primary me-1 my-1" disabled><?php echo $author_row['interest_category']; ?></a>
	    		</div>

            </div><!-- End sidebar -->
                    <div class="sidebar">
                            <?php
                                if($mark_submission_result->num_rows === 0){
                                    echo '<h5 class="sidebar-title" id="feedback">Feedback Form</h5>
                                            <form id="fupForm" enctype="multipart/form-data">';
                                    $row = $questionnaires->fetch_assoc();
                                    $Array = explode(",",$row['questionnaire']);
                                    $count = 0;
                                    foreach($Array as $value){
                                        $count++;
                                        echo'<p>
                                                <label for="customRange3" class="form-label" style="font-size:15px;">'.$count.'. '.$value.'</label>
                                                <input type="range" name="mark'.$count.'" class="form-range" min="1" max="10" step="1" value="1" id="customRange1">
                                            </p>';
                                    }
                                }else{
                                    echo '<h5 class="sidebar-title" id="feedback">You already submitted a feedback form for this article</h5>';
                                }
                            ?>
                            <input type="hidden" name="question_count" value="<?php echo $count;?>">
                            <input type="hidden" name="article_id" value="<?php echo $_GET['id'];?>">
                            <button type="submit" name="submit" class="btn btn-success btn-sm submitBtn">Submit your honest feedback</button>
                        </form>
    			    </div>
          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Single Section -->

  </main><!-- End #main -->

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
        function heart(){
            document.getElementById("heart").style.color = "red";
            document.getElementById("thumbsUp").style.color = "black"
            document.getElementById("insightFull").style.color = "black"
        }
        function thumbsUp(){
            document.getElementById("heart").style.color = "black";
            document.getElementById("thumbsUp").style.color = "blue"
            document.getElementById("insightFull").style.color = "black"
        }
        function insightFull(){
            document.getElementById("heart").style.color = "black";
            document.getElementById("thumbsUp").style.color = "black"
            document.getElementById("insightFull").style.color = "yellow"
        }
    </script>
    <script>
        $('#customRange1').mdbRange({
          single: {
            active: true,
            multi: {
              active: true,
              rangeLength: 1
            },
          }
        });
    </script>
    
</body>

</html>