<?php 
	session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="assets/img/icon-48x48.png" >

	<title>Submissions</title>

	<link href="assets/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<script src="https://cdn.tiny.cloud/1/jhfoyrg4gev87l7u30pux11eolws2oqypklp4mk4ua79qxkr/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
                    url: 'submit.php',
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
                            location.replace("self_eval.php");
                        }else{
                            alert(response.message);
                        }
                        $('#fupForm').css("opacity","");
                        $(".submitBtn").removeAttr("disabled");
                    }
                });
            });
        });
    </script>
</head>

<body>
	<div class="wrapper">
	    
	    <nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href=" Author_Dashboard.php">
          			<span class="align-middle">Odyssey Dashboard</span>
        		</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Account
					</li>

                    <li class="sidebar-item">
						<a class="sidebar-link" href="index.php">
              			<i class="align-middle" data-feather="home"></i> <span class="align-middle">Home</span>
           				</a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href=" Author_Dashboard.php">
              			<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
           				</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="author-profile.php">
              			<i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="connections.php">
              			<i class="align-middle" data-feather="users"></i> <span class="align-middle">Connections</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="logout.php">
              			<i class="align-middle" data-feather="log-out"></i> <span class="align-middle">Log Out</span>
            			</a>
					</li>

					<li class="sidebar-header">
						Manage Activities
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="publications.php">
              			<i class="align-middle" data-feather="book"></i> <span class="align-middle">Publications</span>
            			</a>
					</li>


					<li class="sidebar-item  active">
						<a class="sidebar-link" href="submissions.php">
              			<i class="align-middle" data-feather="upload"></i> <span class="align-middle">Submission</span>
            			</a>
					</li>
					
					<li class="sidebar-item">
						<a class="sidebar-link" href="activity-award.php">
              			<i class="align-middle" data-feather="award"></i> <span class="align-middle">Activity Award</span>
            			</a>
					</li>

					<li class="sidebar-header">
						Review Activities
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="author-history.php">
              			<i class="align-middle" data-feather="rotate-ccw"></i> <span class="align-middle">History</span>
            			</a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="author-award.php">
              			<i class="align-middle" data-feather="award"></i> <span class="align-middle">Review Award</span>
            			</a>
					</li>

				</ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          		<i class="hamburger align-self-center"></i>
        		</a>
				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="bell"></i>
									<span class="indicator">4</span>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
								<div class="dropdown-menu-header">
									4 New Notifications
								</div>
								<div class="list-group">
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-danger" data-feather="alert-circle"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Update completed</div>
												<div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
												<div class="text-muted small mt-1">30m ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-warning" data-feather="bell"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Lorem ipsum</div>
												<div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
												<div class="text-muted small mt-1">2h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-primary" data-feather="home"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Login from 192.186.1.8</div>
												<div class="text-muted small mt-1">5h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-success" data-feather="user-plus"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">New connection</div>
												<div class="text-muted small mt-1">Christina accepted your request.</div>
												<div class="text-muted small mt-1">14h ago</div>
											</div>
										</div>
									</a>
								</div>
								<div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Show all notifications</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="message-square"></i>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
								<div class="dropdown-menu-header">
									<div class="position-relative">
										4 New Messages
									</div>
								</div>
								<div class="list-group">
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="assets/img/avatar_user.jpg" class="avatar img-fluid rounded-circle" alt="">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Vanessa Tucker</div>
												<div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu tortor.</div>
												<div class="text-muted small mt-1">15m ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="assets/img/avatar_user.jpg " class="avatar img-fluid rounded-circle" alt="">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">William Harris</div>
												<div class="text-muted small mt-1">Curabitur ligula sapien euismod vitae.</div>
												<div class="text-muted small mt-1">2h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="assets/img/avatar_user.jpg " class="avatar img-fluid rounded-circle" alt="">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Christina Mason</div>
												<div class="text-muted small mt-1">Pellentesque auctor neque nec urna.</div>
												<div class="text-muted small mt-1">4h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="assets/img/avatar_user.jpg " class="avatar img-fluid rounded-circle" alt="">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Sharon Lessman</div>
												<div class="text-muted small mt-1">Aenean tellus metus, bibendum sed, posuere ac, mattis non.</div>
												<div class="text-muted small mt-1">5h ago</div>
											</div>
										</div>
									</a>
								</div>
								<div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Show all messages</a>
								</div>
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
								<img src="assets/img/avatar_user.jpg " class="avatar img-fluid rounded-circle me-1" alt="" /> <span class="text-dark"><?php echo $_SESSION["name"];?></span>
							</a>
						</li>
					</ul>
				</div>
			</nav>
			
			<main class="content">
				<form id="fupForm" enctype="multipart/form-data">
					<div class="container-fluid p-0">

						<div class="mb-3">
							<h1 class="h3 d-inline align-middle">Submit Your Article With Others</h1>
						</div>
						<div class="row">
							<div class="col-sm">
								<div class="card">
									<div class="card-header">
										<h5 class="card-title mb-0">1. Category</h5>
									</div>
									<div class="card-body">
										<select class="form-select mb-3" name="category" id="category" required>
											<option value="" selected="selected" disabled>Select Category</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm">
								<div class="card">
									<div class="card-header">
										<h5 class="card-title mb-0">2. Sub Category</h5>
									</div>
									<div class="card-body">
										<select class="form-select mb-3" name="sub_category" id="sub-category" required>
											<option value="" selected="selected" disabled>Select Category</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm">
								<div class="card">
									<div class="card-header">
										<h5 class="card-title mb-0">3. Science Activity</h5>
									</div>
									<div class="card-body">
										<select class="form-select mb-3" name="activity" id="activity" required>
											<option value="" selected="selected" disabled>Select Sub Category First</option>
										</select>
									</div>
								</div>
							</div>
						</div>	
						<div class="row">
							<div class="col-12 col-lg-6">
								<div class="card">
									<div class="card-header">
										<h5 class="card-title mb-0">4. Topic Of Your Activity</h5>
									</div>
									<div class="card-body">
										<input type="text" class="form-control" placeholder="Title" name="title" required>
									</div>
								</div>
								<div class="card">
									<div class="card-header">
										<h5 class="card-title mb-0">5. Abstract</h5>
									</div>
									<div class="card-body">
										<textarea class="form-control" rows="2" placeholder="maximum 200 words" name="abstract" required></textarea>
									</div>
								</div>
								<div class="card">
									<div class="card-header">
										<h5 class="card-title mb-0">6. Description</h5>
									</div>
									<div class="card-body">
										<textarea class="form-control" rows="2" placeholder="Describe your activity in full"  name="description" required></textarea>
									</div>
								</div>
								<div class="card">
									<div class="card-header">
										<h5 class="card-title mb-0">7. Content</h5>
									</div>
									<div class="card-body">
										<textarea id="mytextarea" placeholder="You can compose your article here and export it as pdf and upload. If you have already composed one just upload it."></textarea>
										<br>
                                        <input type="file" class="form-control" id="file" name="file" required />
									</div>
								</div>
							</div>
							<div class="col-12 col-lg-6">
								<div class="card">
									<div class="card-header">
										<h5 class="card-title mb-0">8. Ideal Participants</h5>
									</div>
									<div class="card-body">
										<select class="form-select mb-3" name="age_range" id="activity" required>
											<option value="" selected="selected" disabled>Age Range (Years)</option>
											<option value="1-10">1-10</option>
											<option value="10-17">11-17</option>
											<option value="18-24">18-24</option>
											<option value="25-34">25-34</option>
											<option value="35-44">35-44</option>
											<option value="45-54">45-54</option>
											<option value="55-64">55-64</option>
											<option value="Above 65">Above 65</option>
										</select>
										<select class="form-select mb-3" name="edu_status" id="activity" required>
											<option value="" selected="selected" disabled>Highest Education Status</option>
											<option value="Doctorate">Doctorate</option>
											<option value="Masters Degree">Masters Degree</option>
											<option value="Bachelors Degre">Bachelors Degree</option>
											<option value="Foundation Degree / HND">Foundation Degree / HND</option>
											<option value="HNC">HNC</option>
											<option value="College">College</option>
											<option value="Other">Other</option>
										</select>
									</div>
								</div>
								<div class="card">
									<div class="card-header">
										<h5 class="card-title mb-0">10. Participant Count</h5>
									</div>
									<div class="card-body">
										<input type="number" class="form-control" name="participant_count" placeholder="" required>
									</div>
								</div>
								<div class="card">
									<div class="card-header">
										<h5 class="card-title mb-0">11. Citations</h5>
									</div>
									<div class="card-body">
										<textarea class="form-control" name="cite" rows="4" placeholder="" maxlength="100" required></textarea>
									</div>
								</div>
								<div class="card">
									<div class="card-header">
										<h5 class="card-title mb-0">12. Co-Authors</h5>
									</div>
									<div class="card-body">
										<textarea class="form-control" name="co_author" rows="2" placeholder="" maxlength="100"></textarea>
									</div>
								</div>
							</div>
						</div>

					</div>
					<div class="text-end mt-3">
						<button type="submit" name="submit" class="btn btn-lg btn-success">Submit Your Work</button>
						<!--<input type="submit"  class="btn btn-primary submitBtn" value="SUBMIT"/>-->
					</div>
				</form>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="#" target="_blank"><strong>Odyssey</strong></a> - <a class="text-muted" href="#" target="_blank"></a>&copy;odysseymetric.co
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="#" target="_blank">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#" target="_blank">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#" target="_blank">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#" target="_blank">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="js/app.js"></script>
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
				"Algorithms And Data Structures":["Computer Vision"],
				"Information Technology":["Research Paper","Night Camp","Workshop","Quiz","Video Series","Podcast Series","Lecture Series","Online Activity","Physical Activity"],
				"Machine Learning":["Data Mining","Model Training"],
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