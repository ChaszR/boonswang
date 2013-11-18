<?php global $mc_option; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php bloginfo('name'); ?>  <?php wp_title(); ?></title>
    
    
	<?php if($mc_option['responsive_design'] == 1): ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php endif; ?>
	
	<!-- WP and RSS Stuff
	================================================== -->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>RSS Feed" href="<?php if($mc_option["feedburner"] !==''){ echo $mc_option["feedburner"]; } else{ bloginfo('rss2_url'); }?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?>Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <?php
    //The scripts and styles are loaded using the wp_enqueue function
    //You can find the function in the includes folder
    if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
    wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>
  
	<div id="wrapper">
		
		<header id="header" class="navbar">
				 <div class="container">
                  <!-- Collapse button mobile-->
		          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		          </a>
					
					<!-- Logo -->
					<h1><a id="logo" class="pull-left" href="<?php echo home_url(); ?>"><?php bloginfo("name"); ?></a></h1>
					
					
					<div id="top-contact">
						<div class="pull-right">
						
							<?php if($mc_option['header_email'] !== ''): ?>
							<p><span class="icon-envelope-alt"></span><a href="mailto:<?php echo antispambot($mc_option['header_email']); ?>"><?php echo antispambot($mc_option['header_email']); ?></a></p>
							<?php endif; ?>
							<?php if($mc_option['header_phone'] !== ''): ?>
							<p><span class="icon-phone"></span><?php echo $mc_option['header_phone']; ?></p>
							<?php endif; ?>
						</div><!-- end pull-right -->
					</div><!-- end top-contact -->
					
				  	
				  	<div class="clear"></div>
				  	
					<!-- Menu -->
					<nav id="menu" class="nav-collapse collapse default-menu">
					<?php 
					if ( has_nav_menu( 'top-menu' ) ) {
					    wp_nav_menu( array( 'theme_location' => 'top-menu', 'container' => false, 'menu_id' => '', 'menu_class' => 'nav', 'fallback_cb' => '', 'walker' =>  new Bootstrap_Walker_Nav_Menu() ) );
					} else { ?>
					    <ul class="nav">
					     <li <?php if (is_home()) { ?>class="current_page_item"<?php } ?>>
									<?php 
										$home = '';
										if(!empty($mc_option["home_link"])){ $home = $mc_option["home_link"]; } else{ $home = 'Home'; }
									?>
									<a href="<?php echo home_url(); ?>"><?php echo $home; ?></a>
							</li>
							<?php
							$pages = wp_list_pages('echo=0&title_li=&sort_column=menu_order,post_date&exclude=' .$exclude);
							$pages = preg_replace('/title=\"(.*?)\"/','',$pages);
							echo $pages;
							?>
					    </ul>
					<?php }?>
					
					</nav><!-- end #menu -->
		          
		          <div class="clear"></div>
		      </div>    
		</header><!-- end #header -->