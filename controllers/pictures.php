<?php
/**
 * page de pictures
 */
class pictures extends Controller
{
	/**
	 * Page de pictures par défaut
	 * @param int $validatedChallengeId : L'id du challenge validé
	 */	
	public function show ($validatedChallengeId)
	{
		

		return $this->render("picturesShow", array(
		));
	}

}
