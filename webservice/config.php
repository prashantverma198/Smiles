<?php
/**
 * Copyright (c) 2012 AD2C INDIA PVT. LTD
 *	
 *
 * @package       AD2SMILES
 * @copyright     AD2C INDIA PVT. LTD
 * @author        rohit soni <rohit@ad2c.co>
 * @license       Proprietary
 * @Description   ad2smiles Configuration File
 * 
 */
 
 
//error_reporting(E_ERROR); //PRODUCTION

error_reporting (E_ALL ^ E_NOTICE); //DEVELOPMENT

define('__ROOT__', str_replace('\\','/',(((dirname(__FILE__)))))); 
define("__COREAPI__", __ROOT__."/coreApi");

include_once(__COREAPI__."/genUCode.php"); 

include_once('common/class.database.php');
include_once('common/tablenames.php');


//MYSQL CONNECTION PARAMETERS
$MYSQL_HOST      = "localhost";
$MYSQL_USER      = "root";
$MYSQL_PASSWORD  = "";
$MYSQL_DB_SCHEMA = "mobimast_ad2smiles";

?>