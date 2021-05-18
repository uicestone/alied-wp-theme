<?php
if ($_POST['user_login']) {
  $user = wp_authenticate($_POST['user_login'], $_POST['user_pass']);

  if(is_a($user, 'WP_Error')){
    exit(array_values($user->errors)[0][0]);
  }

  wp_set_auth_cookie($user->ID, isset($_POST['remember']));
  wp_set_current_user($user->ID);
  header('Location: ' . site_url()); exit;
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<title><?php bloginfo('sitename'); ?></title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<?php wp_head(); ?>
</head>
<body <?php body_class();?>>

<div id="topbar">
	<!--<div id="logo"></div>-->
	<div id="menu-toggle">
		<span>MENU</span>
		<b>
			<i></i>
			<i></i>
			<i></i>
		</b>
	</div>
</div>

<aside id="menu" style="display: none">
  <div class="blur-bg"></div>
	<ul>
		<li>
			<a href="#about">ABOUT US</a>
		</li>
		<li>
			<a href="#shop">SHOP</a>
		</li>
		<li>
			<a href="#contact">CONTACT US</a>
		</li>
		<li>
			<a href="#home">LOGIN</a>
		</li>
	</ul>
</aside>

<div class="modal" id="menu-modal" style="display: none"></div>

<section id="home">
	<div class="modal">
		<div>
			<div id="warning">
        <img src="<?=get_stylesheet_directory_uri()?>/img/logo-rw.png">
				<h3>WARNING:</h3>
				<p>
					Under the Liquor Control Reform Act 1998 it is an offence:
					<br />To supply alcohol to a person under the age of 18 years (Penalty exceeds $ 17,000)
					<br />For a person under the age of 18 years to purchase or receive liquor. (Penalty exceeds $ 7,000)
				</p>
			</div>
      <?php if (is_user_logged_in()): ?>
        <div id="welcome">Welcome, <a href="<?=site_url()?>/my-account/"><?=wp_get_current_user()->display_name?></a></div>
      <?php else: ?>
			<form method="post">
				<input placeholder="User ID" name="user_login" />
				<input placeholder="Password" type="password" name="user_pass" />
				<div class="submit">
					<button type="submit">LOGIN</button>
					<a href="<?=site_url()?>/my-account/">REGISTER</a>
				</div>
			</form>
      <?php endif; ?>
		</div>
	</div>
</section>

<section id="about">
	<h2>about us</h2>
  <div class="container">
    <?=wpautop(get_page_by_path("about")->post_content)?>
  </div>
</section>

<section id="shop">
	<h2>shop</h2>
	<div id="categories">
		<div class="category">
			<a href="<?=site_url()?>/product-category/chinese-spirits/"><img src="<?=get_stylesheet_directory_uri()?>/img/chinese spirits.png" /></a>
			<a href="<?=site_url()?>/product-category/chinese-spirits/"><h3>Chinese Spirits</h3></a>
		</div>
		<div class="category">
			<a href="<?=site_url()?>/product-category/烈酒/"><img src="<?=get_stylesheet_directory_uri()?>/img/spirits.png" /></a>
			<a href="<?=site_url()?>/product-category/烈酒/"><h3>Spirits</h3>
		</div>
		<div class="category">
			<a href="<?=site_url()?>/product-category/champagne/"><img src="<?=get_stylesheet_directory_uri()?>/img/champagne.png" /></a>
			<a href="<?=site_url()?>/product-category/champagne/"><h3>Champagne</h3></a>
		</div>
		<div class="category">
			<a href="<?=site_url()?>/product-category/wine/"><img src="<?=get_stylesheet_directory_uri()?>/img/wine.png" /></a>
			<a href="<?=site_url()?>/product-category/wine/"><h3>Wine</h3></a>
		</div>
		<div class="category">
			<a href="<?=site_url()?>/product-category/wine-vessel/"><img src="<?=get_stylesheet_directory_uri()?>/img/wine vessel.png" /></a>
			<h3><a href="<?=site_url()?>/product-category/wine-vessel/">Wine Vessel</a></h3>
		</div>
	</div>
</section>

<section id="contact">
	<h2>contact us</h2>
  <div class="container">
    <iframe
        loading="lazy"
        allowfullscreen
        src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDPQj8cp29qnlKkF5VWMQTUFSeOglrSKgk&q=25+COOK+ROAD,MITCHAM+VIC+3132+AUS">
    </iframe>
    <div id="contact-info">
      <img src="<?=get_stylesheet_directory_uri()?>/img/logo-bwr.png">
      <div id="company-info">
        <p>Australian Liquor Import Export Distributor Pty Ltd</p>
        <p>BWR Liquer Supplies Pty Ltd</p>
        <p>Address : Unit2, 25 Cook road，Mitcham Vic 3132 Australia</p>
      </div>
    </div>
  </div>
</section>

<script>
	jQuery(function ($) {
	    $('#menu-toggle').click(function () {
	        $('#menu:visible,#menu-modal:visible').fadeOut(700);
	        // $('#home .modal:visible').fadeOut(700);
          $('#menu:hidden,#menu-modal:hidden').fadeIn(700);
		  });

      $('#menu li').click(function () {
          $('#menu:visible,#menu-modal:visible').fadeOut(700);
      });

      $('#menu-modal').click(function () {
          $('#menu:visible,#menu-modal:visible').fadeOut(700);
		  });

      // $('[href="#login"]').click(function () {
      //     $('#home .modal:hidden').fadeIn(700);
      //     $('#menu:visible,#menu-modal:visible').fadeOut(700);
		  // });
	})
</script>

<?php wp_footer(); ?>
</body>
</html>
