<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

/**
 * Log event system
 */
/** requires */

use App\Models\IpMod;

require_once 'Mysql.php';

/**
 * Log event system
 * @filename: log_events.mod.class.php
 * Location: _app/_models/_class
 * @Creator: R. Bernal (RBM) <info@novaigrup.com>
 * 	20150420 RBM Created
 */
class LogEventMod extends Model
{

    /**
     * DB object
     * @var object
     * @access private
     */
    private $obj_mysqli = NULL;

    /**
     * Current Account id
     * @var int
     * @access private
     */
    private $account_id = 0;

    /**
     * Data base prefix
     * @var string
     * @access private
     */
    private $database_prefix = '';

    const LOG_EVENT_LOGIN = 1;
    const LOG_EVENT_LOGOUT = 2;
    const LOG_EVENT_LOCK_ACCOUNT = 3;
    const LOG_EVENT_CAPTCHA = 5;
    const LOG_EVENT_APPLICATION = 6;
    const LOG_EVENT_APPLICATION_SEC = 7;
    const LOG_EVENT_SECURITY = 8;
    const LOG_EVENT_PERMISSION = 9;
    const LOG_EVENT_SHOPPING = 10;

    /**
     * Class constructor
     * @param MySQL $obj_mysqli_opt Optional Mysql connection for multiple proyect databases
     * @param string $database_prefix_opt Data base prefix for optional mysql connection
     * @access public
     */
    public function __construct(MySQL $obj_mysqli_opt = NULL, $database_prefix_opt = '')
    {

        /** MySqli class */
        if (is_null($obj_mysqli_opt))
        {
            if (isset($GLOBALS['obj_mysqli']) && is_object($GLOBALS['obj_mysqli']) && $GLOBALS['obj_mysqli']->checkConnectionClass())
            {

                $this->obj_mysqli = $GLOBALS['obj_mysqli'];
                $this->database_prefix = $GLOBALS['DATABASE_PREFIX'];
            }
            else
            {
                //Default proyect database connection
                $this->obj_mysqli = new MySQL(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
                $this->database_prefix = $GLOBALS['DATABASE_PREFIX'];
            }
        }
        else
        {
            //Optional database connection
            $this->obj_mysqli = $obj_mysqli_opt;
            $this->database_prefix = $database_prefix_opt;
        }

        if (!method_exists($this->obj_mysqli, 'checkConnectionClass'))
            return false;

        if (!$this->obj_mysqli->checkConnectionClass())
            return false;

        $this->createTables();
    }

    /**
     * Save system log event
     * @param integer $log_type Log type value. Can use "LOG_EVENT_" private class constants
     * @param string $log_text
     * @param int $return_code
     * @param string $log_date
     */
    public function saveLogEvent($log_type, $log_text = '', $return_code = 1, $log_date = '')
    {
        if (!method_exists($this->obj_mysqli, 'checkConnectionClass'))
            return false;

        if (!$this->obj_mysqli->checkConnectionClass())
            return false;

        $runtime_environment_information = (isset($GLOBALS['runtime_environment_information'])) ? $GLOBALS['runtime_environment_information'] : $_SERVER;
        $http_referrer = (isset($runtime_environment_information['HTTP_REFERER'])) ? $runtime_environment_information['HTTP_REFERER'] : '';
        $user_agent = (isset($runtime_environment_information['HTTP_USER_AGENT'])) ? $runtime_environment_information['HTTP_USER_AGENT'] : '';

        switch ($log_type)
        {
            case self::LOG_EVENT_LOCK_ACCOUNT:
                break;
            default:
                $sop = 'INSERT INTO ' . $this->database_prefix . 'log 
                ( log_date, log_type, log_return_code, log_text, http_referrer, user_agent, ip, user_id )
                VALUES
                (?,?,?,?,?,?,?,?)
                ';
                /** Get session date to prevent date problems on check last log login */
                $log_date = (trim($log_date) != '') ? trim($log_date) : date('Y-m-d H:i:s', time());

                $params = array('siissssi', $log_date, (int) $log_type, (int) $return_code, $log_text, $http_referrer, $user_agent, IpMod::getIp(),  Auth::user()->id);
                $this->obj_mysqli->executePreparedStatement($sop, $params);
                break;
        }
    }

    /**
     * Get Last Login From log
     * @param int $account_id
     * @return string
     */
    public function getLastLogin($account_id, $date_format = 'd-m-Y H:i:s')
    {
        $sop = "SELECT log_date FROM " . $this->database_prefix . "log WHERE user_id = ? AND log_type = ?  ORDER BY log_date DESC LIMIT 1";
        $params = array("ii", (int) $account_id, self::LOG_EVENT_LOGIN);
        $result = $this->obj_mysqli->executePreparedStatement($sop, $params);
        $last_login = $result[0]['log_date'];

        return ($last_login) ? date($date_format, strtotime($last_login)) : date($date_format);
    }


    private function createTables()
    {

        if ($GLOBALS['CREATE_TABLES'] === true)
        {

            $sop = "
            CREATE TABLE IF NOT EXISTS `" . $this->database_prefix . "log` (
                `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique identifier',
                `log_date` timestamp  NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date log',
                `log_type` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Log type. 1->login;2->logout;3->lock account; 4->login failed; 5->captcha failed; 6->application, 7->aplication secundary, 8->XSS filtrado, 9->permission, 10->shopping',
                `log_return_code` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'return code 0 -> error, 1 -> ok',
                `log_text` text NOT NULL DEFAULT '',
                `http_referrer` varchar(255) NOT NULL DEFAULT '',
                `user_agent` varchar(255) NOT NULL DEFAULT '',
                `ip` varchar(45) NOT NULL DEFAULT '' COMMENT 'Ip',
                `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'User id if user is logged into app',
               
                PRIMARY KEY (`log_id`),
                INDEX(`user_id`)
              
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
            ";
            $GLOBALS['obj_mysqli']->executePreparedStatement($sop, '');
        }
    }
}
