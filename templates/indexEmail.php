<div id="index-email" class="landing-page tile">
	<h1>Y-Camp</h1>
	<h2>Gérez vos défis et rencontrez vos équipiers</h2>

	<div class="col-xs-12 col-md-6 col-md-offset-3">	
		<form action="<?php secho($this->generateUrl('connexion', 'checkEmail')); ?>" method="POST" id="landing_form_email" class="col-xs-10 col-xs-offset-1 ajax-form" target="<?php secho($this->generateUrl('index', 'password')); ?>" target-id="index-password">
			<div class="input-group">
				<input name="email" id="email" class="form-control input-lg" placeholder="Votre adresse e-mail" type="email">
				<span class="input-group-btn"><button id="button-login-email" class="btn btn-lg btn-primary">OK</button></span>
			</div>
			<span class="no-account control" target="<?php secho($this->generateUrl('index', 'questions')); ?>" target-id="index-questions">Des questions ?</span>
		</form>
	</div>
</div>
