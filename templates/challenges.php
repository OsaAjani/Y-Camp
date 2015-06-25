<div id="challenges" class="tile">
	<a class="go-back-arrow ion-ios-close-outline hover-color" href="<?php secho($this->generateUrl('connexion', 'logout')); ?>"></a>
	<h1>Choisissez un type de challenge</h1>

	<div class="icons-top">
		<span class="control ion-ios-flag-outline" id="icon-user" target="<?php secho($this->generateUrl('ranking')); ?>" target-id="ranking"></span>
		<span class="control ion-ios-people-outline" id="icon-user" target="<?php secho($this->generateUrl('teams', 'show', [$_SESSION['user']['team_id'], TRUE])); ?>" target-id="teams-show"></span>
	</div>
	
	<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 infos-container">
		<span class="ion-ios-circle-filled infos-container-round" ></span>
		<span class="ion-podium" id="infos-container-podium" ></span>
		<div class="info">
			<span class="control col-xs-12" target="<?php secho($this->generateUrl('challengesobjects')); ?>" target-id="challengesobjects">Défi Objet</span>
		</div>
		<div class="clearfix"></div>
		<div class="info">
			<span class="control col-xs-12" target="<?php secho($this->generateUrl('challengesphotos')); ?>" target-id="challengesphotos">Défi Photos</span>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="infos-container-dotted-end col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3">
		<span class="ion-ios-arrow-thin-down infos-container-arrow-end" ></span>
	</div>
</div>
<script>
is_connected = 1;
</script>
