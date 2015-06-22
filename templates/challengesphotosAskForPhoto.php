<div class="text-center">
	<label for="photo-input">
		<span id="photo-button-camera" class="ion-ios-camera-outline" ></span>
	</label>
</div>
<form class="ajax-form" action="<?php secho($this->generateUrl('challengesphotos', 'valid', [$challenge['id'], $_SESSION['csrf']])); ?>" method="POST" id="photo-add-form" enctype="multipart/form-data" target="<?php secho($this->generateUrl('challengesphotos', 'confirmvalid', [$challenge['id'], $_SESSION['csrf']])); ?>" target-id="challengesphotos-confirmvalid">
	<input id="photo-input" type="file" name="photo" accept="image/*;capture=camera" />
</form>
