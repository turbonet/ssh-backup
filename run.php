<?php
define('ROOT', dirname(__FILE__));

require ROOT.'/vendor/autoload.php';
require ROOT.'/lib/sshbackup.php';

$configlist = require ROOT.'/config.php';

foreach ($configlist as $config) {
    $backup = new sshbackup($config);
    $backup->run();
}