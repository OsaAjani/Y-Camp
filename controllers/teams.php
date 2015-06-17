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

		$users = $db->getFromTableWhere('users', ['team_id' => $_SESSION['user']['team_id']]);
		return $this->render("teams", array(
			'team' => $team,
			'users' => $users,	
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

}
