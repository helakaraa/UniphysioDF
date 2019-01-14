<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
?>

<?php include("header.php"); 
  include("library.php");?>
	<!--about-->
	<div class="about"> 
		<div class="container">
			<h3>Quem somos?</h3>

			<div class="about-text">
				
			
				  <?php
                    $q="SELECT `about` FROM `contact`";
                    $rre=$connection->query($q);
                    $row=$rre->fetch_assoc();
                    echo $row['about'];

                    ?>
			
				
				<div class="clearfix"> </div>
			</div>
		</div>
<!--services-->
	<div class="services">
		<div class="container">
		
			<div class="row services-info">			
				<div class="col-sm-6 col-md-4 services-grids">
					<div class="thumbnail">
						<div class="moments-bottom">
							<a href="images/local1.jpg">
								<img src="images/local1.jpg" class="img-responsive zoom-img " alt="">				
							</a>
						</div>
						
					</div>
				</div>
				<div class="col-sm-6 col-md-4 services-grids">
					<div class="thumbnail">
						<div class="moments-bottom">
							<a href="images/local2.jpg">
								<img src="images/local2.jpg" class="img-responsive zoom-img " alt="">				
							</a>
						</div>
						
					</div>
				</div>
				<div class="col-sm-6 col-md-4 services-grids">
					<div class="thumbnail">
						<div class="moments-bottom">
							<a href="images/local4.jpg">
								<img src="images/local4.jpg" class="img-responsive zoom-img " alt="">				
							</a>
						</div>
						
					</div>
				</div>
					
						</div>
					</div>
				</div>
		
		  <div id="our-team" style="margin-top: 40px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading-section">
                        <h3>Nossa equipe</h3>
                        <img src="images/under-heading.png" alt="" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="authors">

                    <?php
                    $staff="SELECT  `staff_name`, `staff_post`, `staff_pic`, `staff_fb`, `staff_link`, `staff_twi`, `staff_time`  FROM `staff` WHERE `staff_active`=1";
                    $staff_r=$connection->query($staff);
                    while($qw=$staff_r->fetch_assoc()){
                        $s_name=$qw['staff_name'];
                    $s_post=$qw['staff_post'];
                    $s_pic=$qw['staff_pic'];
                    $s_fb=$qw['staff_fb'];
                    $s_link=$qw['staff_link'];
                    $s_tw=$qw['staff_twi'];

                    ?>
                    <div class="col-md-3 col-sm-6">
                        <div class="team-thumb">
                            <div class="author">
                                <img src="images/<?php echo $s_pic; ?>" alt="<?php echo $s_name; ?>">
                            </div>
                            <div class="overlay">
                                <div class="author-caption">
                                    <ul>
                                        <li><a href="<?php echo $s_fb; ?>"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="<?php echo $s_tw; ?>"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="<?php echo $s_link; ?>"><i class="fa fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="author-details">
                            <h2><?php echo $s_name; ?></h2>
                            <span><?php echo $s_post; ?></span>
                        </div>
                    </div>
                    <?php }?>

                </div>
            </div>
        </div>
    </div>
		
</div>
<?php  include("footer.php"); ?>