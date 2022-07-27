<?php

$gz = 'dmp.gz';
$sql = 'dmp.sql';
//$mime = 'application/x-gzip';
$mime = 'text/plain';

header("Content-Type: $mime");
header('Content-Disposition: attachment; filename="' . $sql . '"');

//passthru("mysqldump --no-tablespaces --user=mdl --password=---=== --host=localhost mdl | gzip -9cf", $z, $er);
passthru("mysqldump --no-tablespaces --user=mdl --password=---=== --host=localhost mdl", $z, $er);

exit(0);