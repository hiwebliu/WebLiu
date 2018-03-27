<?php if (webliu_option('index_paythemes')) { ?>
<div class="new_theme">

		<h1 class=" wow bounceInUp"><?php echo webliu_option('paythemes_title'); ?></h1>
		<div class="new_theme_wrapper ">

			<?php if (webliu_option('paythemes1_link')) { ?>
			<a href="<?php echo webliu_option('paythemes1_link'); ?>" title="<?php echo webliu_option('paythemes1_title'); ?>">
			<article class="excerpt wow bounceInUp" data-wow-duration="2s">
				<section class="theme_title"><?php echo webliu_option('paythemes1_tag'); ?></section>
				<section class="theme_thumbail">
					<img src="<?php echo webliu_option('paythemes1_img'); ?>">
				</section>
				<section class="theme_info">
					<h2><?php echo webliu_option('paythemes1_title'); ?></h2>
					<p><?php echo webliu_option('paythemes1_info'); ?></p>
				</section>
				<section class="theme_meta">
					<span class="price"><?php echo webliu_option('paythemes1_attr1'); ?>：<em><?php echo webliu_option('paythemes1_data1'); ?></em></span>
					<span class="verson"><?php echo webliu_option('paythemes1_attr2'); ?>：<em><?php echo webliu_option('paythemes1_data2'); ?></em></span>
				</section>
			</article>
			</a>
			<?php }?>

      <?php if (webliu_option('paythemes2_link')) { ?>
			<a href="<?php echo webliu_option('paythemes2_link'); ?>" title="<?php echo webliu_option('paythemes2_title'); ?>">
			<article class="excerpt wow bounceInUp" data-wow-duration="2.5s">
				<section class="theme_title"><?php echo webliu_option('paythemes2_tag'); ?></section>
				<section class="theme_thumbail">
					<img src="<?php echo webliu_option('paythemes2_img'); ?>">
				</section>
				<section class="theme_info">
					<h2><?php echo webliu_option('paythemes2_title'); ?></h2>
					<p><?php echo webliu_option('paythemes2_info'); ?></p>
				</section>
				<section class="theme_meta">
					<span class="price"><?php echo webliu_option('paythemes2_attr1'); ?>：<em><?php echo webliu_option('paythemes2_data1'); ?></em></span>
					<span class="verson"><?php echo webliu_option('paythemes2_attr2'); ?>：<em><?php echo webliu_option('paythemes2_data2'); ?></em></span>
				</section>
			</article>
			</a>
			<?php }?>

      <?php if (webliu_option('paythemes3_link')) { ?>
			<a href="<?php echo webliu_option('paythemes3_link'); ?>" title="<?php echo webliu_option('paythemes3_title'); ?>">
			<article class="excerpt wow bounceInUp" data-wow-duration="3s">
				<section class="theme_title"><?php echo webliu_option('paythemes3_tag'); ?></section>
				<section class="theme_thumbail">
					<img src="<?php echo webliu_option('paythemes3_img'); ?>">
				</section>
				<section class="theme_info">
					<h2><?php echo webliu_option('paythemes3_title'); ?></h2>
					<p><?php echo webliu_option('paythemes3_info'); ?></p>
				</section>
				<section class="theme_meta">
					<span class="price"><?php echo webliu_option('paythemes3_attr1'); ?>：<em><?php echo webliu_option('paythemes3_data1'); ?></em></span>
					<span class="verson"><?php echo webliu_option('paythemes3_attr2'); ?>：<em><?php echo webliu_option('paythemes3_data2'); ?></em></span>
				</section>
			</article>
			</a>
			<?php }?>

		</div>
		<div class="clear"></div>
</div>
<?php } ?>
