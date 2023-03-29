
<?php

require_once __DIR__ . '/../app/Models/Mysql.php';
//require_once __DIR__ . '/../app/Models/LogEvent.php';

use App\Models\LogEventMod;


$GLOBALS['obj_mysqli'] = new MySQL(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
$GLOBALS['DATABASE_PREFIX'] = 'gp_mp_';
$GLOBALS['CREATE_TABLES'] = false;
$GLOBALS['obj_log_event'] = new LogEventMod();


return [];
