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
		$birthday = date('d/m/Y', $users[0]['birthday']);


		return $this->render("users", array(
			'user' => $users[0],
			'birthday' => $birthday,
		));
	}
}
