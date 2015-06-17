<div id="teams-edit" class="tile">
	<span class="go-back-arrow control ion-ios-arrow-thin-left" target="<?php secho($this->generateUrl('teams')); ?>" target-id="teams" animation="slideInLeft" ></span>
	<h1>Modifier la team : <?php secho($team['name']); ?></h1>
	
	<form class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 add-form ajax-form" method="POST" action="<?php secho($this->generateUrl('teams', 'update', [$_SESSION['csrf']])); ?>" target="<?php secho($this->generateUrl('teams')); ?>" target-id="teams">
		<input class="col-xs-12 textual-input" type="text" value="<?php secho($team['name']); ?>" name="name" placeholder="Nom de la team" />
		<div class="clearfix"></div>
		<br/>
		<br/>
		<input class="button" type="submit" value="Modifier" />
	</div>
</div>