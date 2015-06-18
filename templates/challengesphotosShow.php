<div id="challengesphotos-show" class="tile">
	 <span class="go-back-arrow control ion-ios-arrow-thin-left" target="<?php secho($this->generateUrl('challengesphotos')); ?>" target-id="challengesphotos" animation="slideInLeft" ></span>
	<h1><?php secho($challenge['title']); ?></h1>

	<div class="icons-top">
		<?php echo $challenge['valid'] && !$forceUpload ? 'Challenge validé' : $challenge['points'] . ' Points'; ?>
	</div>

	<?php $challenge['valid'] && !$forceUpload ? $this->askForEdit($challenge) : $this->askForPhoto($challenge) ;?>
</div>

