<?php
/**
 * page de teams
 */
class teams extends Controller
{
	/**
	 * Page de teams par défaut
	 */	
	public function byDefault ()
	{
		global $db;

		$teams = $db->getFromTableWhere('teams', ['id' => $_SESSION['user']['team_id']]);
		$team = $teams[0];

		$challenges = $db->getFromTableWhere('challenges');
		$validChallenges = $db->getFromTableWhere('validated_challenges', ['team_id' => $_SESSION['user']['team_id']]);

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

		$users = $db->getFromTableWhere('users', ['team_id' => $_SESSION['user']['team_id']]);
		return $this->render("teams", array(
			'team' => $team,
			'users' => $users,
			'points' => $points,
		));
	}


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

	public function show ($teamID)
	{
		global $db;

		$teams = $db->getFromTableWhere('teams', ['id' => $teamID]);
		$team = $teams[0];

		$challenges = $db->getFromTableWhere('challenges');
		$validChallenges = $db->getFromTableWhere('validated_challenges', ['team_id' => $teamID]);

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

		$users = $db->getFromTableWhere('users', ['team_id' => $teamID]);
		
		return $this->render("teamsShow", array(
			'team' => $team,
			'users' => $users,
			'points' => $points,
		));
	}

}
