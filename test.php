<?php

require_once 'vendor/autoload.php';

$durations = array();

$template = file_get_contents('template.lex');
$data = array(
	'title'     => 'Current Projects',
	'projects'  => array(
		array(
			'name' => 'Acme Site',
			'assignees' => array(
				array('name' => 'Dan'),
				array('name' => 'Phil'),
			),
		),
		array(
			'name' => 'Lex',
			'contributors' => array(
				array('name' => 'Dan'),
				array('name' => 'Ziggy'),
				array('name' => 'Jerel')
			),
		),
	),
);

for ($i=0; $i < 1000; $i++)
{
	// What's the time now?
	$start_time = microtime(TRUE);

	// Load Lex
	$parser = new Lex\Parser();
	$parser->parse($template, $data);

	// What's the time now and how long did it take?
	$end_time = microtime(TRUE);
	$durations[] = $end_time - $start_time;
}

$opavg = (array_sum($durations) / 1000);
$opavgtotal = 0;
$ops = 0;
$break = FALSE;

while (!$break)
{
	$opavgtotal += $opavg;

	if ($opavgtotal >= 1)
	{
		$break = TRUE;
	}
	else
	{
		$ops++;
	}
}

echo "Average Time: " . number_format(array_sum($durations) / 1000, 6) . 's' . PHP_EOL;
echo "Operations Per Second: " . $ops;