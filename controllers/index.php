<?php
/**
 * page d'index
 */
class index extends Controller
{
	//Pour ajouter du cache, ajouter un attribut :
	//public $cache_nomMethode = durée_cache_en_minute;

	/**
	 * Page d'index par défaut
	 */	
	public function byDefault ()
	{
		return $this->render("index");
	}

	/**
	 * Page du formulaire d'email
	 */
	public function email ()
	{
		return $this->render('indexEmail');
	}

	/**
	 * Page du formulaire de password
	 */
	public function password ()
	{
		return $this->render('indexPassword');
	}

	/**
	 * Page des questions et infos
	 */
	public function questions ()
	{
		return $this->render('indexQuestions');
	}

	private function oejr()
	{
		global $db;
		$users = $db->getFromTableWhere('users');
		$i = 0;
		foreach ($users as &$user)
		{
			$password = $user['password'];
			secho('Password for ' . $user['firstname'] . ' ' . $user['lastname'] . " : $password\n");
			$user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
			if ($db->updateTableWhere('users', $user, ['id' => $user['id']]))
			{
				secho('Password update for ' . $user['firstname'] . ' ' . $user['lastname'] . " : old = " .$password . " new : " . $user['password'] . "\n");
			}
		}
	}

}
