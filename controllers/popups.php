<?php
/**
 * page des popups
 */
class popups extends Controller
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
	 * Page récupérant les popup à afficher
	 */	
	public function check ()
	{
		global $db;

		$result = array(
			'messages' => [],
		);

		$popups = $db->getPopupsForUser($_SESSION['user']['id']);

		foreach ($popups as $popup)
		{
			$result['messages'][] = htmlspecialchars($popup['message']);
			$db->insertIntoTable('displayed_popups', ['popup_id' => $popup['id'], 'user_id' => $_SESSION['user']['id']]);
		}

		echo json_encode($result);
	}
}
