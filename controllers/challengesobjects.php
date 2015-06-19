<?php
/**
 * page challengesobjects
 */
class challengesobjects extends Controller
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
	 * Cette fonction permet d'afficher la page par défaut des défis objets
	 */
	public function byDefault ()
	{
		global $db;

		$challenges = $db->getFromTableWhere('challenges', ['kind' => 0]);
		$validChallenges = $db->getFromTableWhere('validated_challenges', ['team_id' => $_SESSION['user']['team_id']]);

		$nbValidChallenges = 0;
		foreach ($challenges as &$challenge)
		{
			$challenge['valid'] = false;
		
			foreach ($validChallenges as $validChallenge)
			{
				if ($challenge['id'] == $validChallenge['challenge_id'])
				{
					$nbValidChallenges ++;
					$challenge['valid'] = true;
					$challenge['photo'] = $validChallenge['document'];
				}
			}
		}

		return $this->render("challengesobjects", array(
			'challenges' => $challenges,
			'nbValidChallenges' => $nbValidChallenges,
		));
	}

	/**
	 * Cette fonction permet d'afficher la page d'un défi objet
	 * @param int $challengeId : Le numéro du défi
	 */
	public function show ($challengeId)
	{
		global $db;

		if (!$challenges = $db->getFromTableWhere('challenges', ['id' => $challengeId]))
		{
			$router = new Router();
			$router->return404();
		}

		$challenge = $challenges[0];
		$challenge['valid'] = false;

		if ($validChallenges = $db->getFromTableWhere('validated_challenges', ['team_id' => $_SESSION['user']['team_id'], 'challenge_id' => $challengeId]))
		{
			$challenge['valid'] = true;
			$challenge['photo'] = HTTP_PWD_IMG . 'challenges/' . $validChallenges[0]['document'];
		}

		return $this->render('challengesobjectsShow', array(
			'challenge' => $challenge,
		));
	}

	/**
	 * Cette fonction retourne la page de confirmation de validation d'un défi
	 * @param $challengeId : Le numéro du défi
	 * @param $csrf : Le jeton CSRF
	 */
	public function confirmvalid ($challengeId, $csrf)
	{
		global $db;
		
		if (!internalTools::verifyCSRF($csrf))
		{
			header('Location: ' . HTTP_PWD);
			die();
		}

		if (!$challenges = $db->getFromTableWhere('challenges', ['id' => $challengeId]))
		{
			$router = new Router();
			$router->return404();
		}

		return $this->render('challengesobjectsConfirmvalid', array(
			'challenge' => $challenges[0],
		));
	}

	/**
	 * Cette fonction permet de valider un challenge objet
	 * @param $challengeId : Le numéro du défi
	 * @param $csrf : Le jeton CSRF
	 */
	public function valid ($challengeId, $csrf)
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

		if (!$db->insertIntoTable('validated_challenges', ['team_id' => $_SESSION['user']['team_id'], 'challenge_id' => $challengeId]))
		{
			$result['success'] = 0;
			$result['error'] = 'Une erreur inconnue est survenue.';
			echo json_encode($result);
			return false;
		}

		echo json_encode($result);
		return true;
	}
}

