;(function($)
{
	'use strict';

	var conditions = window.conditions;

	/**
	 * Compare Static class
	 * 
	 * @type Object
	 */
	function checkCompareStatement(needle, haystack, compare)
	{
		if ( needle === null || typeof needle === 'undefined' )
			needle = '';

		switch( compare )
		{
			case '=':
				if ( $.isArray(needle) && $.isArray(haystack) )
					return ( $(needle).not(haystack).length === 0 && $(haystack).not(needle).length === 0 );
				else
					return needle == haystack;

			case '>=':
				return needle >= haystack;

			case '>':
				return needle > haystack;

			case '<=':
				return needle <= haystack;

			case '<':
				return needle < haystack;

			case 'contains':
				if ( $.isArray(needle) )
					return $.inArray( haystack, needle ) > -1;  
				else if ( $.type(needle) == 'string')
					return needle.indexOf( haystack ) > -1;

			case 'in':
				return haystack.indexOf(needle) > -1;

			case 'start_with':
				return needle.indexOf(haystack) === 0;
				
			case 'end_with':
				haystack = new RegExp(haystack + '$');
				return haystack.test(needle);

			case 'match':
				haystack = new RegExp(haystack);
				return haystack.test(needle);

			case 'between':
				if ($.isArray(haystack) && typeof haystack[0] != 'undefined' && typeof haystack[1] != 'undefined')
					return checkCompareStatement(needle, haystack[0], '>=') && checkCompareStatement(needle, haystack[1], '<=');
		}
	}
	
	/**
	 * Put a selector, then retrieve values
	 * 
	 * @param  Element selector Element Selector
	 * 
	 * @return Mixed Selector values
	 */
	function getFieldValue(fieldName, $scope)
	{
		if ($('#' + fieldName).length && $( '#' + fieldName).attr('type') !== 'checkbox' 
			&& typeof $('#' + fieldName).val() != 'undefined' && $('#' + fieldName).val() != null && $scope == '')
			fieldName = '#' + fieldName;

		// If fieldName start with #. Then it's an ID, just return it values
		if (checkCompareStatement( fieldName, '#', 'start_with') && $(fieldName).attr('type') !== 'checkbox' 
			&& typeof $(fieldName).val() != 'undefined' && $(fieldName).val() != null && $scope == '' )
		{
			return $(fieldName).val();	
		}

		var selector = null;

		// Image Advanced. Just return num of image selected
		if ($('[data-field_id="'+fieldName+'"]').length) {
			selector = '[data-field_id="'+fieldName+'"]';

			if ($scope == '')
				return $(selector + '> li').length;
			else
				return $scope.find(selector + '> li').length;
		}

		// If [name={fieldName}] or [name*={fieldName}] exists
		if ($('[name="' + fieldName + '"]').length)
			selector = '[name="' + fieldName + '"]';

		if ($('[name*="' + fieldName + '"]').length)
			selector = '[name*="' + fieldName + '"]';

		if ( null !== selector )
		{
			var selectorType 	= $(selector).attr('type');

			if ( $.inArray( selectorType, ['text', 'file'] ) > -1 ) {
				if ( $scope == '' )
					return $(selector).val();
				else
					return $scope.find(selector).val();
			}

			// If user selected a checkbox or radio. Return array of selected fields,
			// or value of singular field.
			if ( $.inArray( selectorType, ['checkbox', 'radio', 'hidden'] ) > -1 ) {
				var arr 		= [],
					elements 	= [];

				if ( selectorType === 'hidden' && fieldName !== 'post_category' )
					elements = ($scope != '') ? $scope.find(selector) : $(selector);
				else
					elements = ($scope != '') ? $scope.find(selector + ':checked') : $(selector + ':checked');
				
				// Multiple field. Selected multiple items
				if (elements.length > 1 && selectorType != 'radio'){
					elements.each(function()
					{
						arr.push($(this).val());
					});
				}
				// Singular field, selected
				else if ( elements.length === 1 ) {
					arr = elements.val();
				}
				// Singular field, not selected
				else {
					arr = 0;
				}

				return arr;
			}

			if ( $scope == '' )
				return $(selector).val();
			else
				return $scope.find(selector).val();
		}

		return 0;
	}
	
	/**
	 * Check if logics attached to fields is correct or not
	 * 
	 * If a field is hidden by Conditional Logic, then all dependent fields are hidden also
	 * 
	 * @param  Array  logics All logics applied to field
	 * 
	 * @return {Boolean}
	 */
	function isLogicCorrect(logics, $scope)
	{
		var relation 	= ( typeof logics.relation != 'undefined' ) ? logics.relation : 'and',
			success 	= relation == 'and';

		$.each( logics.when, function( index, logic ) 
		{
			var isDependentFieldVisible = $(guessSelector(logic[0])).closest('.rwmb-field').attr('data-visible');
			
			if ( 'hidden' == isDependentFieldVisible ) {
				success = 'hidden';
			} else {
				
				// Check if $scope contains logic[0] selector, if not, unset $scope
				if ( $scope != '' ) {
					var logicSelector = guessSelector(logic[0]);
					if ( ! $scope.find(logicSelector).length )
						$scope = '';
				}

				var item 	= getFieldValue(logic[0], $scope),
				 	compare = logic[1],
				 	value	= logic[2],
				 	check   = false,
				 	negative = false;

				// Cast to string if array has 1 element and its a string
				if ( $.isArray(item) && item.length === 1 )
					item = item[0];

				// Allows user using NOT statement.
				if (checkCompareStatement(compare, 'not', 'contains') || checkCompareStatement(compare, '!', 'contains')) {
					negative = true;
					compare  = compare.replace( 'not', '' ); 
					compare  = compare.replace( '!', '' ); 
				}

				compare = compare.trim();

				if ( $.isNumeric( item ) )
					item = parseInt( item );

				check = checkCompareStatement( item, value, compare );

				if ( negative )
					check =! check;

				success = ( relation === 'and' ) ? success && check : success || check;
			}
		} );

		return success;
	}

	/**
	 * Run all conditional logic statements then show / hide fields or meta boxes
	 * 
	 * @param  Array conditions All defined conditional
	 * 
	 * @return void
	 */
	function runConditionalLogic(conditions)
	{
		// Store all change selector here
		window.eventSource = [];
		
		$.each(conditions, function(field, logics) {	

			$.each(logics, function(action, logic) {
				if (typeof logic.when == 'undefined') return;

				var selector 		= guessSelector(field);

				// Check with cloned fields
				if ( $(selector).length && $(selector).parents().hasClass('rwmb-clone') ) {
					$(selector).each(function(index, element) {
						var $this 			= $(this);
						var $scope 			= $this.parents('.rwmb-clone');

						var logicApply 		= isLogicCorrect(logic, $scope);

						if (logicApply === true)
							action == 'visible' ? applyVisible($this) : applyHidden($this);
						else if (logicApply === false)
							action == 'visible' ? applyHidden($this) : applyVisible($this);
						else if (logicApply === 'hidden')
							applyHidden($(this));
					} );
				}
				else {

					var logicApply 		= isLogicCorrect(logic, '');
					if (logicApply === true)
						action == 'visible' ? applyVisible($(selector)) : applyHidden($(selector));
					else if (logicApply === false)
						action == 'visible' ? applyHidden($(selector)) : applyVisible($(selector));
					else if (logicApply === 'hidden')
						applyHidden($(selector));
				}

				// Add Start Point
				$.each(logic.when, function(i, single_logic) {
					var singleLogicSelector = guessSelector(single_logic[0]);
					if (($.inArray(singleLogicSelector, window.eventSource) < 0) && typeof singleLogicSelector != 'undefined')
						window.eventSource.push(singleLogicSelector);
				});
			});
		});
		
		window.eventSource = window.eventSource.join();
	}

	/**
	 * Guess the selector by field name
	 * 
	 * @param  String fieldName Field Name
	 * 
	 * @return String selector Field Selector
	 */
	function guessSelector(fieldName)
	{	
		if ($(fieldName).length)
			return fieldName;

		// If #{fieldName} exists. Then return it values
		if ($('#' + fieldName).length && $('#' + fieldName).attr('type') !== 'checkbox' && ! $('#' + fieldName).parents().hasClass('rwmb-clone') )
			return '#' + fieldName;

		if ($('[name^="' + fieldName + '"]').length)
			return '[name^="' + fieldName + '"]';

		if ($('[name*="' + fieldName + '"]').length)
			return '[name*="' + fieldName + '"]';

		if ($('[data-field_id="'+fieldName+'"]').length)
			return '[data-field_id="'+fieldName+'"]';
	}

	/**
	 * Visible field or entire meta box
	 * 
	 * @param  Element element Element Selector
	 * 
	 * @return void
	 */
	function applyVisible($element)
	{
		// Element is a Meta Box. Show entire Meta Box
		if ($element.hasClass('postbox'))
			$element.show().attr('data-visible', 'visible');
		else
			// Element is a Field. Find the field wrapper and show.
			$element.closest( '.rwmb-field' ).show().attr('data-visible', 'visible');
	}

	/**
	 * Hide field or entire meta box

	 * @param  Element element Element Selector
	 * 
	 * @return void
	 */
	function applyHidden($element)
	{
		if ($element.hasClass('postbox'))
			$element.hide().attr('data-visible', 'hidden');
		else
			$element.closest('.rwmb-field').hide().attr('data-visible', 'hidden');
	}


	// Load conditional logic by default
	runConditionalLogic(conditions);

	// Listening eventSource apply conditional logic when eventSource is change
	if (window.eventSource.length > 1) {
		$(window.eventSource).live('change keyup click', function() {
			runConditionalLogic(conditions);
		});
	}

	// Listening to DOM changed event on the non form fields
	if ($('[data-field_id]').length) {
		$('.rwmb-input ul').bind('DOMSubtreeModified', function() {
			runConditionalLogic(conditions);
		});
	}
	
})(jQuery);