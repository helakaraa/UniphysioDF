<?php
    if(!isset($_SESSION))
    {
        session_start();
    }
?>
<?php  
    define( 'MAIL_TO', /* >>>>> */'ferreiraalvesfisioterapia@gmail.com'/* <<<<< */ );  //ajouter votre courriel  
    define( 'MAIL_FROM', 'ferreiraalvesfisioterapia@gmail.com' ); // valeur par défaut  
    define( 'MAIL_OBJECT', 'objeto da mensagem' ); // valeur par défaut  
    define( 'MAIL_MESSAGE', 'sua mensagem' ); // valeur par défaut  

    $mailSent = false; // drapeau qui aiguille l'affichage du formulaire OU du récapitulatif  
    $errors = array(); // tableau des erreurs de saisie  
      
    if( filter_has_var( INPUT_POST, 'send' ) ) // le formulaire a été soumis avec le bouton [Envoyer]  
    {  
        $from = filter_input( INPUT_POST, 'from', FILTER_VALIDATE_EMAIL );  
        if( $from === NULL || $from === MAIL_FROM ) // si le courriel fourni est vide OU égale à la valeur par défaut  
        {  
            $errors[] = 'Voce deve inserir seu endereco de e-mail.';  
        }  
        elseif( $from === false ) // si le courriel fourni n'est pas valide  
        {  
            $errors[] = 'O endereco de e-mail nao e valido.';  
            $from = filter_input( INPUT_POST, 'from', FILTER_SANITIZE_EMAIL );  
        }  

        $object = filter_input( INPUT_POST, 'object', FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_HIGH | FILTER_FLAG_ENCODE_LOW );  
        if( $object === NULL OR $object === false OR empty( $object ) OR $object === MAIL_OBJECT ) // si l'objet fourni est vide, invalide ou égale à la valeur par défaut  
        {  
            $errors[] = 'Voce deve preencher o objeto.';  
        }  

 /* pas besoin de nettoyer le message.   
 / [http://www.phpsecure.info/v2/article/MailHeadersInject.php]  
 / Logiquement, les parties message, To: et Subject: pourraient servir aussi à injecter quelque chose,  mais la fonction mail()  
 / filtre bien les deux dernières, et la première est le message, et à partir du moment où on a sauté une ligne dans l'envoi du mail,  
 / c'est considéré comme du texte; le message ne saurait donc rester qu'un message.*/  
        $message = filter_input( INPUT_POST, 'message', FILTER_UNSAFE_RAW );  
        if( $message === NULL OR $message === false OR empty( $message ) OR $message === MAIL_MESSAGE ) // si le message fourni est vide ou égale à la valeur par défaut  
        {  
            $errors[] = 'Voce deve escrever uma mensagem.';  
        }  

        if( count( $errors ) === 0 ) // si il n'y a pas d'erreurs  
        {  
            if( mail( MAIL_TO, $object, $message, "From: $from\nReply-to: $from\n" ) ) // tentative d'envoi du message  
            {  
                $mailSent = true;  
            }  
            else // échec de l'envoi  
            {  
                $errors[] = 'Sua mensagem nao foi enviada.';  
            }  
        }  
    }  
    else // le formulaire est affiché pour la première fois, avec les valeurs par défaut  
    {  
        $from = MAIL_FROM;  
        $object = MAIL_OBJECT;  
        $message = MAIL_MESSAGE;  
    }  
?> 


