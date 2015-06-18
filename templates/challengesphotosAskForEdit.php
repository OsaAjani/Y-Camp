<div class="challengesphotos-img-container img-edit-container col-md-6 col-md-offset-3 col-xs-10 col-xs-offset-1" style="background-image: url('<?php secho($challenge['photo']);?>');">
	<div class="filter"></div>
	<div class="challengesphotos-img-content">
		<div class="challengesphotos-img-text">
			Modifier cette image ?
		</div>

		<span class="control valid-photo-button ion-ios-gear-outline" target="<?php secho($this->generateUrl('challengesphotos', 'show', [$challenge['id'], 1])); ?>" target-id="challengesphotos-show"></span>
	</div>
</div>
