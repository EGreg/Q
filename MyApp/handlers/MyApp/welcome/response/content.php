<?php

function MyApp_welcome_response_content($params)
{
	// Do controller stuff here. Prepare variables
	$tabs = array("foo" => "bar");
	$description = "this is a description";
	return Q::view('MyApp/content/welcome.php', compact('tabs', 'description'));
}

