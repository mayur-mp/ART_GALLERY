		<div class="row footer" style="background-color: #0BE0FD">
			<div class="col-md-12">
				<div class="row inner_footer">
					<div class="col-md-3 quick_links">
						<h3>Quick Links</h3>
						<ul>
							<li <?php if($page=="index") echo 'class="active"' ?>><a href="index.php">Home</a></li>
							<li <?php if($page=="Aboutus") echo 'class="active"' ?>><a href="http://127.0.0.1:5500/aboutus.html">About us</a></li>
							<li <?php if($page=="Arts") echo 'class="active"' ?>><a href="arts.php">Arts</a></li>
							<li <?php if($page=="contact_us") echo 'class="active"' ?>><a href="contact_us.php">Reach us</a></li>
						</ul>
					</div>
					<div class="col-md-9 email_subscriber">
						<h3>Email Subscriber</h3>
						<form method="post">
							<input type="Email" name="Email_subscriber" placeholder="Email" /><br />
							<input type="submit" value="Subscriber" />
						</form>
					</div>
				</div>
				<div class="row copyright_tag">
					<div class="col-md-12">
						<h4>Copyright &copy; 2023 Art Gallery</h4>
					</div>
				</div>
			</div>
		  </div>
		</div>
	<?php
			require_once('Admin/dbconclose.php');
	?>
    <script src="js/jquery.js"></script>
    <script src="js/script.js"></script>  
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>