<?php
/**
 * page de ranking
 */
class ranking extends Controller
{
	/**
	 * Page de ranking par défaut
	 */	
	public function byDefault ()
	{
		global $db;
		$teams = $db->getFromTableWhere('teams');

		$challenges = $db->getFromTableWhere('challenges');
		
		foreach ($teams as &$team) 
		{
			$points = 0;
			$validChallenges = $db->getFromTableWhere('validated_challenges', ['team_id' => $team['id']]);
			foreach ($challenges as $challenge)
			{
				foreach ($validChallenges as $validChallenge)
				{
					if ($challenge['id'] == $validChallenge['challenge_id'])
					{
						$points += $challenge['points'];
					}
				}
			}
			$team['points'] = $points;
			
		}

		foreach ($teams as $value => $key) {
		    $point[$value]  = $key['points'];
		}

		$_SESSION['lastIntersection'] = 'ranking';

		return $this->render("ranking", array(
			'teams' => $teams,
		));
	}

}
