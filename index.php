<?php get_header(); ?>

<!-- Show Me -->
<div class="full_screen visual" style="background:url(<?php echo webliu_option('visualbg'); ?>;)">
	<section class="visual_content">
		<div class="showme_content wow bounceInUp">
			<img class="trans_around1" src="<?php echo get_template_directory_uri() ?>/img/trbg1.png" />
			<img class="trans_around2" src="<?php echo get_template_directory_uri() ?>/img/trbg1.png" />
			<img class="showme_timg" src="<?php echo webliu_option('social_img'); ?>;" title="风骚人物-前端刘" alt="风骚人物-前端刘" />
		</div>
	</section>

	<section class="showme_slogan">
		<div class="showme_sloganT wow bounceInLeft" data-wow-duration="3s">
			<h3><?php echo webliu_option('zbword1'); ?></h3>
		</div>
		<div class="showme_sloganT wow bounceInRight" data-wow-duration="4s">
			<h3><?php echo webliu_option('zbword2'); ?></h3>
		</div>
		<div class="showme_sloganName wow bounceInUp" data-wow-duration="5s">
			<?php echo webliu_option('zbword3'); ?>
		</div>
	</section>
</div>

<!-- The New Theme -->
<?php include 'includes/newthemes.php' ?>


<!-- The Target -->
<div class="target">
	<div class="container">
		<h1 class="wow bounceInUp">网站制作 / Wordpress主题定制</h1>
		<p class="wow bounceInLeft">我们不做收费主题，因为我们始终贯彻<em>开源、免费、共享</em>的原则。</p>
		<p class="wow bounceInLeft">我们提供主题定制，给您一份只属于您自己的设计。</p>
		<section class="target_one wow bounceIn" data-wow-duration="2s">
			<i class="fa fa-pencil-square-o"></i>
			<h2>Ui设计</h2>
			<p>我们有多名优秀、具有成熟经验的设计师，可为您打造专属Ui设计。</p>
			<p class="target_price">998 + 元/套</p>
			<ul>
				<li>明确您的设计需求(Logo / 页面设计)</li>
				<li>提供多种设计方案</li>

			</ul>
			<button class="btn btn-danger">了解详情</button>
		</section>
		<section class="target_one wow bounceIn"  data-wow-duration="2.5">
			<i class="fa fa-wordpress"></i>
			<h2>主题定制</h2>
			<p>我们有多名优秀、具有成熟经验的设计师，可为您打造专属Ui设计。</p>
			<p class="target_price">3288 + 元/套</p>
			<ul>
				<li>明确您的设计需求(Logo / 页面设计)</li>
				<li>提供多种设计方案</li>
				<li>超长售后期限：1年</li>
			</ul>
			<button class="btn btn-danger">了解详情</button>
		</section>
		<section class="target_one wow bounceIn" data-wow-duration="3s">
			<i class="fa fa-internet-explorer"></i>
			<h2>仿站需求</h2>
			<p>我们有多名优秀、具有成熟经验的设计师，可为您打造专属Ui设计。</p>
			<p class="target_price">2288 元/套</p>
			<ul>
				<li>明确您的设计需求(Logo / 页面设计)</li>
				<li>提供多种设计方案</li>
				<li>超长售后期限：1年</li>
			</ul>
			<button class="btn btn-danger">了解详情</button>
		</section>
	</div>
</div>



<!-- The Course -->
<div class="course_wrap">
		<section class="course_box wow bounceInLeft">
			<h3 class="course_title">wordpress功能折腾</h3>
			<div class="course_content">
				<header class="course_slogan">坚持不下去，就成了从入门到放弃!</header>
				<ul>
					<li>
						<a class="label" href="#">wordpress教程</a>
						<i>•</i>
						<a class="title" href="#">wordpress主题安装时提示缺少style.css样式表</a>
					</li>
					<li>
						<a class="label" href="#">wordpress优化</a>
						<i>•</i>
						<a class="title" href="#">纯代码方法压缩wordpress网页代码</a>
					</li>
					<li>
						<a class="label" href="#">wordpress教程</a>
						<i>•</i>
						<a class="title" href="#">检测当前页面使用的哪个模板文件的方法</a>
					</li>
				</ul>
			</div>
		</section>

		<section class="course_box wow bounceInRight">
			<h3 class="course_title">wordpress主题开发教程</h3>
			<div class="course_content">
				<header class="course_slogan1">想做一套好主题，就得多去折腾下新玩意!</header>
				<ul>
					<li>
						<a class="label" href="#">wordpress教程</a>
						<i>•</i>
						<a class="title" href="#">wordpress主题安装时提示缺少style.css样式表</a>
					</li>
					<li>
						<a class="label" href="#">wordpress优化</a>
						<i>•</i>
						<a class="title" href="#">纯代码方法压缩wordpress网页代码</a>
					</li>
					<li>
						<a class="label" href="#">wordpress教程</a>
						<i>•</i>
						<a class="title" href="#">检测当前页面使用的哪个模板文件的方法</a>
					</li>
				</ul>
			</div>
		</section>
		<section class="clear"></section>
</div>

<!-- MyDream -->
<div class="mydream">
	<div class="container">
		<section class="think_left">
			<h1 class="wow fadeInLeft" data-wow-duration="1s">念念不忘，必有回响，有一口气，点一盏灯。</h1>
			<p class="wow fadeInLeft" data-wow-duration="2s">生活不止眼前的苟且，还有远方的苟活，修身，齐家，平天下，我们平不了天下，但愿我们在编程的路上能够走得足够远。</p>
		</section>
		<section class="think_right wow fadeInUp" data-wow-duration="2s">
			<a href="#">
				<i class="fa fa-qq"></i>
				QQ在线咨询
			</a>
			<p>上班、看孩，不能及时回复请留言。</p>
		</section>
	</div>
</div>

<?php get_footer(); ?>
