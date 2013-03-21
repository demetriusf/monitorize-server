<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="pt-br" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="pt-br" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="pt-br" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="pt-br" class="no-js"> <!--<![endif]-->
    <head>
    
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="">
		<meta name="author" content="ASCCODE">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 

        <link rel="stylesheet" href="<?php echo base_url(); ?>css/main.css">
 		<link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico.png">
 		 
 		<!--[if (lt IE 9) & (!IEMobile)]>
 			<script src="<?php echo base_url(); ?>js/selectivizr-min.js"></script>
			<script src="<?php echo base_url(); ?>js/html5shiv.js"></script>
 		<![endif]-->
 
        
    	<title><?php echo  $this -> config -> item('title_site'); ?></title>
    	
    </head>
    <body>
        	
	    <!--[if lt IE 7]>
	        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
	    <![endif]-->
	        
	    <header class="header largura-principal clear-fix">
	     	     
		    <?php if(TRUE){ $tagTitulo = "h2"; }else{ $tagTitulo = "h1"; } ?>
		     	    
			<<?php echo $tagTitulo?> class="logo-topo">	
			
				<?php echo $this->config->item('title_site'); ?>
				<a href="<?php site_url() ?>" title="Vá para a inicial do site" rel="home"></a>
				
			</<?php echo $tagTitulo?>> 	
	     		     	     	
	    </header> 
	     	
	    <section class="clear-fix">
	
	        <div class="largura-principal">
	        
	        		<div class="social social-topo" >
		        		<a class="facebook" title="Clique aqui e torne-se um fã do Asccode no Facebook." href="https://www.facebook.com/olharcriativo" target="_self"></a>
		        		<a class="twitter" title="Siga o perfil do Asccode no Twitter." href="www.twitter.com/blogcriativo" target="_self"></a>
		        		<a class="google" title="Siga o perfil do Asccode no G+." href="https://plus.google.com/107421748385799777175/posts" target="_self"></a>
	        		</div>
	        		
	        		<nav class="nav-principal font-family-principal" >
	        		
	        		</nav>
	
	         </div>
	
	    </section> 
        
	    <footer class="footer font-family-principal clear-fix">
	    
	    	<div class="site-data largura-principal clear-fix">
	    	
		        <div class="social social-rodape" >
			        <a class="facebook" title="Clique aqui e torne-se um fã do Asccode no Facebook." href="https://www.facebook.com/olharcriativo" target="_self"></a>
			        <a class="twitter" title="Siga o perfil do Asccode no Twitter." href="www.twitter.com/blogcriativo" target="_self"></a>
			        <a class="google" title="Siga o perfil do Asccode no G+." href="https://plus.google.com/107421748385799777175/posts" target="_self"></a>
			        <a class="feed" title="Assine o feed do Asccode" href="http://feeds.feedburner.com/olharcriativo/pzpc" target="_self"></a>
		        </div>
	    	
	    	</div>
	    	
	    	<section class="site-builders">
	    		<div class="builders largura-principal clear-fix"></div>
	    	</section>
	    
	    </footer>

        <script src="<?php echo base_url(); ?>js/modernizr-2.6.2-respond-1.1.0.min.js"></script>

	    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	    <script src="<?php echo base_url(); ?>js/main.js"></script>
	    
	    <script>
	        var _gaq=[['_setAccount','UA-39202415-2'],['_trackPageview']];
	        (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
	        g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	        s.parentNode.insertBefore(g,s)}(document,'script'));
	    </script>
	   
	</body>
</html>        
