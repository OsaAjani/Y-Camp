<div id="teams-pictures" class="tile">
	<?php  if($teamShowPage) { ?>
		<span class="go-back-arrow control ion-ios-arrow-thin-left" target="<?php secho($this->generateUrl('teams', 'show', [$teamId])); ?>" target-id="teams-show" animation="slideInLeft" ></span>
	<?php }else{ ?>
		<span class="go-back-arrow control ion-ios-arrow-thin-left" target="<?php secho($this->generateUrl('teams')); ?>" target-id="teams" animation="slideInLeft" ></span>
	<?php } ?>
</div>