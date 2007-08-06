--TEST--
tdb_lock() and read lock
--FILE--
<?php

$file = dirname(__FILE__)."/test.tdb";
$tdb = tdb_open($file);

var_dump(tdb_lock());
var_dump(tdb_lock($tdb, "", ""));

var_dump(tdb_lock($tdb, true));
var_dump(tdb_lock($tdb, true));

var_dump(tdb_lock($tdb));
var_dump(tdb_error($tdb));

tdb_close($tdb);
var_dump(tdb_lock($tdb));

unlink($file);

echo "Done\n";
?>
--EXPECTF--	
Warning: tdb_lock() expects at least 1 parameter, 0 given in %s on line %d
NULL

Warning: tdb_lock() expects at most 2 parameters, 3 given in %s on line %d
NULL
bool(true)
bool(true)

Warning: tdb_lock(): Locking error in %s on line %d
bool(false)
string(13) "Locking error"

Warning: tdb_lock(): %d is not a valid Trivial DB context resource in %s on line %d
bool(false)
Done
