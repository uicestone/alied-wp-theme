<?php get_header(); ?>

<section id="banner">
	<img src="<?=get_stylesheet_directory_uri()?>/img/banner.jpg">
</section>

<section id="about">
	<h1 class="section-title">
		ABOUT US
		<small class="section-subtitle">———— 关于我们 ————</small>
	</h1>
	<div>
		<?=wpautop(get_page_by_path('about')->post_content)?>
	</div>
</section>

<hr>

<section id="estates">
	<h1 class="section-title">
		RED WINE
		<small class="section-subtitle">———— 精品酒庄 ————</small>
	</h1>
	<div>
	<?php $estates = get_posts(['category_name' => 'estates', 'limit' => -1, 'order' => 'asc']);?>
	<?php foreach ($estates as $estate): ?>
		<dl class="open-modal" data-id="<?=$estate->ID?>">
			<dt><?=get_the_post_thumbnail($estate->ID)?></dt>
			<dd>
				<h2><?=get_the_title($estate->ID)?></h2>
				<h3><?=get_the_subtitle($estate->ID)?></h3>
			</dd>
		</dl>
	<?php endforeach; ?>
	<?php foreach ($estates as $estate): ?>
		<div id="modal-<?=$estate->ID?>" class="modal">
			<div class="estate-detail">
				<div class="banner" style="background-image: url('<?=get_the_post_thumbnail_url($estate->ID,'full')?>')">
					<h3 class="title"><?=get_the_title($estate->ID)?></h3>
				</div>
				<div class="content">
					<h4><?=get_the_subtitle($estate->ID)?></h4>
					<?=wpautop($estate->post_content)?>
				</div>
				<button class="close"></button>
			</div>
		</div>
	<?php endforeach; ?>
	</div>
</section>

<hr>

<section id="shop">
	<h1 class="section-title">
		SHOP
		<small class="section-subtitle">———— 美酒商城 ————</small>
	</h1>
	<ul>
		<?php foreach (get_posts(['post_type' => 'product', 'limit' => -1]) as $product): ?>
		<li>
			<a href="<?=get_the_permalink($product->ID)?>">
				<div class="product-image"><?=get_the_post_thumbnail($product->ID)?></div>
				<div class="product-name">
					<h2><?=get_the_title($product->ID)?></h2>
				</div>
			</a>
		</li>
		<?php endforeach; ?>
	</ul>
	<div class="actions">
		<a class="more" href="<?=site_url('shop')?>">MORE</a>
	</div>
</section>

<hr>

<section id="news">
	<h1 class="section-title">
		NEWS
		<small class="section-subtitle">———— 新闻资讯 ————</small>
	</h1>
	<ul>
		<?php foreach (get_posts(['category_name' => 'news', 'limit' => 4]) as $news): ?>
		<li>
			<div class="news-poster"><?=get_the_post_thumbnail($news->ID)?></div>
			<div class="news-caption">
				<div class="news-date"><?=get_the_date('',$news->ID)?></div>
				<h2 class="news-title"><?=get_the_title($news->ID)?></h2>
				<div class="news-excerpt"><?=get_the_excerpt($news->ID)?></div>
			</div>
		</li>
		<?php endforeach; ?>
	</ul>
</section>

<section id="contact">
	<h1 class="section-title">
		CONTACT US
		<small class="section-subtitle">———— 联系我们 ————</small>
	</h1>
	<div>
		<img src="<?=get_stylesheet_directory_uri()?>/img/map.png" style="width:100%">
	</div>
</section>
<?php get_footer(); ?>
