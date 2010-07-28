<?php 

if(exec_enabled())
{
	$logs = array();
	$log = exec('GIT_DIR=/var/www/vhosts/zerozaku.com/production.git git log --pretty=format:"%cd:::%s"', $logs);
	
	// Prevent caching
	header('Content-Type: application/json; charset=UTF8');
	header('Cache-Control: no-cache, must-revalidate');
	header("Expires: Mon, 26 Jul 1997 05:00:00 PST");
	
	if(sizeof($logs))
	{
		$data = array();
		foreach($logs as $log)
		{
			$data[] = explode(':::', $log);
		}
		
		echo json_encode($data);
	}
}
else die('exec() is not enabled');

function exec_enabled() {
	$disabled = explode(', ', ini_get('disable_functions'));
	return !in_array('exec', $disabled);
}

?>