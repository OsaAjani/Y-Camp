<?php
/**
 * page de users
 */
class users extends Controller
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
	 * Page de users par défaut
	 * @param int $userId : Le numéro du user
	 */	
	public function show ($userId)
	{
		global $db;
		if (!$users = $db->getFromTableWhere('users', ['id' => $userId]))
		{
			$router = new Router();
			$router->return404();
		}
		$user = $users[0];

		if ($user['birthdate'] != '0000-00-00')
		{
			$birthdate = new DateTime($user['birthdate']);
			$birthdate = $birthdate->format('d/m/Y');
		}
		else
		{
			$birthdate = 'Inconnue';
		}

		return $this->render("usersShow", array(
			'user' => $user,
			'birthdate' => $birthdate,
		));
	}

	/**
	 * Cette fonction permet d'enregistrer une nouvelle photo (pour l'utilisateur lui même)
	 * @param $csrf : Le jeton CSRF
	 */
	public function addphoto ($csrf)
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

		if (!@$photoName = internalTools::uploadPhoto($_FILES['photo'], PWD_IMG . 'users'))
		{
			$result['success'] = 0;
			$result['error'] = 'Impossible d\'enregistrer la photo.';
			echo json_encode($result);
			return false;
		}

		if (!@internalTools::poorPhoto(PWD_IMG . 'users/' . $photoName, PWD_IMG . 'users/' . $photoName, 150))
		{
			$result['success'] = 0;
			$result['error'] = 'Impossible de compresser la photo.';
			echo json_encode($result);
			return false;
		}

		$oldPhoto = $_SESSION['user']['photo'];

		$_SESSION['user']['photo'] = $photoName;
	
		if (!$db->updateTableWhere('users', $_SESSION['user'], ['id' => $_SESSION['user']['id']]))
		{
			$result['success'] = 0;
			$result['error'] = 'Impossible de mettre l\'image à jour.';
			echo json_encode($result);
			return false;
		}

		@unlink(PWD_IMG . 'users/' . $oldPhoto);

		echo json_encode($result);
		return true;
	}

}
