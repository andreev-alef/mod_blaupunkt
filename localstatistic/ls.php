<?php

require('../../config.php');
$gz = 'dmp.gz';

$mime_gz = 'application/x-gzip';

header("Content-Type: $mime_gz");
header('Content-Disposition: attachment; filename="' . $gz . '"');

passthru("mysqldump --no-tablespaces --user=$CFG->dbuser --password=$CFG->dbpass --host=$CFG->dbhost $CFG->dbname | gzip -9c");

exit(0);
//$gz = 'dmp.gz';
        //exec("mysqldump --no-tablespaces --user=$CFG->dbuser --password=$CFG->dbpass --host=$CFG->dbhost $CFG->dbname | gzip -9c > $gz", $z, $er);