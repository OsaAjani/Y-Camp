<?php
	/**
	 * Cette classe contient l'ensemble des requetes spécifiques sur la base
	 */
	class DataBase extends Model
	{
		/**
		 * Cette fonction permet de récupérer les popups à afficher pour un utilisateur donné
		 * @param int $userId : L'id de l'utilisateur dont on veux les popups
		 */
		public function getPopupsForUser ($userId)
		{
			//On récupère les popup qui doivent êtres affichées et qui ne l'on pas encore été
			$query = "	SELECT " . $this->getColumnsForTable('popups') . "
					FROM popups
					WHERE NOW() BETWEEN start_at AND end_at
					AND id NOT IN (
						SELECT popup_id
						FROM displayed_popups
						WHERE user_id = :user_id
					)";

			$params = array(
				'user_id' => $userId,
			);

			return $this->runQuery($query, $params);
		}
	}
