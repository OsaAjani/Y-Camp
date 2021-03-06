<?php
	class internalTools extends Controller
	{
		/**
		 * Replace accented characters with non accented
		 *
		 * @param $str
		 * @return mixed
		 * @link http://myshadowself.com/coding/php-function-to-convert-accented-characters-to-their-non-accented-equivalant/
		 */
		public static function removeAccents($str) {
			$a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', 'Ά', 'ά', 'Έ', 'έ', 'Ό', 'ό', 'Ώ', 'ώ', 'Ί', 'ί', 'ϊ', 'ΐ', 'Ύ', 'ύ', 'ϋ', 'ΰ', 'Ή', 'ή');
			$b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', 'Α', 'α', 'Ε', 'ε', 'Ο', 'ο', 'Ω', 'ω', 'Ι', 'ι', 'ι', 'ι', 'Υ', 'υ', 'υ', 'υ', 'Η', 'η');
			return str_replace($a, $b, $str);
		}

		/**
		 * Cette fonction vérifie une date
		 * @param string $date : La date a valider
		 * @param string $format : Le format de la date
		 * @return boolean : Vrai si la date et valide, faux sinon
		 */
		public static function validateDate($date, $format)
		{
			$objectDate = DateTime::createFromFormat($format, $date);
			return ($objectDate && $objectDate->format($format) == $date);
		}

		/**
		 * Cette fonction retourne un mot de passe généré aléatoirement
		 * @param int $length : Taille du mot de passe à générer
		 * @return string : Le mot de passe aléatoire
		 */
		public static function generatePassword($length)
		{
			$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_-@(){}[]?.:!%*|^$&+\\/#~';
			$password = '';
			$chars_length = mb_strlen($chars) - 1;
			$i = 0;
			while ($i < $length)
			{
				$i ++;
				$password .= $chars[rand(0, $chars_length)];
			}
			return $password;	
		}

		/**
		 * Cette fonction permet de cleaner un chemin contre les LFI, RFI, null bytes, etc.
		 * @param string $path : Le chemin à nettoyer
		 * @return string : Le chemin propre
		 */
		public static function sanitizeFileName($path)
		{
			$path = str_replace('..', '', $path);
			$path = str_replace(chr(0), '', $path);
			$path = str_replace('/', '', $path);
			$path = str_replace(':', '', $path);
			return $path;
		}

		/**
		 * Cette fonction retourne une chaine en minuscule en ne gardant que les lettres et chiffres et en les passant en minuscules
		 * @param string $str : La chaine à modifier
		 * @return string : La chaine filtrée
		 */
		public static function sanitizeAndSubstr ($str)
		{
			$str = self::removeAccents($str);
			$str = mb_convert_case($str, MB_CASE_LOWER);
			return preg_replace('#[^a-z0-9]#iu', '', $str);
		}

		/**
		 * Cette fonction vérifie si un mot de passe correspond à des critères de sécurités fixés
		 * @param string $password : Le password à vérifier
		 * @param int $length : La taille du mot de passe
		 * @param boolean $sub : Des lettres minuscules
		 * @param boolean $upper : Des lettres majuscule
		 * @param boolean $int : Des chiffres
		 * @param boolean $specials : Des caractères spéciaux
		 * @param int $need : Nombre minimum de restrictions à respecter (parmi sub, upper, int, specials). Par défaut tous
		 * @return boolean
		 */
		public static function checkPasswordStrength ($password, $length, $sub = true, $upper = true, $int = true, $specials = true, $need = 4)
		{
			$passwordIsValid = true;
			$password = self::removeAccents($password);

			//On gère le cas ou on aurait défini moins de possibilitées que le nombre de possibilitées requises
			$totalPossibleNeed = $sub + $upper + $int + $specials;
			$need = ($need > $totalPossibleNeed) ? $totalPossibleNeed : $need;

			$totalNeed = 0;

			if (mb_strlen($password) < $length)
			{
				return false;
			}

			if ($sub && preg_match('#([a-z]+)#u', $password))
			{
				$totalNeed++;
			}

			if ($upper && preg_match('#([A-Z]+)#u', $password))
			{
				$totalNeed++;
			}

			if ($int && preg_match('#([0-9]+)#u', $password))
			{
				$totalNeed++;
			}

			if ($specials && preg_match('#([^a-zA-Z0-9]+)#u', $password))
			{
				$totalNeed++;
			}

			return ($totalNeed >= $need);
		}

		/**
		 * Cette fonction vérifie si un argument csrf a été fourni et est valide
		 * @param string $csrf : argument optionel, qui est la chaine csrf à vérifier. Si non fournie, la fonction cherchera à utiliser $_GET['csrf'] ou $_POST['csrf'].
		 * @return boolean : True si le csrf est valide. False sinon.
		 */
		public static function verifyCSRF($csrf = '')
		{
			if (!$csrf)
			{
				$csrf = isset($_GET['csrf']) ? $_GET['csrf'] : $csrf;
				$csrf = isset($_POST['csrf']) ? $_POST['csrf'] : $csrf;
			}

			if ($csrf == $_SESSION['csrf'])
			{
				return true;
			}
			
			return false;
		}

		/**
		 * Cette fonction converti un mesure de données vers une autre
		 * @param int $size : La mesure à convertir
		 * @param string $from : L'unité d'origine
		 * @param string $to : L'unité de sortie
		 * @return mixed : Si réussi le résultat de la conversion. Si raté, false
		 */
		public static function convertSize($size, $from, $to)
		{
			//On défini le tableau des unités
			$units = array(
				'o'  => 1,
				'ko' => 2,
				'mo' => 3,
				'go' => 4,
				'to' => 5,
			);

			//Si au moins une des unités fournies n'existe pas
			if (!(array_key_exists($from, $units) && array_key_exists($to, $units)))
			{
				return false;
			}

			//On calcul le nombre de tour à faire
			$i = $units[$from] - $units[$to];
			while ($i != 0)
			{
				if ($i > 0) //Si on doit passer par exemple de ko à o
				{
					$size = $size * 1024;
					$i--;
				}
				else //Si on doit passer par exemple de o a ko
				{
					$size = $size / 1024;
					$i++;
				}
			}
			
			return $size;	
		}

		/**
		 * Cette fonction génère des données de pagination
		 * @param int $nbResults : Nombre de résultat récupérés
		 * @param int $nbByPage : Le nombre de resultats à afficher par page
		 * @param int $page : Le numéro de page courant
		 * @param string $urlFixe : La partie fixe de l'url
		 * @return array : Un tableau de pagination comme voulu par le template pagination
		 */
		public static function generatePagination($nbResults, $nbByPage, $page, $urlFixe)
		{
			$nbPage = ceil($nbResults / $nbByPage);

			$pagination = array('current' => $page);
	
			if ($page > 1)
			{
				$pagination['first'] = $urlFixe;
			}

			if ($page < $nbPage)
			{
				$pagination['last'] = $urlFixe . $nbPage;
			}

			//On crée la pagination des pages avant et après celle en cours
			$pagination['before'] = array();
			$pagination['after'] = array();
			$i = 0;
			while ($i < 3)
			{
				$i ++;
				$pageBeforeNb = $page - $i;
				$pageAfterNb = $page + $i;

				if ($pageBeforeNb >= 1)
				{
					$pagination['before'][] = array(
						'url' => $urlFixe . $pageBeforeNb,
						'nb' => $pageBeforeNb,
					);
				}

				if ($pageAfterNb <= $nbPage)
				{
					$pagination['after'][] = array(
						'url' => $urlFixe . $pageAfterNb,
						'nb' => $pageAfterNb,
					);
				}
			}

			//On remet la pagination before dans le bon ordre pour l'affichage
			$pagination['before'] = array_reverse($pagination['before']);

			return $pagination;
		}

		/**
		 * Cette fonction permet de chiffrer en AES (par défaut)
		 * @param mixed $data : Les données à chiffrer
		 * @param mixed $key : La clef à employée (elle sera transformée et ne correspond pas réellement à la clef employée
		 * @param constant $algo : Le type d'algorythme à utiliser
		 * @param string $mode : Le mode de chiffrement
		 * @return string : Le résultat chiffré en base64
		 */
		public static function aesCrypt($data, $key, $algo = MCRYPT_RIJNDAEL_256, $mode = MCRYPT_MODE_CBC)
		{
			$key = md5($key).sha1($key);
			$key = substr($key, 0, mcrypt_get_key_size($algo, $mode));
			$iv = substr($key, 0, mcrypt_get_block_size($algo, $mode));
			$data = mcrypt_encrypt($algo, $key, $data, $mode, $iv);
			return base64_encode($data);
		}

		/**
		 * Cette fonction permet de dechiffrer en AES (par défaut)
		 * @param mixed $data : Les données à dechiffrer (en base 64)
		 * @param mixed $key : La clef à employée (elle sera transformée et ne correspond pas réellement à la clef employée)
		 * @param constant $algo : Le type d'algorythme à utiliser
		 * @param string $mode : Le mode de chiffrement
		 * @return string : Le résultat chiffré en base64
		 */
		public static function aesDecrypt($data, $key, $algo = MCRYPT_RIJNDAEL_256, $mode = MCRYPT_MODE_CBC)
		{
			$key = md5($key).sha1($key);
			$key = substr($key, 0, mcrypt_get_key_size($algo, $mode));
			$iv = substr($key, 0, mcrypt_get_block_size($algo, $mode));
			$data = base64_decode($data);
			return trim(mcrypt_decrypt($algo, $key, $data, $mode, $iv));
		}

		/**
		 * Cette fonction permet de limiter la taille d'un texte en le complétant avec des ...
		 * @param string $text : Le texte à limiter
		 * @param int $taille : La taille limite (par défaut 255)
		 */
		public static function ellips($text, $taille = 255)
		{
			if (mb_strlen($text) > $taille - 3)
			{
				return mb_substr($text, 0, $taille - 3) . '...';
			}
			return $text;
		}

		/**
		 * Cette fonction permet de limiter l'affichage à un nombre défini de mots et un maximum de caractères
		 * @param string $text : Le texte à limiter
		 * @param int $nbWords : Le nombre de mots maximum à afficher
		 * @param int $taille : La taille limite (par défaut 255)
		 */
		public static function limitWords($text, $nbWords, $taille = 255)
		{
			$arrayText = explode(' ', $text);
			$concatAfter = '';

			if (count($arrayText > 4))
			{
				$concatAfter = '...';
			}

			$text = self::ellips(implode(' ', array_slice($arrayText, 0, 4)), $taille);

			if (mb_strcut($text, mb_strlen($text) - 3) != '...')
			{
				$text = $text . $concatAfter;
			}
			
			return $text;
		}
		
		/**
		 * Cette fonction permet d'uploader une photo
		 * @param string $media : La photo a uploader (sous forme de $_FILES)
		 * @param string $destinationDirectory : Le repertoire de destination
		 * @param string $name : Le nom à employer (par défaut random), sans l'extension
		 * @return mixed : False en cas d'erreur, sinon le nouveau nom de la photo 
		 */
		public static function uploadPhoto($media, $destinationDirectory, $name = '')
		{
			if (!$name)
			{
				$name = sha1(rand(0, 100) . uniqid());
			}

			$name = self::sanitizeFileName($name);

			$mediaInfo = new finfo(FILEINFO_MIME_TYPE);
			$mediaMimeType = $mediaInfo->file($media['tmp_name']);

			//On verifie qu'il s'agit bien d'une image jpg ou png
			if ($mediaMimeType != 'image/jpeg' && $mediaMimeType != 'image/png')
			{
				return false;
			}

			switch ($mediaMimeType)
			{
				case 'image/png' :
					$extension = 'png';
					break;
				default :
					$extension = 'jpg';
			}			

			$destinationName = $name . '.' . $extension;
			$destination = $destinationDirectory . '/' . $destinationName;
			if (!move_uploaded_file($media['tmp_name'], $destination))
			{
				return false;
			}

			return $destinationName;
		}

		/**
		 * Cette fonction permet de fabriquer la version poor d'une photo (en la redimensionnant en gardant le ratio)
		 * @param string $path : Le chemin vers le fichier
		 * @param string $outPath : Le chemin vers le fichier de sortie
		 * @param int $newHeight : La nouvelle hauteur à donner à la photo
		 * @param array $quality : La qualité à donné au format ['jpg' => 0-100, 'png' => 0-9] (défault, 100 & 9)
		 */
		public static function poorPhoto ($path, $pathOut, $newHeight, $quality = ['jpg' => 100, 'png' => 9])
		{
			//On va calculer le ratio originale
			$mediaInfo = new finfo(FILEINFO_MIME_TYPE);
			$mediaMimeType = $mediaInfo->file($path);
			if ($mediaMimeType === false)
			{
				return false;
			}
			
			//On adapte en fonction du mediaMimeType
			switch ($mediaMimeType)
			{
				case 'image/jpeg' :
					$image = imagecreatefromjpeg($path);
					$quality = $quality['jpg'];
					break;
				case 'image/png' :
					$image = imagecreatefrompng($path);
					$quality = $quality['png'];
					break;
				default :
					return false;
					break;
			}

			$imageSize = getimagesize($path);
			$newWidth = $imageSize[0] / ($imageSize[1] / $newHeight);

			$imageDestination = imagecreatetruecolor($newWidth, $newHeight);

			//On gère le png
			if ($mediaMimeType == 'image/png')
			{
				$black = imagecolorallocate($imageDestination, 0, 0, 0);
				imagecolortransparent($imageDestination, $black);
			}

			if (!imagecopyresampled($imageDestination, $image, 0, 0, 0, 0, $newWidth, $newHeight, $imageSize[0], $imageSize[1]))
			{
				return false;
			}

			imagedestroy($image);
			
			switch ($mediaMimeType)
			{
				case 'image/jpeg' :
					return imagejpeg($imageDestination, $pathOut, $quality);
					break;
				case 'image/png' :
					return imagepng($imageDestination, $pathOut, $quality);
					break;
				default :
					return false;
					break;
			}
		}

	}
