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

<div class="modal" id="age-confirm" style="display: none">
	<div class="container">
		<img src="<?=get_stylesheet_directory_uri()?>/img/logo-rw.png">
		<p>Please enter your year of birth</p>
		<input type="number" placeholder="YYYY">
		<label class="checkbox-container">
			Remember Me
			<input type="checkbox">
			<span class="checkmark"></span>
		</label>
		<button>ENTER</button>
		<p class="remember-warning">Do not use 'remember me' option if this is a public terminal or if it's shared with anyone under the legal drinking age in your area.</p>
		<h3>WARNING:</h3>
		<p>
			Under the Liquor Control Reform Act 1998 it is an offence:
			<br />To supply alcohol to a person under the age of 18 years (Penalty exceeds $ 17,000)
			<br />For a person under the age of 18 years to purchase or receive liquor. (Penalty exceeds $ 7,000)
		</p>
	</div>
</div>

<section id="welcome">
	<div class="welcome-message">
		<img src="<?=get_stylesheet_directory_uri()?>/img/logo-rw.png">
		<h1 class="slogan">DELIVERING FROM LOCAL<br>
			PRODUCERS TO YOUR HOME</h1>
		<a href="#shop">SHOP NOW</a>
	</div>
</section>

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
	<div class="container">
		<div id="categories">
			<div class="category">
				<a href="<?=site_url()?>/product-category/chinese-spirits/"><img src="<?=get_stylesheet_directory_uri()?>/img/chinese spirits.png" /></a>
				<a href="<?=site_url()?>/product-category/chinese-spirits/"><h3>Chinese Spirits</h3></a>
			</div>
			<div class="category">
				<a href="<?=site_url()?>/product-category/spirits/"><img src="<?=get_stylesheet_directory_uri()?>/img/spirits.png" /></a>
				<a href="<?=site_url()?>/product-category/spirits/"><h3>Spirits</h3></a>
			</div>
			<div class="category">
				<a href="<?=site_url()?>/product-category/sake/"><img src="<?=get_stylesheet_directory_uri()?>/img/champagne.png" /></a>
				<a href="<?=site_url()?>/product-category/sake/"><h3>Sake</h3></a>
			</div>
			<div class="category">
				<a href="<?=site_url()?>/product-category/wine/"><img src="<?=get_stylesheet_directory_uri()?>/img/wine.png" /></a>
				<a href="<?=site_url()?>/product-category/wine/"><h3>Wine</h3></a>
			</div>
			<div class="category">
				<a href="<?=site_url()?>/product-category/wine-vessel/"><img src="<?=get_stylesheet_directory_uri()?>/img/wine vessel.png" /></a>
				<a href="<?=site_url()?>/product-category/wine-vessel/"><h3>Wine Vessel</h3></a>
			</div>
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
      <img src="<?=get_stylesheet_directory_uri()?>/img/logo-rw.png">
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
        var yob = window.localStorage.getItem("yearOfBirth");

	    function checkYob(yob) {
            if (!yob || (new Date()).getFullYear() - yob < 18) {
                $("#age-confirm").show();
                $('body').css({'overflow-y':'hidden'});
            } else {
                $("#age-confirm").fadeOut(1000);
                $('body').css({'overflow-y':'auto'});
			}
		}

		checkYob(yob);

        $('#age-confirm button').click(function(){
            yob = +$('#age-confirm input[type="number"]').val();
            if (yob && yob <= (new Date()).getFullYear() && yob >= 1900) {
                var rememberYob = $('#age-confirm input[type="checkbox"]').prop("checked");
                if (rememberYob) {
                    window.localStorage.setItem("yearOfBirth", yob);
				}
                checkYob(yob);
			} else {
                alert('Invalid Year of Birth');
			}
		});

		$('#welcome img').click(function () {
		    window.localStorage.clear();
		});

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
