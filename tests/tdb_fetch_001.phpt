--TEST--
tdb_fetch() basic tests
--FILE--
<?php

$tdb = tdb_open("", 0, TDB_INTERNAL);

var_dump(tdb_fetch());
var_dump(tdb_fetch($tdb, "", "", ""));
var_dump(tdb_fetch($tdb, -1));
var_dump(tdb_fetch($tdb, ""));

tdb_insert($tdb, "test", "value");
var_dump(tdb_fetch($tdb, "test"));

$str = str_repeat("\0", 256);
tdb_update($tdb, "test", $str);
var_dump(tdb_fetch($tdb, "test"));

tdb_close($tdb);
var_dump(tdb_fetch($tdb, "test"));

echo "Done\n";
?>
--EXPECTF--	
Warning: tdb_fetch() expects exactly 2 parameters, 0 given in %s on line %d
NULL

Warning: tdb_fetch() expects exactly 2 parameters, 4 given in %s on line %d
NULL

Warning: tdb_fetch(): Record does not exist in %s on line %d
bool(false)

Warning: tdb_fetch(): Record does not exist in %s on line %d
bool(false)
string(5) "value"
string(256) "                                                                                                                                                                                                                                                                "

Warning: tdb_fetch(): %d is not a valid Trivial DB context resource in %s on line %d
bool(false)
Done
