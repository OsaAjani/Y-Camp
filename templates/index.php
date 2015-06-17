<?php
	$incs = new internalIncs();
	$incs->head('Accueil');
?>
<div id="first-container" class="fluid-container full-page">
	<?php $this->email(); ?>
	<div id="spinner">
		<span class="ion ion-aperture  spinner-size"></span>
	</div>
</div>
<?php
	$incs->footer();
