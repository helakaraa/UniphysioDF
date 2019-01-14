<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
?>

<?php include("header.php"); 
  include("library.php");?>

	<!--services-->
	<div class="services">
		<div class="container">
			<h3>Especialidades</h3>

			<div class="row services-info">			
				<div class="col-sm-6 col-md-4 services-grids">
					<div class="thumbnail">
						<div class="moments-bottom">
							<a href="images/img11.jpeg">
								<img src="images/img11.jpeg" class="img-responsive zoom-img " alt="">				
							</a>
						</div>
						<div class="caption services-caption">
							<h4><a href="#">Fisioterapia geriátrica</a></h4>
									
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 services-grids">
					<div class="thumbnail">
						<div class="moments-bottom">
							<a href="images/fisio2.png">
								<img src="images/fisio2.png" class="img-responsive zoom-img " alt="">				
							</a>
						</div>
						<div class="caption services-caption">
							<h4><a href="#">Fisioterapia ortopédica</a></h4>
									
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 services-grids">
					<div class="thumbnail">
						<div class="moments-bottom">
							<a href="images/img10.jpeg">
								<img src="images/img10.jpeg" class="img-responsive zoom-img " alt="">				
							</a>
						</div>
						<div class="caption services-caption">
							<h4><a href="#">Osteopatia</a></h4>
										
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 services-grids">
					<div class="thumbnail">
						<div class="moments-bottom">
							<a href="images/fisio4.jpg">
								<img src="images/fisio4.jpg" class="img-responsive zoom-img " alt="">				
							</a>
						</div>
						<div class="caption services-caption">
							<h4><a href="#">Método McKenzie</a></h4>
									
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 services-grids">
					<div class="thumbnail">
						<div class="moments-bottom">
							<a href="images/fisio5.jpg">
								<img src="images/fisio5.jpg" class="img-responsive zoom-img " alt="">				
							</a>
						</div>
						<div class="caption services-caption">
							<h4><a href="#">Acupuntura</a></h4>
									
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 services-grids">
					<div class="thumbnail">
						<div class="moments-bottom">
							<a href="images/fisio6.jpg">
								<img src="images/fisio6.jpg" class="img-responsive zoom-img " alt="">				
							</a>
						</div>
						<div class="caption services-caption">
							<h4><a href="#">Ventosaterapia</a></h4>
									
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 services-grids">
					<div class="thumbnail">
						<div class="moments-bottom">
							<a href="images/fisio7.jpg">
								<img src="images/fisio7.jpg" class="img-responsive zoom-img " alt="">				
							</a>
						</div>
						<div class="caption services-caption">
							<h4><a href="#">Realidade Virtual</a></h4>
									
						</div>
					</div>
				</div>
                     <div class="col-sm-6 col-md-4 services-grids">
					<div class="thumbnail">
						<div class="moments-bottom">
							<a href="images/fisioterapia-respiratoria.jpg">
								<img src="images/fisioterapia-respiratoria.jpg" class="img-responsive zoom-img " alt="">				
							</a>
						</div>
						<div class="caption services-caption">
							<h4><a href="#">Fisioterapia Cardiorespiratória</a></h4>
									
						</div>
					</div>
				</div>
	           </div>

               <h3>Em breve</h3>


			<div class="row services-info">			

				<div class="col-sm-6 col-md-4 services-grids"  style="margin-left: 200px">
					<div class="thumbnail">
						<div class="moments-bottom">
							<a href="images/fisio8.jpg">
								<img src="images/fisio8.jpg" class="img-responsive zoom-img " alt="">				
							</a>
						</div>
						<div class="caption services-caption">
							<h4><a href="#">Pilates</a></h4>
									
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-4 services-grids">
					<div class="thumbnail">
						<div class="moments-bottom">
							<a href="images/fisio9.png">
								<img src="images/fisio9.png" class="img-responsive zoom-img " alt="">				
							</a>
						</div>
						<div class="caption services-caption">
							<h4><a href="#">Hidroterapia</a></h4>
									
						</div>
					</div>
				</div>

	
				<div class="clearfix"> </div>
			</div>
			<!--light-box-js -->
				<script src="js/jquery.chocolat.js"></script>
				<!--light-box-files -->
				<script type="text/javascript">
				$(function() {
					$('.moments-bottom a').Chocolat();
				});
				</script> 
			<!--//end-gallery js-->
		</div>
	</div>	
<?php  include("footer.php"); ?>