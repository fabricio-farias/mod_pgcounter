<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_articles_archive
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

//require_once JPATH_SITE . DS.'components'.DS.'com_phocadownload'.DS.'models'.DS.'categories.php';
//require_once JPATH_SITE . DS.'components'.DS.'com_phocadownload'.DS.'models'.DS.'category.php';
//jimport('joomla.database.database');jimport( 'joomla.database.table' );jimport('joomla.html.parameter');
//jimport('joomla.application.component.model');

class modPGCounterHelper
{
    var $_host          = null;
    var $_port          = null;
    var $_dbname        = null;
    var $_user          = null;
    var $_password      = null;
    var $_connection    = null;
    var $_error         = array();
    
    function __construct($params = array()) {
        
        if($params){
            $this->_host    = $params->get('mod_host');
            $this->_port    = $params->get('mod_port');
            $this->_dbname  = $params->get('mod_dbname');
            $this->_user    = $params->get('mod_user');
            $this->_password = $params->get('mod_password');
        }else{
            $this->_host    = '10.1.1.25';
            $this->_port    = '5432';
            $this->_dbname  = 'UPAS';
            $this->_user    = 'postgres';
            $this->_password = 'postgres';
        }
    }
    
    function open() {

        try {
            $this->_connection = new PDO("pgsql:host=$this->_host;dbname=$this->_dbname;port=$this->_port;", $this->_user, $this->_password, array(PDO::ATTR_TIMEOUT => "60",PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            @pg_set_client_encoding($con, "UNICODE");
            
            if(!$this->_connection){
                $this->_error[] = pg_last_error($this->_connection);
                $this->_connection = false;
            }
        
            return $this->_connection;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        
    }

    static function close() {
        @pg_close($this->_connection);
    }

    function getCount() {
        try {
            $rows = array();
            
            if(!$this->_connection){
                $this->_connection = $this->open();
            }
            
            if($this->_connection){
                $query = "SELECT internacaoes_upas() as value";

                $result = $this->_connection->query($query);

                if (!$result) {
                    $this->_error[] = pg_last_error();
                } else{
                    $row = $result->fetchObject();
                }
                
                return $row;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
        
    static function getParams($id){
        $db = JFactory::getDbo();
        $query	= $db->getQuery(true);
        $query->select("params");
        $query->from("#__modules");
        $query->where("id = " . (int)$id);

        $db->setQuery($query);
        $row = $db->loadResult();

        return $row;
    }
}
