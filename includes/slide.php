<section class="index-slide wow fadeInUp">
	<ul class="rslides" id="dowebok">
		<li>
			<a href="<?php echo wpztw_option('slide_one_link'); ?>" target="_blank"><img src="<?php echo wpztw_option('slide_one_img'); ?>"></a>
			<p class="rslides_word"><span><?php echo wpztw_option('slide_one_title'); ?></span></p>
		</li>
		<?php
		if (wpztw_option('slide_two_img')) {?>
			<li>
			<a href="<?php echo wpztw_option('slide_two_link'); ?>" target="_blank"><img src="<?php echo wpztw_option('slide_two_img'); ?>"></a>
			<p class="rslides_word"><span><?php echo wpztw_option('slide_two_title'); ?></span></p>
			</li>
		<?php }?>
		<?php
		if(wpztw_option('slide_three_img')){?>
			<li>
			<a href="<?php echo wpztw_option('slide_three_link'); ?>" target="_blank"><img src="<?php echo wpztw_option('slide_three_img'); ?>"></a>
			<p class="rslides_word"><span><?php echo wpztw_option('slide_three_title'); ?></span></p>
			</li>
		<?php } ?>
		<?php
		if(wpztw_option('slide_four_img')){?>
			<li>
			<a href="<?php echo wpztw_option('slide_four_link'); ?>" target="_blank"><img src="<?php echo wpztw_option('slide_four_img'); ?>"></a>
			<p class="rslides_word"><span><?php echo wpztw_option('slide_four_title'); ?></span></p>
			</li>
		<?php } ?>
		<?php
		if(wpztw_option('slide_five_img')){?>
			<li>
			<a href="<?php echo wpztw_option('slide_five_link'); ?>" target="_blank"><img src="<?php echo wpztw_option('slide_five_img'); ?>"></a>
			<p class="rslides_word"><span><?php echo wpztw_option('slide_five_title'); ?></span></p>
			</li>
		<?php } ?>
	</ul>
</section>