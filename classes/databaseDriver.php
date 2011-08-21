<?php

class databaseDriver {
	
	protected static $instances = array();
	
	private function __construct() {}
	private function __clone() {}
	
	public static function getInstance($instanceKey = 0, $dbOptions = false) {
		
		if (isset(self::$instances[$instanceKey])) {			
			return(self::$instances[$instanceKey]);
		} elseif (is_array($dbOptions) and isset($dbOptions['dbType'])) {
						
			$dbType = trim($dbOptions['dbType']);
			$driverClassPath = dirname(__FILE__);
			$driverCurrentPath = $driverClassPath.'/'.$dbType.'Driver.php'; 
			
			if (file_exists($driverCurrentPath)) {
				require_once $driverCurrentPath;
				$dbTypeDriver = $dbType.'Driver';
				return(self::$instances[$instanceKey] = new $dbTypeDriver($dbOptions));				
			} else
				throw new Exception('This type of database is not supported'); // MESSAGE_RU: ƒанный тип базы данных не поддерживаетс€						
		} else 
			throw new Exception('Instance key '.$instanceKey.' is not defined'); // MESSAGE_RU: Ёкземпл€р номером є не определен
	} 
}