<?php include("header.php"); 
  include("library.php");?>
	<!--contact-->
	<div class="contact">
		<div class="container">
			<h3>Fale Conosco</h3>

   
       <?php  
    if( $mailSent === true ) // si le message a bien été envoyé, on affiche le récapitulatif  
    {  
?>  
        <p id="success">Sua mensagem foi enviada.</p>  
        <p><strong>E-mail para a resposta:</strong><br /><?php echo( $from ); ?></p>  
        <p><strong>Objeto :</strong><br /><?php echo( $object ); ?></p>  
        <p><strong>Mensagem :</strong><br /><?php echo( nl2br( htmlspecialchars( $message ) ) ); ?></p>  
<?php  
    }  
    else // le formulaire est affiché pour la première fois ou le formulaire a été soumis mais contenait des erreurs  
    {  
        if( count( $errors ) !== 0 )  
        {  
            echo( "\t\t<ul>\n" );  
            foreach( $errors as $error )  
            {  
                echo( "\t\t\t<li>$error</li>\n" );  
            }  
            echo( "\t\t</ul>\n" );  
        }  
        else  
        {  
            echo( "\t\t<p  id=\"welcome\"><em>Todos os campos são obrigatório</em></p>\n" );  
        }  
?>  

			<div class="contact-form">
 

				<form id='contact' method="post" action="<?php echo( $_SERVER['REQUEST_URI'] ); ?>">

				 <p>   
                <label for="from">E-mail para a resposta</label>  
                <input type="text" name="from" id="from" value="<?php echo( $from ); ?>" />  
            </p>  
            <p>  
                <label for="object">Assunto</label>  
                <input type="text" name="object" id="object" value="<?php echo( $object ); ?>" />  
            </p>   
            <p>  
                <label for="message">Mensagem</label>  
                <textarea name="message" id="message" 
                ><?php echo( $message ); ?></textarea>  
            </p>  
            <p>   
             <div class="send">
                <input  type="submit" style="background:red; border:red;" name="reset" value="Reset" >
                
                   <input  type="submit" name="send" value="Salvar">
               
                   </div>
         </p>
           
				</form>
			</div>
		</div>
    </div>

  <?php  
    }  
?> 
	<!--//contact-->
	<!--map-->
 <div class="row">
                <div class="col-md-12">
                    <div class="heading-section">
<center> <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d339.2766722181115!2d-48.01778536351609!3d-15.831488272018252!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x935a321596425293%3A0x63c24da3c67a5bcd!2sPlaza+Mall!5e0!3m2!1sfr!2sbr!4v1516387336804"  width=1100" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>    
    </div>
                </div>
            </div>
            
  <!--//map-->
    <!--footer-->
  <div class="footer">
    <div class="container">
      <div class="footer-grids">   
       <div class="col-md-4 recent-posts">

          <h4>Disponibilidade de atendimento </h4>
          
          <p>A clínica fica aberta de:</p>

          <div class="recent-posts-text">
            <h5>segunda a sexta-feira</h5>
            <p>07:00h às 13:00h </p>
            <p> 13:00h às 19:00 </p>
          </div>
          <div class="recent-posts-text">
            <h5>Sabado<span></span></h5>
            <p>07:00h às 12:00h</p>
          </div>
          
        </div>     
        <div class="col-md-4 recent-posts">
          <h4>Postagens Recentes</h4>
          <?php
          $a="SELECT `item_id`, `item_name`,`item_desc`, `item_image`, date( `item_time`) DT,`item_fruit`,`fruit_name` FROM `artigos`,`fruits` WHERE `fruit_id`=`item_fruit` and `item_active`=1 $url order by `item_id`  LIMIT 0,2";
            $items=$connection->query($a);
            while($r=$items->fetch_assoc()){
            $item_id=base64_encode($r['item_id']);
            $item_name=$r['item_name'];
            $item_desc=$r['item_desc'];
            $item_img=$r['item_image'];
            $item_date=$r['DT'];
            ?>
          <div class="recent-posts-text">
    
            <img src="images/<?php echo $item_img; ?>" alt="" width="70" height="70">
             <p>   </p>

            <h5><a href="<?php echo "details.php?item=".$item_id; ?>"><?php echo $item_name; ?></a></h5>
            <p><span><?php echo $item_date; ?></span></p>
          </div>
             <?php }?>
        </div>
      
        <div class="col-md-4 recent-posts">
          <h4>Our address</h4>
        
          <ul>
            <li><span></span>Rua das Carnaúbas, Quadra 301, Lote 4 , Loja 206 -  Plaza Mall -  Águas Claras, Distrito Federal</li>
            <li><span class="ph-no"></span><a href="tell:+556135782017"> +55 (61) 3578-2017</a></li>
            <li><span class="mail"></span><a href="mailto:ferreiraalvesfisioterapia@gmail.com">ferreiraalvesfisioterapia@gmail.com</a></li>
          </ul>
        </div>
        <div class="clearfix"> </div>
      </div>
    </div>  
  </div>  
	<?php  include("footer.php"); ?>