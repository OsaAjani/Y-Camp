<?php
/**
 * page challenges
 */
class challenges extends Controller
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
	 * Cette fonction permet d'afficher la page généraliste des challenges
	 */
	public function byDefault ()
	{
		global $db;

		$_SESSION['lastIntersection'] = 'challenge';

		return $this->render("challenges");
	}
}

