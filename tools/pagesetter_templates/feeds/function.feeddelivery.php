<?php

function smarty_function_feeddelivery($params, &$smarty)
{
    extract($params);
	unset($params);

	if ($type == 'atom') {
		header("Content-Type: application/atom+xml; charset=iso-8859-15");
		header("Vary: Accept");
    return;
	}

	else {
		header("Content-Type: application/rss+xml; charset=iso-8859-15");
		header("Vary: Accept");
    return;
	}
 


}

?>
