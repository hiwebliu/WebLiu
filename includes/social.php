<div class="user_links">
	<?php if (webliu_option('social_qq')) { ?>
		<a class="social_qq" href="http://shang.qq.com/open_webaio.html?sigt=3c7fd2f14dc9bddc84cc20307f11afaf4f001a6b55b74874c977657e6b923a5123d3446848593e70efc9241220f038e7&sigu=e2190ca10bb4ed6ad5ca0480278440d843fdee7cf46f7999ab0fcc6d052ab200e605790eb5362b8e&tuin=<?php echo webliu_option('social_qq'); ?>" target="_blank" data-toggle="tooltip" title="QQ联系我"><i class="fa fa-qq"></i></a>
	<?php } ?>
	<?php if (webliu_option('social_weixin')) { ?>
		<a class="social_weixin" href="javascript:void(0);" target="_blank" data-toggle="tooltip" title="关注我的微信" rel="nofollow"><i class="fa fa-weixin"></i></a>
		<div class="social_weixin_img" style="background:url('<?php echo webliu_option('social_weixin'); ?>') no-repeat;background-size:cover;"></div>
	<?php } ?>
	<?php if (webliu_option('social_github')) { ?>
		<a class="social_github" href="<?php echo webliu_option('social_github'); ?>" target="_blank" data-toggle="tooltip" title="Fork Me" rel="nofollow"><i class="fa fa-github"></i></a>
	<?php } ?>
	<?php if (webliu_option('social_weibo')) { ?>
		<a class="social_weibo" href="<?php echo webliu_option('social_weibo'); ?>" target="_blank" data-toggle="tooltip" title="关注我的微博" rel="nofollow"><i class="fa fa-weibo"></i></a>
	<?php } ?>
	<?php if (webliu_option('social_qqweibo')) { ?>
		<a class="social_qqweibo" href="<?php echo webliu_option('social_qqweibo'); ?>" target="_blank" data-toggle="tooltip" title="关注我的腾讯微博" rel="nofollow"><i class="fa fa-tencent-weibo"></i></a>
	<?php } ?>
	<?php if (webliu_option('social_email')) { ?>
		<a class="social_email" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=<?php echo webliu_option('social_email'); ?>" target="_blank" data-toggle="tooltip" title="给我发邮件" rel="nofollow"><i class="fa fa-envelope-o"></i></a>
	<?php } ?>
</div>
