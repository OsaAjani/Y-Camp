/**
 * Cette fonction permet d'enchainer les changement de classe animate.css
 */
function chainChangeAnimate(selector, changes)
{
	if (changes.length < 2)
	{
		throw new Errors('chainChangeAnimate expect an array of at lest 2 params for parameter "changes" ! ');
	}

	var functionToCall = "";
	var first_time = true;
	for (var i = changes.length ; i > 0 ; i--)
	{
		if (first_time)
		{
			first_time = false
			functionToCall = "changeAnimate(jQuery('" + selector + "'), '" + changes[i - 1] + "')";
		}
		else
		{
			functionToCall = "changeAnimate(jQuery('" + selector + "'), '" + changes[i - 1] + "', function(){" + functionToCall + "})";
		}
	}

	return eval(functionToCall);
}

/**
 * Cette fonction permet de changer la classe animate.css d'un objet selon le système de nommage interne
 */
function changeAnimate(target, newClass, callback)
{
	var classes = target.attr('class');
	classes = classes.split(' ');
	for (var i = 0 ; i < classes.length ; i++)
	{
		if (classes[i].indexOf('animate-css-') != -1)
		{
			target.removeClass(classes[i]);
		}
	}

	target.removeClass('animated');
	target.addClass('animate-css-' + newClass);
	target.addClass('animated');
	target.get(0).addEventListener('animationend', function(){target.removeClass('animate-css-' + newClass)}, true);

	if (callback)
	{
		target.get(0).addEventListener('animationend', callback, true);
	}

	return true;
}

/**
 * Cette fonction permet de gérer le passage d'une tuile à une autre
 */
function changeTile (target, animationIn)
{
	//Si on a pas défini on tire une animation au hasard
	if (!animationIn)
	{
		var defaultAnimations = ['slideInUp', 'slideInDown', 'slideInLeft', 'slideInRight'];
		var animationIn = defaultAnimations[Math.floor(Math.random() * defaultAnimations.length)];
	}

	//On adapte les classes des différentes tuiles
	jQuery('.previous-tile').remove();
	jQuery('.current-tile').addClass('previous-tile').removeClass('current-tile');
	target.addClass('current-tile');

	//On anime l'entrée de la nouvelle tuile
	changeAnimate(target, animationIn);
}

function copyToClipboard(text) {
    window.prompt("Pour copier : Ctrl+C", text);
}

/**
 * Cette fonction contient le système de navigation par target
 */
function targetNavigate(cible)
{
	var targetUrl = cible.attr('target');
	var targetChange = cible.attr('target-id');
	var animation = cible.attr('animation');

	if (!animation)
	{
		animation = 'slideInRight';
	}

	targetNavigateRequesting(targetUrl, targetChange, animation);
}

/**
 * Cette fonction contient la partie requete de targetNavigate
 */
function targetNavigateRequesting (targetUrl, targetChange, animation)
{
	if (!targetUrl || ! targetChange || !animation)
	{
		return false;
	}

	jQuery('#spinner').show();

	jQuery('#' + targetChange).remove();
	jQuery.get(targetUrl, function(data)
	{
		jQuery('#first-container').append(data);
	}).success(function ()
	{
		changeTile(jQuery('#' + targetChange), animation);
	}).done(function ()
	{
		jQuery('#spinner').hide();
	});
}

jQuery(document).ready(function()
{
	if (is_connected)
	{
		jQuery('#spinner').show();
		jQuery.get(HTTP_PWD + 'challenges', function (data)
		{
			//On ajoute la page à l'historique
			window.history.pushState({
				targetUrl: HTTP_PWD + 'challenges',
				targetChange: 'challenges',
				animation: 'slideInLeft',
			}, 'titre', HTTP_PWD + '#' + HTTP_PWD + 'challenges');

			jQuery('#first-container').prepend(data);
			changeTile(jQuery('#challenges'), 'slideInRight');	
		}).done(function ()
		{
			jQuery('#spinner').hide();
		});
	}

	window.onpopstate = function (event) {
		if (event.state != null)
		{
			var state = event.state;
			targetNavigateRequesting(state.targetUrl, state.targetChange, state.animation);
		}
	};


	jQuery('#first-container').on('click', '#copy-password', function(e)
	{
		copyToClipboard(jQuery('#first-container').find('#decrypted-password').text());
	});

	jQuery('#first-container').on('click', '.control, .goto', function(e)
	{
		e.preventDefault();

		var cible = jQuery(this);
		var targetUrl = cible.attr('target');
		var targetChange = cible.attr('target-id');
		var animation = cible.attr('animation');

		if (!animation)
		{
			animation = 'slideInLeft';
		}

		//On ajoute la page à l'historique
		window.history.pushState({
			targetUrl: targetUrl,
			targetChange: targetChange,
			animation: animation
		}, 'titre', HTTP_PWD + '#' + targetUrl);

		targetNavigate(jQuery(this));
	});

	jQuery('#first-container').on('submit', '.ajax-form', function (e)
	{
		e.preventDefault();

		var cible = jQuery(this);
		var form = jQuery(this);
		var formData = new FormData(form[0]);
		jQuery('#spinner').show();
		jQuery.ajax({
			url: form.attr('action'),
			type: form.attr('method'),
			data: formData,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function (data)
			{
				if (data.success)
				{
					var targetUrl = cible.attr('target');
					var targetChange = cible.attr('target-id');
					var animation = cible.attr('animation');

					if (!animation)
					{
						animation = 'slideInLeft';
					}

					//On ajoute la page à l'historique
					window.history.pushState({
						targetUrl: targetUrl,
						targetChange: targetChange,
						animation: animation
					}, 'titre', HTTP_PWD + '#' + targetUrl);

					targetNavigate(form);
				}
				else
				{
					form.prepend('<div class="alert alert-danger alert-dismissible" role="alert">' +
  						'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + data.error + '</div>');
				}

				if (data.redirect)
				{
					window.location = data.redirect;
				}
			}
		}).done(function()
		{
			jQuery('#spinner').hide();
		});
	});

	jQuery('#first-container').on('change', '#photo-input', function (e)
	{
		e.preventDefault();
		jQuery(this).parents('form').submit();
	});

	jQuery('#first-container').on('click', '#valid-photo-confirm', function (e)
	{
		e.preventDefault();
		jQuery(this).parents('form').submit();
	});

	jQuery('#first-container').on('click', '#challengesobjects-valid-button-submit', function (e)
	{
		e.preventDefault();
		jQuery(this).parents('form').submit();
	});

	jQuery('#first-container').on('click', '.linkto', function (e)
	{
		e.preventDefault();
		window.location = jQuery(this).attr('target');
	});
});


