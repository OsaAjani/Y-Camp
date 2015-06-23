<div id="pictures-show" class="tile">
	<span class="go-back-arrow control ion-ios-arrow-thin-left" target="<?php secho($this->generateUrl('teams', 'pictures', [$validatedChallenge['team_id']])); ?>" target-id="teams-pictures" animation="slideInLeft" ></span>
	<div id="pictures-show-picture-container">
		<img id="pictures-show-picture" src="<?php echo HTTP_PWD_IMG . "challenges/". $validatedChallenge['document']; ?>">
	</div>
</div>
<script>
	jQuery('document').ready(function()
	{
		var sizeRatioScreen = jQuery('#first-container').find('#pictures-show').width() / jQuery('#first-container').find('#pictures-show').height();
		var sizeRatioPicture = jQuery('#first-container').find('#pictures-show-picture').width() / jQuery('#first-container').find('#pictures-show-picture').height();

		if (sizeRatioScreen > sizeRatioPicture)
		{
			jQuery('#first-container').find('#pictures-show-picture').addClass('use-full-height');
		}
		else
		{
			jQuery('#first-container').find('#pictures-show-picture').addClass('use-full-width');
		}
	});
</script>
