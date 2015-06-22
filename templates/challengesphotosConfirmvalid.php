<div id="challengesphotos-confirmvalid" class="tile">
	 <span class="go-back-arrow control ion-ios-arrow-thin-left" target="<?php secho($this->generateUrl('challengesphotos', 'show', [$challenge['id']])); ?>" target-id="challengesphotos-show" animation="slideInLeft" ></span>
	<h1><?php secho($challenge['title']); ?></h1>
	
	<form class="ajax-form" action="<?php secho($this->generateUrl('challengesphotos', 'create', [$challenge['id'], $_SESSION['csrf']])); ?>" method="POST" target="<?php secho($this->generateUrl('challengesphotos', 'show', [$challenge['id']])); ?>" target-id="challengesphotos-show">
		<div class="challengesphotos-img-container col-md-6 col-md-offset-3 col-xs-10 col-xs-offset-1" style="background-image: url('<?php secho($photo);?>');">
			<div class="filter"></div>
			<div class="challengesphotos-img-content">
				<div class="challengesphotos-img-text">
					Valider ce challenge ?
				</div>

				<span class="control valid-photo-button ion-ios-close-outline" target="<?php secho($this->generateUrl('challengesphotos', 'show', [$challenge['id']])); ?>" target-id="challengesphotos-show" animation="slideInLeft"></span>
				<span class="control valid-photo-button ion-ios-checkmark-outline" id="valid-photo-confirm" ></span>
			</div>
		</div>
	</form>
</div>

