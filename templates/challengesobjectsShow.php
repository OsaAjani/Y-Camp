<div class="tile" id="challengesobjects-show">
	 <span class="go-back-arrow control ion-ios-arrow-thin-left" target="<?php secho($this->generateUrl('challengesobjects')); ?>" target-id="challengesobjects" animation="slideInLeft" ></span>

	<h1><?php secho($challenge['title']); ?></h1>

	<div class="icons-top">
		<?php echo $challenge['valid'] ? 'Challenge validé' : $challenge['points'] . ' Points'; ?>
	</div>

	<?php if ($challenge['valid']) { ?>
		<div class="text-center">
			<span class="ion-ios-checkmark-empty challengesobjects-check challengesobjects-check-valid"></span>
		</div>
	<?php } else { ?>
		<div class="text-center">
			<span class="control ion-ios-checkmark-outline challengesobjects-check" target="<?php secho($this->generateUrl('challengesobjects', 'confirmValid', [$challenge['id'], $_SESSION['csrf']])); ?>" target-id="challengesobjects-confirmvalid"></span>
		</div>
	<?php } ?>
</div>
