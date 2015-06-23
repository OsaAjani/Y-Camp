<?php
/**
 * page de users
 */
class users extends Controller
{
	/**
	 * Page de users par défaut
	 * @param int $usersId : Le numéro du user
	 */	
	public function show ($usersId)
	{
		global $db;
		if (!$users = $db->getFromTableWhere('users', ['id' => $usersId]))
		{
			$router = new Router();
			$router->return404();
		}
		$birthdate = new DateTime($users[0]['birthdate']);
		$birthdate = $birthdate->format('d/m/Y');

		return $this->render("usersShow", array(
			'user' => $users[0],
			'birthdate' => $birthdate,
		));
	}
}
