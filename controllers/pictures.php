<?php
/**
 * page de pictures
 */
class pictures extends Controller
{
	/**
	 * Page de pictures par défaut
	 * @param $tpictureName : nom de l'iamge choisis par le user
	 * @param $teamId : l'id de la team
	 */	
	public function show ($pictureName, $teamId)
	{
		return $this->render("picturesShow", array(
			'teamId' => $teamId,
			'pictureName' => $pictureName,
		));
	}

}