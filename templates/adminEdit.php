<?php
	$incs = new internalIncs();
	$incs->head('Modification ligne', 'admin-area');
?>
<?php 
	$incs->headerAdmin($table);
?>
	<div class="section">
		<div class="container">
			<div class="row">
				<?php
				if ($success !== null)
				{
					if (!$success)
					{
					?>
						<div class="alert alert-danger" role="alert">
							<span class="fa fa-exclamation-triangle" aria-hidden="true"></span>
							<span class="sr-only">Échec : </span>
							Impossible de modifier la ligne !
						</div>
					<?php
					}
					else
					{
					?>
						<div class="alert alert-success" role="alert">
							<span class="fa fa-check-circle" aria-hidden="true"></span>
							<span class="sr-only">Succès : </span>
							La ligne a été correctement modifiée !
						</div>
					<?php
					}
				}
				?>
						

				<div class="col-lg-12">
					<h2 class="section-title">Modifier ligne <?php secho($table); ?></h2>
				</div>
				<form role="form" method="POST" action="<?php secho($this->generateUrl('admin', 'modify', array($table, $id, $_SESSION['csrf']))); ?>">
					<div class="row">
					<?php
						foreach ($fields as $nom => $field)
						{
							//On passe les champs avec un autoincrement
							if ($field['AUTO_INCREMENT'])
							{
								continue;
							}

							switch ($field['TYPE'])
							{
								case 'INT' : 
									$type = 'number';
									break;
								default :
									$type = 'text';
							}

							switch ($field['TYPE'])
							{
								case 'DATE' : 
									$pattern = '[0-9]{4}-[0-9]{2}-[0-9]{2}';
									break;
								case 'DATETIME' : 
									$pattern = '[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}';
									break;
								default :
									$pattern = false;
							}

							?>
								<div class="form-group col-md-12">
									<label for="<?php secho($nom); ?>"><?php secho($nom); ?> <?php echo ($pattern ? '(' . $pattern . ')' : ''); ?></label>
									<?php
										if ($field['TYPE'] == 'VARCHAR' && $field['SIZE'] > 255)
										{
										?>
											<textarea name="<?php secho($nom); ?>" class="form-control textarea-admin" id="<?php secho($nom); ?>" <?php echo (!$field['NULL'] && !$field['HAS_DEFAULT'] ? 'required' : ''); ?>><?php secho($ligne[$nom], true); ?></textarea>
										<?php
										}
										else
										{
										?>
											<input type="<?php echo $type; ?>" name="<?php secho($nom); ?>" class="form-control" id="<?php secho($nom); ?>" <?php echo (!$field['NULL'] && !$field['HAS_DEFAULT'] ? 'required' : ''); ?> <?php echo ($pattern ? 'pattern="' . $pattern . '"' : ''); ?> value="<?php secho($ligne[$nom]); ?>" />
										<?php
										}
									?>
								</div>
							<?php
						}
					?>
						<div class="form-group col-lg-12">
							<button type="submit" class="btn btn-primary pull-right col-xs-12">Modifier</button>
							<div class="clearfix"></div>
						</div>
					</div>
				</form>
			</div> <!-- /.row -->
		</div> <!-- /.container -->
	</div> <!-- /.section -->
<?php
	$incs->footer();
