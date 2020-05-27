<footer>
	<div class="logo">
		<img src="<?=get_stylesheet_directory_uri()?>/img/logo-bwr-1024.png">
	</div>
	<div class="contact">
		<?php $address_post = get_page_by_path('address-phone'); ?>
		<?=wpautop($address_post->post_content)?>
	</div>
	<div class="qr"><?=get_the_post_thumbnail($address_post->ID, 'full')?></div>
</footer>
</body>
</html>