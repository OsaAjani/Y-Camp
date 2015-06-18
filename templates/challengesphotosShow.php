<div id="challengesphotos-show" class="tile">
	 <span class="go-back-arrow control ion-ios-arrow-thin-left" target="<?php secho($this->generateUrl('challengesphotos')); ?>" target-id="challengesphotos" animation="slideInLeft" ></span>
	<h1><?php secho($challenge['title']); ?></h1>

	<div class="icons-top">
		<?php secho($challenge['points']); ?> Points
	</div>
	<?php echo $challenge['valid'] ? 'plop' : 'plip'?>	
	<?php $challenge['valid'] ? $this->askForEdit($challenge) : $this->askForPhoto($challenge) ;?>
</div>

