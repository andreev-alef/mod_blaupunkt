<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <?php
        require('../../config.php');
        $gz = 'dmp.gz';
        exec("mysqldump --no-tablespaces --user=$CFG->dbuser --password=$CFG->dbpass --host=$CFG->dbhost $CFG->dbname | gzip -9c > $gz", $z, $er);
        ?>
        <?php if ($er == 0): ?>
            <a href="<?= $gz ?>"><?= $gz ?></a>
        <?php endif; ?>
    </body>
</html>
