<?php
session_start();
require("header.php");
require("library.php");
$url="";
$page_con="";
echo"<script type='text/javascript'>document.title = 'Ferreira Alves Fisioterapia';</script>";
if (isset($_GET["cat"])) {

    $url=" and `item_fruit`=".base64_decode($_GET["cat"]);
    $page_con="&cat=".$_GET["cat"];
}

?>

   


   	<div class="services">
        <div class="container">
             <h3>BLOG da Ferreira Alves Fisioterapia</h3>
            <div class="row">
                <div class="filters col-md-12 col-xs-12" style="margin-top: 40px">
                    <ul id="filters" class="clearfix">
                        <li><a class="filter" href="blog.php" >| Todas | </a></li>
                    <?php $sql = "SELECT `fruit_id`, `fruit_name` FROM `fruits` ";
                    $result=$connection->query($sql);
                    if($result->num_rows>0){
                        while($row=$result->fetch_assoc())
                        {
                            $id=base64_encode($row["fruit_id"]);
                            $name=$row["fruit_name"];
                            ?>
                       
                        <li><a class="filter" href="<?php echo "blog.php?cat=". $id; ?>"><?php echo $name; ?> | </a></li>
                        <?php } }?>
                    </ul>
                </div>
            </div>
            <div class="row" id="Container">

            <?php
            $num_rec_per_page=12;
            $page=1;

           // echo $caturl;
            if (isset($_GET["page"])) { $page  = $_GET["page"]; }
            $start_from = ($page-1) * $num_rec_per_page;
            $a="SELECT `item_id`, `item_name`,`item_desc`, `item_image`, date( `item_time`) DT,`item_fruit`,`fruit_name` FROM `artigos`,`fruits` WHERE `fruit_id`=`item_fruit` and `item_active`=1 $url order by `item_id`  LIMIT $start_from, $num_rec_per_page";
           // echo $a;
            $items=$connection->query($a);
            while($r=$items->fetch_assoc()){
                $f_id=base64_encode($r['item_fruit']);
                $item_id=base64_encode($r['item_id']);
                $item_name=$r['item_name'];
                $item_desc=$r['item_desc'];
                $item_img=$r['item_image'];
                $f_name=$r['fruit_name'];
               
                $item_date=$r['DT'];

                ?>

                <div class="col-md-3 col-sm-6 mix portfolio-item <?php echo $f_id; ?>">
                    <div class="portfolio-wrapper">
                        <div class="portfolio-thumb">
                            <img src="images/<?php echo $item_img; ?>" alt="<?php echo $item_name; ?>" width="270px" height="250px"/>
                            <div class="hover">
                                <div class="hover-iner">

                                  
                                    <span><?php echo $f_name; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="label-text">
                            <h3><a href="details.php?item=<?php echo $item_id; ?>"><?php echo $item_name; ?></a></h3>
                           
                        </div>
                    </div>
                </div>
            <?php }?>
            </div>
            <div class="pagination">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="pagination pagination-lg">
                            <?php
                           // $a="SELECT * FROM `items` WHERE `item_active`=1";
                            $a="SELECT * FROM `artigos`";
                            $c= $connection->query($a);
                            $total_records=$c->num_rows;
                            $total_pages = ceil($total_records / $num_rec_per_page);
                            //echo $total_pages ;
                            echo "<li><a href='blog.php?page=1$page_con'><i class='fa fa-angle-double-left'></i></a></li>";
                            for ($i=1; $i<=$total_pages; $i++) {
                                echo "<li><a href='blog.php?page=$i$page_con'>$i</a></li>";
                            }
                            $i--;
                            echo "<li><a href='blog.php?page=$i$page_con'><i class='fa fa-angle-double-right'></i></a></li>";

                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
require("footer.php");
?>