<?php get_header(); ?>

<section id="banner">
	<?php $banner_posts = get_posts(['tag' => 'home-banner']); ?>
	<?php if (!$banner_posts): ?>头图缺失<?php endif; ?>
	<div id="banner-swiper" class="swiper-container">
		<div class="swiper-wrapper">
		<?php foreach ($banner_posts as $banner_post): ?>
		<div class="swiper-slide">
			<?=get_the_post_thumbnail($banner_post->ID, 'full')?>
			<img class="mobile-img" src="<?=get_field('mobile_poster', $banner_post->ID)?>">
		</div>
		<?php endforeach; ?>
		</div>
		<div class="swiper-pagination"></div>
		<!-- If we need navigation buttons -->
		<div class="swiper-button-prev"></div>
		<div class="swiper-button-next"></div>
	</div>
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
	<?php $estates = get_posts(['category_name' => 'estates', 'posts_per_page' => -1, 'order' => 'asc']);?>
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
			<div class="modal-wrapper">
				<div class="estate-detail">
					<div class="banner" style="background-image: url('<?=get_the_post_thumbnail_url($estate->ID,'full')?>')">
						<h3 class="title"><?=get_the_title($estate->ID)?></h3>
					</div>
					<div class="content">
						<h4><?=get_the_subtitle($estate->ID)?></h4>
						<?=wpautop($estate->post_content)?>
					</div>
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
		<small class="section-subtitle">———— BWR商城 ————</small>
	</h1>
	<ul>
		<?php foreach (get_posts(['post_type' => 'product', 'product_tag' => 'home-product', 'posts_per_page' => -1]) as $product): ?>
		<li>
			<a href="<?=get_term_link(get_the_terms($product->ID, 'product_cat')[0],'product_cat')?>">
				<div class="product-image"><?=get_the_post_thumbnail($product->ID)?></div>
				<div class="product-name">
					<h2><?=get_the_terms($product->ID, 'product_cat')[0]->name?></h2>
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
	<?php $news_list = get_posts(['category_name' => 'news', 'posts_per_page' => -1]); ?>
	<div id="news-swiper" class="swiper-container">
		<div class="swiper-wrapper">
			<ul class="swiper-slide">
			<?php foreach ($news_list as $index => $news): ?>
			<?php if ($index && $index % 4 === 0): ?>
			</ul>
			<ul class="swiper-slide">
			<?php endif; ?>
			<li class="open-modal" data-id="<?=$news->ID?>">
				<div class="news-poster"><?=get_the_post_thumbnail($news->ID)?></div>
				<div class="news-caption">
					<div class="news-date"><?=get_the_date('',$news->ID)?></div>
					<h2 class="news-title"><?=get_the_title($news->ID)?></h2>
					<div class="news-excerpt"><?=get_the_excerpt($news->ID)?></div>
				</div>
			</li>
			<?php endforeach; ?>
			</ul>
		</div>
	</div>
	<div class="swiper-button-next"></div>
	<div class="swiper-button-prev"></div>
	<?php foreach ($news_list as $news): ?>
		<div id="modal-<?=$news->ID?>" class="modal">
			<div class="news-detail">
				<?=get_the_post_thumbnail($news->ID, 'full')?>
				<div class="content">
					<h4 class="date"><?=get_the_date('',$news->ID)?></h4>
					<h3 class="title"><?=get_the_title($news->ID)?></h3>
					<?=wpautop(do_shortcode($news->post_content))?>
				</div>
				<button class="close"></button>
			</div>
		</div>
	<?php endforeach; ?>
</section>

<section id="contact">
	<h1 class="section-title">
		CONTACT US
		<small class="section-subtitle">———— 联系我们 ————</small>
	</h1>
	<div>
		<img src="<?=get_stylesheet_directory_uri()?>/img/25-cook-rd.png" style="width:100%">
		<?=do_shortcode('[contact-form-7 id="1930" title="联系我们 Contact"]')?>
	</div>
</section>

<script type="text/javascript">
    var swiper = new Swiper('#news-swiper', {
        navigation: {
            nextEl: '#news-swiper ~ .swiper-button-next',
            prevEl: '#news-swiper ~ .swiper-button-prev'
        }
    });
    var bannerSwiper = new Swiper('#banner-swiper', {
        navigation: {
            nextEl: '#banner-swiper .swiper-button-next',
            prevEl: '#banner-swiper .swiper-button-prev'
        },
        pagination: {
            el: '#banner-swiper .swiper-pagination',
            type: 'bullets'
        },
		loop: true
    });
    setInterval(function() {
        bannerSwiper.slideNext();
	},5000)
</script>

<?php get_footer(); ?>
