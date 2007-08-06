--TEST--
tdb_chainlock() and read chainlock
--FILE--
<?php

$file = dirname(__FILE__)."/test.tdb";
$tdb = tdb_open($file);

var_dump(tdb_chainlock());
var_dump(tdb_chainlock($tdb, "", "", ""));

tdb_insert($tdb, "", "");

var_dump(tdb_chainlock($tdb, "", true));
var_dump(tdb_chainlock($tdb, "", true));

var_dump(tdb_chainlock($tdb, ""));
var_dump(tdb_error($tdb));

tdb_close($tdb);
var_dump(tdb_chainlock($tdb, ""));

unlink($file);

echo "Done\n";
?>
--EXPECTF--	
Warning: tdb_chainlock() expects at least 2 parameters, 0 given in %s on line %d
NULL

Warning: tdb_chainlock() expects at most 3 parameters, 4 given in %s on line %d
NULL
bool(true)
bool(true)
bool(true)
string(8) "IO Error"

Warning: tdb_chainlock(): %d is not a valid Trivial DB context resource in %s on line %d
bool(false)
Done
