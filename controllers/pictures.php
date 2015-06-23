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
		
		global $db;
		if (!$validatedChallenges = $db->getFromTableWhere('validated_challenges', ['id' => $validatedChallengeId]))
		{
			$router = new Router();
			$router->return404();
		}

		return $this->render("picturesShow", array(
			'validatedChallenge' => $validatedChallenges[0],
		));
	}

}
