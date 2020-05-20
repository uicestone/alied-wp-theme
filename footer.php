<footer>
	<div class="logo">
		<img src="<?=get_stylesheet_directory_uri()?>/img/logo-1024.png">
	</div>
	<div class="contact">
		<?=wpautop(get_page_by_path('address-phone')->post_content)?>
	</div>
	<div class="qr">QR</div>
</footer>
</body>
</html>