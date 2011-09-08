<?php

interface iDatabaseDriver {
	
	public function __construct (array $dbOptions);
	public function dbConnect ();
	public function dbSelectDatabase (/*string*/ $dbName = false);
	public function &dbQuery (/*string*/ $sqlQuery);
	public function dbNumRows (/*resouce*/ &$result);
	public function dbNumFields (/*resouce*/ &$result);
	//Default fetch array assoc
	public function dbFetch (/*resouce*/ &$result);	
	public function dbFetchArray (/*resouce*/ &$result);
	public function dbFetchAssoc (/*resouce*/ &$result);
	public function dbFetchObject (/*resouce*/ &$result);
	public function dbAffectedRows ();
	public function dbLastInsertId ();
	public function dbEscapeString (/*string*/ $string);
	public function dbErrno ();
	public function dbError ();
	public function dbClose ();
	
}