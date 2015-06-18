<div id="challengesphotos-show" class="tile">
	 <span class="go-back-arrow control ion-ios-arrow-thin-left" target="<?php secho($this->generateUrl('challengesphotos')); ?>" target-id="challengesphotos" animation="slideInLeft" ></span>
	<h1><?php secho($challenge['title']); ?></h1>

	<div class="icons-top">
		<?php secho($challenge['points']); ?> Points
	</div>
	
	<?php if (!$challenge['valid']) { ?>
	<div class="text-center">
		<label for="photo-input">
			<span id="photo-button-camera" class="ion-ios-camera-outline" ></span>
		</label>
	</div>
	<form class="ajax-form" action="<?php secho($this->generateUrl('challengesphotos', 'create', [$challenge['id'], $_SESSION['csrf']])); ?>" method="POST" id="photo-add-form" enctype="multipart/form-data" target="<?php secho($this->generateUrl('challengesphotos')); ?>" target-id="challengesphotos">
		<input id="photo-input" type="file" name="photo" accept="image/*;capture=camera" />
	</form>
	<?php } else { ?>
	<?php } ?>
</div>

