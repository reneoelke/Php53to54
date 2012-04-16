<?php

// VALID CALLS
echo "sql_list_array_query()";

// INVALID CALLS
echo "".sqlite_array_query();

SQLiteDatabase::createFunction();

class myClass extends SQLiteDatabase {
	
}

echo  SQLiteResult::column();