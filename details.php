<?php
session_start();
if(!isset($_GET['item'])){
header("Location:index.php");
}

require("header.php");
require("library.php");

?>
<div id="heading">

<div class="about">
        <div class="container">
            <?php $id=base64_decode($_GET['item']);
            $sql="SELECT `item_name`, `item_fruit`, `item_desc`, `item_image` FROM `artigos` WHERE `item_active`=1 and `item_id`=$id limit 0,5";
            $items=$connection->query($sql);
            if($items->num_rows==1){
            $r=$items->fetch_assoc();
            $item_id=base64_encode($id);
            $item_name=$r['item_name'];
            $item_desc=$r['item_desc'];
            $item_img=$r['item_image'];
            $item_fruit=$r['item_fruit'];
            echo"<script type='text/javascript'>document.title = '$item_name | Pak United Foods';</script>";

            ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="heading-section">
                       <h2 style="font-weight: bold;"><?php echo $item_name; ?></h2>
                        <img src="images/under-heading.png" alt="" />
                    </div>
                </div>
            </div>
            <div id="single-blog" class="page-section first-section">
                <div class="container">
                    <div class="row">
                        <div class="product-item col-md-12">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="image">
                                        <div class="image-post">
                                            <img src="images/<?php echo $item_img; ?>" alt="" class="img-responsive">
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-title">
                                           

                                        </div>
                                        <p style="margin-top: 40px"><?php echo $item_desc; ?></p>
                                    </div>

                                    <div class="divide-line">
                                        <img src="images/div-line.png" alt="" />
                                    </div>
                               
                                </div>
                                <div class="col-md-3 col-md-offset-1">
                                    <div class="side-bar">

                                        <div class="recent-post">
                                            <h4 style="font-size: 16px;
                                                       font-weight: 700;
                                                       color: #fff;
                                                       text-transform: uppercase;
                                                       background-color: #68AF27;
                                                       margin-top: 0px;
                                                       padding: 9px 15px 9px 15px;">Veja tambem</h4>
                                            <div class="posts">
                                                <div class="recent-post">
                                                    <?php
                                                    $a="SELECT `item_id`, `item_name`,`item_desc`, `item_image`, date( `item_time`) DT FROM `artigos` WHERE `item_active`=1 and `item_fruit`=$item_fruit order by `item_id` DESC  limit 0,8";
                                                    $items=$connection->query($a);
                                                    while($r=$items->fetch_assoc()){
                                                        $item_id=base64_encode($r['item_id']);
                                                        $item_name=$r['item_name'];
                                                        $item_desc=$r['item_desc'];
                                                        $item_img=$r['item_image'];
                                                        $item_date=$r['DT'];

                                                        ?>
                                                        <div class="recent-post" style="margin-top: 20px">
                                                            <div class="recent-post-thumb">
                                                                <img src="images/<?php echo $item_img; ?>" alt="" width="70" height="70">
                                                            </div>
                                                            <div class="recent-post-info">
                                                                <h6><a href="<?php echo "details.php?item=".$item_id; ?>"><?php echo $item_name; ?></a></h6>
                                                                <span><?php echo $item_date; ?></span>
                                                            </div>
                                                        </div>
                                                    <?php }?>
                                                </div>


                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <?php }
                else{
                ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="heading-section">
                                <h1>Error 404</h1>
                                <h2>O produto que voce esta tentando pode nao estar disponivel</h2>
                                <img src="images/under-heading.png" alt="" />
                            </div>
                        </div>
                    </div>

                    <?php } ?>
    </div>
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="container">
 <div class="fb-comments" data-href="https://www.facebook.com/ferreiraalvesfisioterapiaespecializada/docs/plugins/comments#configurator" data-numposts="5"></div>
</div>
<?php
require("footer.php");
?>