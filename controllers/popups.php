<?php
/**
 * page des popups
 */
class popups extends Controller
{
	/**
	 * Page récupérant les popup à afficher
	 */	
	public function check ()
	{
		global $db;

		$result = array(
			'messages' => [],
		);

		if (!isset($_SESSION['connected']) || !$_SESSION['connected'])
		{
			echo json_encode($result);
			return false;
		}

		$popups = $db->getPopupsForUser($_SESSION['user']['id']);

		foreach ($popups as $popup)
		{
			$result['messages'][] = htmlspecialchars($popup['message']);
			$db->insertIntoTable('displayed_popups', ['popup_id' => $popup['id'], 'user_id' => $_SESSION['user']['id']]);
		}

		echo json_encode($result);
	}
}
