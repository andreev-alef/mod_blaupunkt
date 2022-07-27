<?php

$gz = 'dmp.gz';
$sql = 'dmp.sql';
$mime_gz = 'application/x-gzip';
$mime_txt = 'text/plain';

header("Content-Type: $mime_gz");
header('Content-Disposition: attachment; filename="' . $gz . '"');

passthru("mysqldump --no-tablespaces --user=mdl --password=---=== --host=localhost mdl | gzip -9c");
//passthru("mysqldump --no-tablespaces --user=mdl --password=---=== --host=localhost mdl");

exit(0);