<div id="teams-show" class="tile">
	<?php 	if (isset($_SESSION['lastIntersection']) && $_SESSION['lastIntersection'] == 'challenge') { ?>
		<span class="go-back-arrow control ion-ios-arrow-thin-left" target="<?php secho($this->generateUrl('challenges')); ?>" target-id="challenges" animation="slideInLeft" ></span>	
	<?php } else { ?>
		<span class="go-back-arrow control ion-ios-arrow-thin-left" target="<?php secho($this->generateUrl('ranking')); ?>" target-id="ranking" animation="slideInLeft" ></span>
	<?php } ?>
	<h1><?php secho($team['name']); ?> - <?php secho($points); ?> points</h1>

	<div class="icons-top"> 
		<?php if($team['id'] == $_SESSION['user']['team_id']) { ?>
			<span class="control ion-ios-gear-outline" target="<?php secho($this->generateUrl('teams', 'edit')); ?>" target-id="teams-edit"></span>
		<?php }?>
			<span class="control ion-images" target="<?php secho($this->generateUrl('teams', 'pictures', [$team['id']])); ?>" target-id="teams-pictures"></span>
			<span class="control ion-trophy" target="<?php secho($this->generateUrl('teams', 'challenges', [$team['id']])); ?>" target-id="teams-challenges"></span>
		
	</div>

	<?php if (!count($users)) { ?>
		<div class="no-data">Pas de données</div>
	<?php } else { ?>
		<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 infos-container">
			<span class="ion-ios-circle-filled infos-container-round" ></span>
			<span class="ion-ios-person" id="infos-container-teams-show-user" ></span>
			<?php foreach ($users as $user) { ?>
				<div class="info">
					<span class="control col-xs-12" target="<?php secho($this->generateUrl('users', 'show', [$user['id']])); ?>" target-id="users-show"><?php secho($user['firstname']." ".$user['lastname']); ?></span>
				</div>
				<div class="clearfix"></div>
			<?php } ?>
		</div>
		<div class="infos-container-dotted-end col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3">
			<span class="ion-ios-arrow-thin-down infos-container-arrow-end" ></span>
		</div>
	<?php } ?>
</div>
