<?php
/**
 * page challengesphotos
 */
class challengesphotos extends Controller
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
	 * Cette fonction permet d'afficher la page par défaut des défis photos
	 */
	public function byDefault ()
	{
		global $db;

		$challenges = $db->getFromTableWhere('challenges', ['kind' => 1]);
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

		return $this->render("challengesphotos", array(
			'challenges' => $challenges,
			'nbValidChallenges' => $nbValidChallenges,
		));
	}

	/**
	 * Cette fonction permet d'afficher la page d'un défi photo
	 * @param int $challengeId : Le numéro du défi
	 * @param boolean $forceUpload : Si il faut forcer l'upload ou nom (par défaut false => pas de forçage)
	 */
	public function show ($challengeId, $forceUpload = false)
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

		return $this->render('challengesphotosShow', array(
			'challenge' => $challenge,
			'forceUpload' => $forceUpload
		));
	}

	/**
	 * Cette fonction permet d'ajouter une photo de façon temporaire pour une validation
	 * @param $challengeId : Le numéro du défi
	 * @param $csrf : Le jeton CSRF
	 * @param $_FILES[''] : Le nom du groupe à ajouter
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

		if (empty($_FILES['photo']))
		{
			$result['success'] = 0;
			$result['error'] = 'Veuillez fournir une photo.';
			echo json_encode($result);
			return false;
		}

		if (!@$photoName = internalTools::uploadPhoto($_FILES['photo'], PWD_IMG . 'tmp_challenges'))
		{
			$result['success'] = 0;
			$result['error'] = 'Impossible d\'enregistrer la photo.';
			echo json_encode($result);
			return false;
		}

		if (!isset($_SESSION['tmp_photos']))
		{
			$_SESSION['tmp_photos'] = array();
		}

		$_SESSION['tmp_photos'][$challengeId] = $photoName;

		echo json_encode($result);
		return true;
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

		if (empty($_SESSION['tmp_photos'][$challengeId]))
		{
			header('Location: ' . HTTP_PWD);
			die();
		}

		if (!$challenges = $db->getFromTableWhere('challenges', ['id' => $challengeId]))
		{
			$router = new Router();
			$router->return404();
		}

		return $this->render('challengesphotosConfirmvalid', array(
			'challenge' => $challenges[0],
			'photo' => HTTP_PWD_IMG . 'tmp_challenges/' . $_SESSION['tmp_photos'][$challengeId],
		));
	}

	/**
	 * Cette fonction permet d'enregistrer une nouvelle validation
	 * @param $challengeId : Le numéro du défi
	 * @param $csrf : Le jeton CSRF
	 */
	public function create ($challengeId, $csrf)
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

		if (empty($_SESSION['tmp_photos'][$challengeId]))
		{
			$result['success'] = 0;
			$result['error'] = 'Il n\'existe pas de photos pour ce challenge';
			echo json_encode($result);
			return false;
		}

		if (!rename(PWD_IMG . 'tmp_challenges/' . $_SESSION['tmp_photos'][$challengeId], PWD_IMG . 'challenges/' . $_SESSION['tmp_photos'][$challengeId]))
		{
			$result['success'] = 0;
			$result['error'] = 'Impossible d\'enregistrer la photo.';
			echo json_encode($result);
			return false;
		}

		//On delete une éventuelle ancienne photo et validation
		if ($validChallenges = $db->getFromTableWhere('validated_challenges', ['team_id' => $_SESSION['user']['team_id'], 'challenge_id' => $challengeId]))
		{
			foreach ($validChallenges as $validChallenge)
			{
				@unlink(PWD_IMG . 'challenges/' . $validChallenge['document']);
				$db->deleteFromTableWhere('validated_challenges', ['id' => $validChallenge['id']]);
			}
		}

		if (!$db->insertIntoTable('validated_challenges', ['team_id' => $_SESSION['user']['team_id'], 'challenge_id' => $challengeId, 'document' => $_SESSION['tmp_photos'][$challengeId]]))
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
	 * Cette fonction retourne la page permettant d'uploader la photo d'un défi photo
	 * @param $challenge : Un ligne de bdd de la table challenge
	 */
	protected function askForPhoto($challenge)
	{
		$this->render('challengesphotosAskForPhoto', array(
			'challenge' => $challenge,
		));
	}


	/**
	 * Cette fonction retourne la page permettant de modifier la photo d'un défi photo
	 * @param $challenge : Une ligne de bdd de la table challenge
	 */
	protected function askForEdit($challenge)
	{
		$this->render('challengesphotosAskForEdit', array(
			'challenge' => $challenge,
		));
	}
}

