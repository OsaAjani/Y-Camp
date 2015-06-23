<?php
	class internalTools extends Controller
	{
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
			$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_-@()?.:!%*$&/';
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
		 * Cette fonction récupère un repertoire de façon récursive
		 * @param string $path : Le chemin du repertoire
		 * @return mixed array : La liste de tous les fichiers ou en cas d'echec d'ouverture, false
		 */
		public static function getFilesRecursivelyForDirectory($path)
		{
			if (!$files = scandir($path))
			{
				return false;
			}

			//Si il n'est pas présent, on rajoute un / à la fin du chemin
			if (mb_substr($path, -1) != '/')
			{
				$path .= '/';
			}

			$allFiles = array();			

			foreach ($files as $file)
			{
				//On elimine les dossier . et ..
				if ($file != '.' && $file != '..')
				{
					$filePath = $path . $file;
					if (!is_dir($filePath))
					{
						$allFiles[] = $filePath;
					}
					else
					{
						$newFiles = self::getFilesRecursivelyForDirectory($filePath);

						//On gère l'impossibilité de lire un dossier
						if ($newFiles === false)
						{
							return false;
						}

						$allFiles = array_merge($allFiles, $newFiles);
					}
				}
			}

			return $allFiles;
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
		 * Cette fonction permet de redimensionner une image PNG OU JPG par rapport à une hauteur maximale et un ratio de cette hauteur en largeur, le tout sans deformations, avec un crop si necessaires
		 * @param string $image : L'adresse de l'image à redimensionner
		 * @param string $outfile : L'adresse de l'image de sortie
		 * @param int $height : La hauteur à fixer
		 * @param float $ratio : Le ratio à appliquer pour la width
		 * @param int $quality : La qualité de l'image (0-9 pour png et 0-100 pour jpg), par défaut à null, donnera 9 pour png et 100 pour jpeg
		 * @return boolean : true si la transformation a reussi, false sinon
		 */
		public static function resizeImageAndCropForHeightAndRatio($image, $outfile, $height, $ratio, $quality = null)
		{
			$mediaInfo = new finfo(FILEINFO_MIME_TYPE);
	                $mediaMimeType = $mediaInfo->file($image);
			if ($mediaMimeType === false)
			{
				return false;
			}

			//On switch pour fixer la qualité et recuperer l'image
			switch ($mediaMimeType)
			{
				case 'image/jpeg' : 
					$quality = ($quality === null) ? 100 : $quality;
					$src_image = imagecreatefromjpeg($image);
					break;
				case 'image/png' : 
					$quality = ($quality === null) ? 9 : $quality;
					$src_image = imagecreatefrompng($image);
					break;
				default :
					return false;
			}


			$imageSize = getimagesize($image);

			$ratioWidthHeight = $imageSize[0] / $imageSize[1];

			$newWidth = ceil($height * $ratio);

			$dst_x = 0;
			$dst_y = 0;
			$dst_w = $newWidth;
			$dst_h = $height;
			$dst_image = imagecreatetruecolor($newWidth, $height);

			//On assure la transparence des fichiers png
			if ($imageSize['mime'] == 'image/png')
			{
				$black = imagecolorallocate($dst_image, 0, 0, 0);
				imagecolortransparent($dst_image, $black);
			}

			//On choisi le comportement à adopter pour le redimensionnement
			//Si l'image de base est plus en largeur que voulu, on doit redimensionner la hauteur est recentrer en largeur
			if ($ratioWidthHeight > $ratio)
			{
				//On calcul la taille qu'aurait l'image originale si on la scaler sans recouper
				$originalNewWidth = ceil($ratioWidthHeight * $height);
				$widthReste = ceil(($originalNewWidth - $newWidth) / 2);
				$src_x = $widthReste;
				$src_y = 0;
				$src_w = $newWidth;
				$src_h = $height;
				$src_image = imagescale($src_image, $originalNewWidth);
			}
			else //Sinon, si l'image de base est plus en hauteur que voulue, on doit redimensionner la largeur et recentrer en hauteur
			{
				$ratioHeightWidth = $imageSize[1] / $imageSize[0];
				$originalNewHeight = ceil($height * $ratioHeightWidth);
				$heightReste = ceil(($originalNewHeight - $height) / 2);
				$src_x = 0;
				$src_y = 0;
				$src_w = $newWidth;
				$src_h = $height;
				$src_image = imagescale($src_image, $newWidth);
			}

			//On a toutes les infos necessaires, on va faire notre redimension
			if (!imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h))
			{
				return false;
			}

			//On ecrit l'image et on retourne le resultat de l'opération
			switch ($imageSize['mime'])
			{
				case 'image/jpeg' : 
					$result = imagejpeg($dst_image, $outfile, $quality);
					break;
				case 'image/png' : 
					$result = imagepng($dst_image, $outfile, $quality);
					break;
				default :
					return false;
			}

			return $result;
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
		 * Cette fonction permet de formater un text au format partone_secondpart_... pour le passer au format Partone Secondpart ...
		 * @param string $text : Le texte à formater
		 * @param int $mode : Le mode de formatage à employé parmis MB_CASE_UPPER, MB_CASE_LOWER, ou MB_CASE_TITLE (par défaut MB_CASE_TITLE)
		 * @param string $encoding : L'encodage à utiliser pour les opérations multibytes. Par défaut null et vos alors mb_internal_encoding().
		 * @return string : Le texte proprement formaté
		 */
		public static function underscoreCaseProper ($text, $mode = MB_CASE_TITLE, $encoding = null)
		{
			$encoding = is_null($encoding) ? mb_internal_encoding() : $encoding;
			$text = str_replace('_', ' ', $text);
			return mb_convert_case($text, $mode, $encoding);
		}
	}
