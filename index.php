<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
?>

<?php include("header.php"); 
    include("library.php");

    $sql = "SELECT slides_image, slide_caption, `slide_number` FROM `slides` WHERE `slide_active`=1 order by `slide_number`";
    $result = $connection->query($sql);
?>

	<div id="slider">
    <div class="flexslider">
        <ul class="slides">
            <?php

            if($result->num_rows>0){
                while($row=$result->fetch_assoc())
                {
                    $cap=$row["slide_caption"];
                    $path="images/".$row['slides_image'];

                    ?>
                    <li>
                        <div class="slider-caption" style="color:#000; margin-top: 400px">
                            <?php echo $cap  ?>
                        </div>
                        <img src="<?php echo $path  ?>" alt="" />
                    </li>
                <?php }}?>
        </ul>
    </div>
    </div>


    <!-- welcome -->
<div id="about" class="welcome">
  <div class="container">
    <h3 class="agileits-title">Quem somos?</h3>

    <p class="w-text">                  <?php
                        $q="SELECT `about` FROM `contact`";
                        $rre=$connection->query($q);
                        $row=$rre->fetch_assoc();
                        echo $row['about'];

                        ?></p>
   
  </div>
		
</div>
<!-- //welcome -->

<!-- team -->
<div id="team" class="team jarallax">
  <div class="container">
    <h3 class="agileits-title w3title1">Nossa equipe</h3>
    <div class="row">
               <div class="col-md-12">
                   <div class="heading-section">
              
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
<!-- //team -->

	
	<!--work-->
	<div class="work">		
		<div class="container">	
			<div class="work-title">
				<h3>Missão, visão e valores</h3>
				
			</div>
			<div class="col-md-4 work-grids">
				<ul>
					<li><img src="images/icon3.png" alt=""></li>
					<li>
						<h4>Missão</h4>
						<p>"Prestar servião de qualidade e excelencia com enfoque no bem estar cli­nico e solução do problema do paciente."</p>
					</li>
				</ul>
			</div>	
			<div class="col-md-4 work-grids">
				<ul>
					<li><img src="images/icon2.png" alt=""></li>
					<li>
						<h4>Visão</h4>
						<p>"Ser uma empresa de referencia na assistencia fisioterapautica, prevenção e reabilitação, atuando com profissionais habilitados, dedicados e motivados na promoção do bem estar e qualidade de vida de todos."</p>
					</li>
				</ul>
			</div>
			<div class="col-md-4 work-grids">
				<ul>
					<li><img src="images/icon4.png" alt=""></li>
					<li>
						<h4>Valores</h4>
						<p>"Etica, foco no problema e solução, honestidade, compromisso, excelencia no atendimento e bem estar "</p>
					</li>
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!--//work-->
    
    <!-- gallery -->
<div id="gallery" class="gallery">
  <div class="container">
    <h3 class="agileits-title w3title1">Galeria</h3>
    <div class="gallery-grids">
      <div class="col-sm-4 col-xs-6 gallery-grid">
        <div class="grid effect-apollo">
          <a class="example-image-link" href="images/IMG_1036.JPG" data-lightbox="example-set" data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut sem ac lectus mattis sagittis. Donec pulvinar quam sit amet est vestibulum volutpat. Phasellus sed nibh odio. Phasellus posuere at purus sit amet porttitor.">
            <img src="images/IMG_1036.JPG" alt=""/>
            <div class="figcaption">
              <p></p>
            </div>
          </a>
        </div>
      </div>
      <div class="col-sm-4 col-xs-6 gallery-grid">
        <div class="grid effect-apollo">
          <a class="example-image-link" href="images/IMG_1037.jpg" data-lightbox="example-set" data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut sem ac lectus mattis sagittis. Donec pulvinar quam sit amet est vestibulum volutpat. Phasellus sed nibh odio. Phasellus posuere at purus sit amet porttitor.">
            <img src="images/IMG_1037.jpg" alt=""/>
            <div class="figcaption">
              <p></p>
            </div>
          </a>
        </div>
      </div>
      <div class="col-sm-4 col-xs-6 gallery-grid">
        <div class="grid effect-apollo">
          <a class="example-image-link" href="images/IMG_1039.jpg" data-lightbox="example-set" data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut sem ac lectus mattis sagittis. Donec pulvinar quam sit amet est vestibulum volutpat. Phasellus sed nibh odio. Phasellus posuere at purus sit amet porttitor.">
            <img src="images/IMG_1039.jpg" alt=""/>
            <div class="figcaption">
              <p></p>
            </div>
          </a>
        </div>
      </div>
      <div class="col-sm-4 col-xs-6 gallery-grid">
        <div class="grid effect-apollo">
          <a class="example-image-link" href="images/IMG_1040.JPG" data-lightbox="example-set" data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut sem ac lectus mattis sagittis. Donec pulvinar quam sit amet est vestibulum volutpat. Phasellus sed nibh odio. Phasellus posuere at purus sit amet porttitor.">
            <img src="images/IMG_1040.JPG" alt=""/>
            <div class="figcaption">
              <p></p>
            </div>
          </a>
        </div>
      </div>
      <div class="col-sm-4 col-xs-6 gallery-grid">
        <div class="grid effect-apollo">
          <a class="example-image-link" href="images/IMG_1041.jpg" data-lightbox="example-set" data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut sem ac lectus mattis sagittis. Donec pulvinar quam sit amet est vestibulum volutpat. Phasellus sed nibh odio. Phasellus posuere at purus sit amet porttitor.">
            <img src="images/IMG_1041.jpg" alt=""/>
            <div class="figcaption">
              <p></p>
            </div>
          </a>
        </div>
      </div>
      <div class="col-sm-4 col-xs-6 gallery-grid">
        <div class="grid effect-apollo">
          <a class="example-image-link" href="images/IMG_1042.jpg" data-lightbox="example-set" data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut sem ac lectus mattis sagittis. Donec pulvinar quam sit amet est vestibulum volutpat. Phasellus sed nibh odio. Phasellus posuere at purus sit amet porttitor.">
            <img src="images/IMG_1042.jpg" alt=""/>
            <div class="figcaption">
              <p></p>
            </div>
          </a>
        </div>
      </div>
      <div class="col-sm-4 col-xs-6 gallery-grid">
        <div class="grid effect-apollo">
          <a class="example-image-link" href="images/IMG_1046.jpg" data-lightbox="example-set" data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut sem ac lectus mattis sagittis. Donec pulvinar quam sit amet est vestibulum volutpat. Phasellus sed nibh odio. Phasellus posuere at purus sit amet porttitor.">
            <img src="images/IMG_1046.jpg" alt=""/>
            <div class="figcaption">
              <p></p>
            </div>
          </a>
        </div>
      </div>
      <div class="col-sm-4 col-xs-6 gallery-grid">
        <div class="grid effect-apollo">
          <a class="example-image-link" href="images/IMG_1043.jpg" data-lightbox="example-set" data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut sem ac lectus mattis sagittis. Donec pulvinar quam sit amet est vestibulum volutpat. Phasellus sed nibh odio. Phasellus posuere at purus sit amet porttitor.">
            <img src="images/IMG_1043.jpg" alt=""/>
            <div class="figcaption">
              <p></p>
            </div>
          </a>
        </div>
      </div>
      <div class="col-sm-4 col-xs-6 gallery-grid">
        <div class="grid effect-apollo">
          <a class="example-image-link" href="images/IMG_1044.jpg" data-lightbox="example-set" data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ut sem ac lectus mattis sagittis. Donec pulvinar quam sit amet est vestibulum volutpat. Phasellus sed nibh odio. Phasellus posuere at purus sit amet porttitor.">
            <img src="images/IMG_1044.jpg" alt=""/>
            <div class="figcaption">
              <p></p>
            </div>
          </a>
        </div>
      </div>
      <div class="clearfix"> </div>
    </div>
    <script src="js/lightbox-plus-jquery.min.js"> </script>
  </div>
