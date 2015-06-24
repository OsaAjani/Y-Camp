jQuery('document').ready(function()
{
	if (challenges.length)
	{
	
		var bgImg = jQuery('#first-container').find('#background-images');
		var resolutionCoef = bgImg.width() / bgImg.height();
		var nbImgsByLine = Math.ceil(resolutionCoef);

		var imgsArray = [];
		var i = 0;
		var j = 0;
		var k = 0;
		var length = challenges.length;
		while (i < length)
		{
			//Si on a atteint la limite du nombre d'images par ligne, on repars sur la ligne suivante
			if (j > nbImgsByLine)
			{
				k ++;
				j = 0;
			}

			//On ajoute une nouvelle ligne au tableau si besoin
			if (!imgsArray[k])
			{
				imgsArray[k] = [];
			}

			//On ajoute l'image à la ligne
			imgsArray[k][j] = challenges[i].document;

			i ++;
			j ++;
		}


		var imgsHeight = 100 / imgsArray.length;
		var imgsWidth = 100 / imgsArray[0].length;

		//On rempli le dom
		var i = 0;
		var l = 0;
		length = imgsArray.length;
		while (i < length) //Chaque ligne
		{
			jQuery('#background-images').append('<div class="line-images"></div>');
			jQuery('#overlay-images').append('<div class="line-images"></div>');
			jQuery('#first-container').find('#background-images .line-images').last().css('height', imgsHeight + '%');
			jQuery('#first-container').find('#overlay-images .line-images').last().css('height', imgsHeight + '%');

			var j = 0;
			var length2 = imgsArray[i].length;
			while (j < length2) //Chaque colonne
			{
				//On ajoute une image
				jQuery('#first-container').find('#background-images .line-images').last().append('<div class="images-div"></div>');
				jQuery('#first-container').find('#overlay-images .line-images').last().append('<div class="images-div goto" target="' + HTTP_PWD + 'pictures/show/' + challenges[l].id + '" target-id="pictures-show"><span class="ion-eye"></span></div>');

				//On fixe ses styles
				jQuery('#first-container').find('#background-images .images-div').last().css({
					'background-image': "url('" + HTTP_PWD + "img/challenges/poor_" + imgsArray[i][j] + "')",
					'height': '100%', 
					'width': imgsWidth + '%'
				});
				jQuery('#first-container').find('#overlay-images .images-div').last().css({
					'height': '100%', 
					'width': imgsWidth + '%'
				});
				jQuery('#first-container').find('#overlay-images .images-div').last().css('line-height', jQuery('#first-container').find('#overlay-images .images-div').last().height() + 'px');

				//Si cette lignee contient moins d'image que les autres, on equilibre
				if (imgsArray[i].length < imgsArray[0].length)
				{
					var customImgsWidth = 100 / imgsArray[i].length;
					jQuery('#first-container').find('#background-images .images-div').last().css({
						'width': customImgsWidth + '%'
					});

					jQuery('#first-container').find('#overlay-images .images-div').last().css({
						'width': customImgsWidth + '%'
					});
					
				}

				j ++;
				l ++;
			}

			i ++;
		}
	}
});
