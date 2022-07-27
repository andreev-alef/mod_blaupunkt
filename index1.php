<?php

$gz = 'dmp.gz';
header("Content-Type: application/x-gzip");
header('Content-Disposition: attachment; filename="' . $gz . '"');

passthru("mysqldump --no-tablespaces --user=mdl --password=---=== --host=localhost mdl | gzip -9c", $z, $er);