</div>
<!-- //gallery -->
	
<!-- news -->
<div id="news" class="services news">
  <div class="container">
    <h3 class="agileits-title">Últimas Noticias</h3>
    
  <?php
       $a="SELECT `item_id`, `item_name`,`item_desc`, `item_image`, date( `item_time`) DT FROM `artigos` WHERE `item_active`=1 order by `item_id` DESC  limit 0,3";
       $items=$connection->query($a);
       while($r=$items->fetch_assoc()){
           $item_id=base64_encode($r['item_id']);
           $item_name=$r['item_name'];
           $item_desc=$r['item_desc'];
           $item_img=$r['item_image'];
           $item_date=$r['DT'];

       ?>
    <div class="col-sm-4 news-w3lgrids">
      <div class="news-agileinfo">
    
        <div class="news-gridtext">
          <div class="news-w3img">
            <a  href="images/<?php echo $item_img; ?>" data-toggle="modal"><img src="images/<?php echo $item_img; ?>" class="img-responsive zoom-img" alt=""/></a>
          </div>
          <div class="news-w3imgtext">
            <h5 class="w3-agilep"><?php echo $item_date; ?></h5>
            <h4><a href="#myModal" data-toggle="modal"><a href="<?php echo "details.php?item=".$item_id; ?>"><?php echo $item_name; ?></a></h4>

          </div>
         
        </div>
        
      </div>
      
      <div class="clearfix"> </div>
     
    </div>
     <?php }?>
  </div>
</div>
<!-- //news -->

<div id="testimonails">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="heading-section">
               
    <div class="work-title" style="margin-top: 40px">

        <h3>O que os pacientes dizem</h3>
        </div>
                 
                    <img src="images/under-heading.png" alt="" >
                </div>
            </div>
        </div>

        <?php

        $sql = "SELECT `testomonial_text`, `testomonial_person`, `testomonial_post`, `testomonial_link` FROM `testomonial` WHERE `testmonial_active` =1";
        $result=$connection->query($sql);
        if($result->num_rows>0){
            ?>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="testimonails-slider">
                        <ul class="slides">
                            <?php	
                            while($row=$result->fetch_assoc())
                            {
                                $txt=$row["testomonial_text"];
                                $person=$row["testomonial_person"];
                                $post=$row["testomonial_post"];
                                $link=$row["testomonial_link"];
                                ?>
                                <li>
                                    <div class="testimonails-content">
                                        <div class="w3l-info1">
                                <div class="col-md-3 testimonials-grid-1">
                                    <img src="images/user.png" alt="" class="img-circle" width="100" height="100"/> 
                                </div>
                                <div class="col-md-9 testimonials-grid-2">
                                    <h4><?php echo $person; ?></h4>
                                    <h5><?php echo $post; ?></h5>
                                    <p><?php echo $txt; ?></p>
                                </div>
                            </div>
                                    </div>
                                </li>

                            <?php
                            } ?>

                        </ul>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>
</div>
</div>

<?php  include("footer.php"); ?>
