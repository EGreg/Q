<?php

/**
 * Implements an input that filters an associated list (like an autocomplete)
 * @class Q filter
 * @constructor
 * @param {array} [$options] Override various options for this tool
 *  @param {String} [$options.name=filter] The name of the text input
 *  @param {String} [$options.value=''] The initial value of the text input
 *  @param {String} [$options.placeholder] Any placeholder text
 *  @param {array} [$options.placeholders={}] Options for Q/placeholders, or null to omit it
 * @return Q.Tool
 */
function Q_filter_tool($options)
{
	Q_Response::setToolOptions($options);
	$name = Q::ifset($options, 'name', 'filter');
	$value = Q::ifset($options, 'value', '');
	$placeholder = Q::ifset($options, 'placeholder', 'filter');
	$class = 'Q_filter_input';
	Q_Response::addScript('plugins/Q/js/tools/filter.js');
	Q_Response::addStylesheet('plugins/Q/css/filter.css');
	return Q_Html::input($name, $value, compact('placeholder', 'class'))
		. '<div class="Q_filter_results"></div>';
}