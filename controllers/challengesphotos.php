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

		foreach ($challenges as &$challenge)
		{
			$challenge['is_valid'] = false;
		
			foreach ($validChallenges as $validChallenge)
			{
				if ($challenge['id'] == $validChallenge['challenge_id'])
				{
					$challenge['is_valid'] = true;
					$challenge['photo'] = $validChallenge['document'];
				}
			}
		}

		return $this->render("challengesphotos", array(
			'challenges' => $challenges,
			'validChallenges' => $validChallenges,
		));
	}

	/**
	 * Cette fonction permet d'afficher la page d'un défi photo
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

		if ($validChallenges = $db->getFromTableWhere('validated_challenges', ['challenge_id' => $challengeId, 'team_id' => $_SESSION['user']['team_id']]))
		{
			$challenge['valid'] = true;
			$challenge['photo'] = $validChallenges[0]['document'];
		}
		
		return $this->render('challengesphotosShow', array(
			'challenge' => $challenge,
		));
	}

	/**
	 * Cette fonction permet d'enregistrer une nouvelle validation
	 * @param $challengeId : Le numéro du défi
	 * @param $csrf : Le jeton CSRF
	 * @param $_FILES[''] : Le nom du groupe à ajouter
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

		if (empty($_FILES['photo']))
		{
			$result['success'] = 0;
			$result['error'] = 'Veuillez fournir une photo.';
			echo json_encode($result);
			return false;
		}

		if (@$photoName = !internalTools::uploadPhoto($_FILES['photo'], PWD_IMG . 'challenges'))
		{
			$result['success'] = 0;
			$result['error'] = 'Impossible d\'enregistrer la photo.';
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

	/**
	 * Cette fonction retourne la page de validation de suppresion d'un groupe
	 * @param int $groupId : L'id du groupe à supprimer
	 */
	public function delete ($groupId)
	{
		global $db;

		if (!$groups = $db->getFromTableWhere('groups', ['user_id' => $_SESSION['user_id'], 'id' => $groupId]))
		{
			$router = new Router();
			$router->return404();
		}
		
		return $this->render('groupsDelete', array(
			'group' => $groups[0],
		));
	}

	/**
	 * Cette fonction permet de supprimer un groupe
	 * @param int $groupId : L'id du groupe à supprimer
	 * @param string $csrf : Jeton CSRF
	 */
	public function destroy ($groupId, $csrf)
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
	
		if (!$db->deleteFromTableWhere('groups', ['user_id' => $_SESSION['user_id'], 'id' => $groupId]))
		{
			$result['success'] = 0;
			$result['error'] = 'Impossible de supprimer ce groupe.';
			echo json_encode($result);
			return false;
		}

		echo json_encode($result);
		return true;
	}

	/**
	 * Cette fonction retourne la page d'edition d'un groupe
	 * @param int $groupId : L'id du groupe à éditer
	 */
	public function edit ($groupId)
	{
		global $db;

		if (!$groups = $db->getFromTableWhere('groups', ['user_id' => $_SESSION['user_id'], 'id' => $groupId]))
		{
			$router = new Router();
			$router->return404();
		}

		return $this->render('groupsEdit', array(
			'group' => $groups[0]
		));
	}

	/**
	 * Cette fonction permet de modifier un groupe
	 * @param $csrf : Le jeton CSRF
	 * @param $_POST['name'] : Le nom du groupe à ajouter
	 */
	public function update ($groupId, $csrf)
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

		if (!$db->updateTableWhere('groups', ['name' => $_POST['name']], ['id' => $groupId, 'user_id' => $_SESSION['user_id']]))
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

