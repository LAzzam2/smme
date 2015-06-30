<?php
	// output headers so that the file is downloaded rather than displayed
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=data.csv');
	
	// create a file pointer connected to the output stream
	$output = fopen('php://output', 'w');
	
	// output the column headings
	fputcsv($output, array('Column 1', 'Column 2', 'Column 3'));
	
	// fetch the data
	require_once('../connect.php');
	
	$rows = mysql_query('SELECT address1, address2, address3 FROM letters');
	
	// loop over the rows, outputting them
	while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);
?>