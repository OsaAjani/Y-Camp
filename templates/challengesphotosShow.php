<div id="challengesphotos-show" class="tile">
	 <span class="go-back-arrow control ion-ios-arrow-thin-left" target="<?php secho($this->generateUrl('challengesphotos')); ?>" target-id="challengesphotos" animation="slideInLeft" ></span>
	<h1><?php secho($challenge['title']); ?></h1>

	<div class="icons-top">
		<?php secho($challenge['points']); ?> Points
	</div>
	
	<?php if (!$challenge['valid']) { ?>
	<div class="text-center">
		<span id="photo-button-camera" class="ion-ios-camera-outline carre" ></span>
	</div>
	<?php } else { ?>
		<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 infos-container">
			<span class="ion-ios-circle-filled infos-container-round" ></span>
			<span class="ion-ios-camera" id="infos-container-challengesphotos-camera" ></span>
			<?php foreach ($challenges as $challenge) { ?>
				<div class="info">
					<span class="control col-xs-12" target="<?php secho($this->generateUrl('challengesphotos', 'show', [$challenge['id']])); ?>" target-id="challengesphotos-show"><?php secho(internalTools::limitWords($challenge['title'], 5)); ?></span>
				</div>
				<div class="clearfix"></div>
			<?php } ?>
		</div>
		<div class="infos-container-dotted-end col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3">
			<span class="ion-ios-arrow-thin-down infos-container-arrow-end" ></span>
		</div>
	<?php } ?>
</div>

