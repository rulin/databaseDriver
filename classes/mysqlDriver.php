<?php 

class mysqlDriver extends aDatabaseDriver implements iDatabaseDriver {
	
	protected $dbHost;
	protected $dbUser;
	protected $dbPass;
	protected $dbName; 
	
	public function __construct (array $dbOptions) {

		if (isset($dbOptions['dbHost']) and
			isset($dbOptions['dbUser']) and
			isset($dbOptions['dbPass']) ) {
			
			$this->dbHost = $dbOptions['dbHost'];
			$this->dbUser = $dbOptions['dbUser'];
			$this->dbPass = $dbOptions['dbPass'];
			
			if (isset($dbOptions['dbName']))
				$this->dbName = $dbOptions['dbName'];
		} else			
			throw new Exception('The connection to the database are incorrect'); // MESSAGE_RU: Параметры подключения к базе данных указанны неверно
	}
	
	public function __distruct () {
		
		if (is_resource($this->dbHandle) and 
			get_resource_type($this->dbHandle) == 'mysql link')
			$this->dbClose();
	} 	
	
	public function dbConnect () {
		$this->dbHandle = mysql_connect($this->dbHost, $this->dbUser, $this->dbPass);
		
		if (is_resource($this->dbHandle) and
			get_resource_type($this->dbHandle) == 'mysql link')
			return($this->dbHandle);
		else
			throw new Exception('Unable to connect to the database : '.$this->dbErrnoError()); // MESSAGE_RU: Не удалось подключиться к базе данных
	}
		
	public function dbSelectDatabase (/*string*/ $dbName = false) {
		if ($dbName === false)
			$dbName = $this->dbName;
		
		if (!mysql_select_db($dbName, $this->dbHandle))
			throw new Exception('Unable to select database : '.$this->dbErrnoError()); // MESSAGE_RU: Не Удалось выбрать базу данных		
	}
	
	public function dbQuery (/*string*/ $sqlQuery) {
		if ($result = mysql_query($sqlQuery, $this->dbHandle) === false)
			throw new Exception('Unable to query the database : '.$this->dbErrnoError()); // MESSAGE_RU: Не удалось выполнить запрос к базе данных
		else
			return($result);			 		
	}
	
	public function dbNumRows (/*resouce*/ &$result) {
		if ($numRows = mysql_num_rows($result, $this->dbHandle) === false)
			throw new Exception('Unable to get number of rows : '.$this->dbErrnoError()); // MESSAGE_RU: Не удалось получить количество строк
		else
			return($numRows);
	}
	
	public function dbNumFields (/*resouce*/ &$result) {
		if ($numFields  = mysql_num_fields($result, $this->dbHandle) === false)
			throw new Exception('Unable to get number of fields : '.$this->dbErrnoError()); // MESSAGE_RU: Не удалось получить количество полей
		else
			return($numFields);
	}
		
	public function dbFetchArray (/*resouce*/ &$result) {
		return(mysql_fetch_array($result));
	}
	
	public function dbFetchAssoc (/*resouce*/ &$result) {
		return(mysql_fetch_assoc($result));
	}
	
	public function dbFetchObject (/*resouce*/ &$result) {
		return(mysql_fetch_object($result));
	}
	
	public function dbAffectedRows () {
		return(mysql_affected_rows($result));
	}
	
	public function dbLastInsertId () {
		return(mysql_insert_id($result));	
	}
	
	public function dbEscapeString (/*string*/ $string) {
		return(mysql_real_escape_string($string, $this->dbHandle));
	}
	
	public function dbErrno () {
		return(mysql_errno($this->dbHandle));
	}
	
	public function dbError () {
		return(mysql_error($this->dbHandle));
	}
			
	public function dbClose () {
		return(mysql_close($this->dbHandle));
	}	
}
