<section class="smeShare<?php if($this->options['general']['style'] == 'dark') echo ' smeDark'; ?>">
	<?php if($this->options['general']['style'] == 'css'): ?>
		<p>
			<a href="<?php echo $post->socialInfo['google']['shareUrl']; ?>" class="smeBtnGoogle" rel="sme"><i class="smeIconGoogle smeWhite" data-service="google"></i><?php echo $post->socialInfo['google']['count']; ?></a>
			<a href="<?php echo $post->socialInfo['facebook']['shareUrl']; ?>" class="smeBtnFacebook" rel="sme"><i class="smeIconFacebook smeWhite" data-service="facebook"></i><?php echo $post->socialInfo['facebook']['count']; ?></a>
			<a href="<?php echo $post->socialInfo['twitter']['shareUrl']; ?>" class="smeBtnTwitter" rel="sme"><i class="smeIconTwitter smeWhite" data-service="twitter"></i><?php echo $post->socialInfo['twitter']['count']; ?></a>
		</p>
	<?php else: ?>
		<?php if($this->options['general']['services']['google'] == 1): ?>
			<a href="<?php echo $post->socialInfo['google']['shareUrl']; ?>" class="smeClassicBtnGoogle" rel="sme nofollow" data-service="google">
				<b>+1</b>
				<i><span><?php echo $post->socialInfo['google']['count']; ?></span></i>
			</a>
		<?php endif; ?>

		<?php if($this->options['general']['services']['facebook'] == 1): ?>
			<a href="<?php echo $post->socialInfo['facebook']['shareUrl']; ?>" class="smeClassicBtnFacebook" rel="sme nofollow" data-service="facebook">
				<b>Teilen</b>
				<i><span><?php echo $post->socialInfo['facebook']['count']; ?></span></i>
			</a>
		<?php endif; ?>

		<?php if($this->options['general']['services']['twitter'] == 1): ?>
			<a href="<?php echo $post->socialInfo['twitter']['shareUrl']; ?>" class="smeClassicBtnTwitter" rel="sme nofollow" data-service="twitter">
				<b>Twittern</b>
				<i><span><?php echo $post->socialInfo['twitter']['count']; ?></span></i>
			</a>
		<?php endif; ?>
	<?php endif; ?>
</section>