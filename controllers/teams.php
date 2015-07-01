<?php
/**
 * page de teams
 */
class teams extends Controller
{
	public function before ()
	{
		if (!isset($_SESSION['connected']) || !$_SESSION['connected'])
		{
			header('Location: ' . HTTP_PWD);
			die();
		}
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


	/**
	 * Cette fonction permet d'afficher les users de la team
	 * @param $teamId : l'id de la team
	 */
	public function show ($teamId)
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
		));
	}

	/**
	 * Cette fonction permet d'afficher toutes les photos prise par la team
	 * @param $teamId : l'id de la team
	 */
	public function pictures ($teamId)
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

		$validChallenges = array_values($validChallenges); //On réindex le tableau à 0 !

		if (!$teams = $db->getFromTableWhere('teams', ['id' => $teamId]))
		{
			$router = new Router();
			$router->return404();
		}

		return $this->render("teamsPictures", array(
			'team' => $teams[0],
			'challenges' => json_encode($validChallenges),
		));
	}

	/**
	 * Cette fonction permet d'afficher la page des défis d'une équipe
	 * @param int $teamId : L'id de la team à afficher
	 */
	public function challenges ($teamId)
	{
		global $db;

		$teams = $db->getFromTableWhere('teams', ['id' => $teamId]);
		$team = $teams[0];

		$challengesPhotos = $db->getFromTableWhere('challenges', ['kind' => 1]);
		$challengesObjects = $db->getFromTableWhere('challenges', ['kind' => 0]);
		$validChallenges = $db->getFromTableWhere('validated_challenges', ['team_id' => $teamId]);

		$totalChallenges = count($challengesPhotos) + count($challengesObjects);

		$totalPoints = 0;
		foreach ($challengesPhotos as $key => $challengePhoto)
		{
			$i = 0;
			$found = false;
			foreach ($validChallenges as $key2 => $validChallenge)
			{
				if ($validChallenge['challenge_id'] == $challengePhoto['id'])
				{
					$found = true;
					$totalPoints += $challengePhoto['points'];
				}
				$i++;
			}
			
			if (!$found)
			{
				unset($challengesPhotos[$key]);
			}
		}

		foreach ($challengesObjects as $key => $challengeObject)
		{
			$i = 0;
			$found = false;
			foreach ($validChallenges as $key2 => $validChallenge)
			{
				if ($validChallenge['challenge_id'] == $challengeObject['id'])
				{
					$found = true;
					$totalPoints += $challengeObject['points'];
				}
				$i++;
			}
			
			if (!$found)
			{
				unset($challengesObjects[$key]);
			}
		}

		foreach ($challengesPhotos as &$challengePhoto)
		{
			foreach ($validChallenges as $validChallenge)
			{
				if ($challengePhoto['id'] == $validChallenge['challenge_id'])
				{
					$challengePhoto['validated_id'] = $validChallenge['id'];
				}
			}
		}
		
		return $this->render('teamsChallenges', array(
			'challengesPhotos' => $challengesPhotos,
			'challengesObjects' => $challengesObjects,
			'nbValidChallenges' => count($validChallenges),
			'totalPoints' => $totalPoints,
			'totalChallenges' => $totalChallenges,
			'team' => $team,
		));		
	}
}
