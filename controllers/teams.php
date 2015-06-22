<?php
/**
 * page de teams
 */
class teams extends Controller
{
	/**
	 * Cette fonction retourne la page d'edition d'un groupe
	 */

	public function edit ()
	{
		global $db;

		$teams = $db->getFromTableWhere('teams', ['id' => $_SESSION['user']['team_id']]);
		$team = $teams[0];

		return $this->render("teamsEdit", array(
			'team' => $team,	
		));
	}

	/**
	 * Cette fonction permet de modifier un groupe
	 * @param $csrf : Le jeton CSRF
	 * @param $_POST['name'] : Le nom du groupe à ajouter
	 */
	public function update ($csrf)
	{
		global $db;

		$result = array(
			'success' => 1,
			'error' => '',
		);
		if (!internalTools::verifyCSRF($csrf))
		{
			$result['success'] = 0;
			$result['error'] = 'Jeton CSRF invalide !';
			echo json_encode($result);
			return false;
		}
		if (empty($_POST['name']))
		{
			$result['success'] = 0;
			$result['error'] = 'Remplissez tous les champs.';
			echo json_encode($result);
			return false;
		}
		if (!$db->updateTableWhere('teams', ['name' => $_POST['name']], ['id' => $_SESSION['user']['team_id']]))
		{
			$result['success'] = 0;
			$result['error'] = 'Une erreur inconnue est survenue.';
			echo json_encode($result);
			return false;
		}
		echo json_encode($result);
		return true;
	}	


	/**
	 * Cette fonction permet d'afficher les users de la team
	 * @param $teamId : l'id de la team
	 * @param bool $challengePage : permet de savoir si l'on vient de la page challenge (TRUE) ou de la page ranking (FALSE)
	 */
	public function show ($teamId, $challengePage = FALSE)
	{
		global $db;

		$teams = $db->getFromTableWhere('teams', ['id' => $teamId]);
		$team = $teams[0];

		$challenges = $db->getFromTableWhere('challenges');
		$validChallenges = $db->getFromTableWhere('validated_challenges', ['team_id' => $teamId]);

		$points = 0;
		foreach ($challenges as $challenge)
		{
		
			foreach ($validChallenges as $validChallenge)
			{
				if ($challenge['id'] == $validChallenge['challenge_id'])
				{
					$points += $challenge['points'];
				}
			}
		}

		$users = $db->getFromTableWhere('users', ['team_id' => $teamId]);
		
		return $this->render("teamsShow", array(
			'team' => $team,
			'users' => $users,
			'points' => $points,
			'challengePage' => $challengePage,
		));
	}

	/**
	 * Cette fonction permet d'afficher toutes les photos prise par la team
	 * @param $teamId : l'id de la team
	 * @param bool $teamShowPage : permet de savoir si l'on vient de la page teamsShow ou pas
	 */
	public function pictures ($teamId, $teamShowPage = FALSE)
	{
		global $db;
		$validChallenges = $db->getFromTableWhere('validated_challenges', ['team_id' => $teamId]);
		foreach ($validChallenges as $key => $validChallenge)
		{
			if (!$validChallenge['document']) 
			{
				unset($validChallenges[$key]);
			}
		}


		return $this->render("teamsPictures", array(
			'teamId' => $teamId,
			'teamShowPage' => $teamShowPage,
		));
	}

}
