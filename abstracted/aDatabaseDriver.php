<?php

abstract class aDatabaseDriver {
	
	protected $dbHandle;
	
	public function getHandle() {
		return $this->dbHandle;	
	}
	
	// Default fetch array assoc
	final public function dbFetch (/*resouce*/ &$result) {
		return($this->dbFetchAssoc($result));
	}
	
	public function dbErrnoError() {
    	return ($this->dbErrno().' : '.$this->dbError());
    }    
    
}