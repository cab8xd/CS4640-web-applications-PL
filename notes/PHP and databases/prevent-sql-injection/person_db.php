<?php

// Example to show how prepared statements can be used to prevent SQL injection 
// CS 4640: WebPL

// To run this example, you'd need to first set up a database 
//   -- log into your database server
//   -- run the CREATE TABLE and the INSERT statements below 
// Assuming there are 2 tables in this database: person and private, 
// A person table maintains person's name and email which is searchable through a web form (findPerson.php).
// A private table maintains some secrets that can be accessed only by authorized persons. 

// Ideally, a user can find a person based on a name using a web form. 
// However, some users with SQL skills may gain unauthorized access to the entire tables (i.e., SQL injection)
// One simple approach to prevent SQL injection is to use a prepared statement such that 
// the unintended SQL scripts are excluded when running the query against the person table. 


// CREATE TABLE person (
// 		name varchar(30) NOT NULL,
//      email varchar(30) NOT NULL,
// 		PRIMARY KEY (name) );

// CREATE TABLE private (
// 		id int NOT NULL,
// 		secrets varchar(255) NOT NULL,
// 		PRIMARY KEY (id) );

// INSERT INTO person (name, email) VALUES ("someone", "someone@uva.edu");
// INSERT INTO person (name, email) VALUES ("someone else", "someone_else@uva.edu");
// INSERT INTO person (name, email) VALUES ("wacky", "wacky@uva.edu");
// INSERT INTO person (name, email) VALUES ("duh", "duh@uva.edu");

// INSERT INTO private (id, secrets) VALUES (1, "You shouldn't see this");
// INSERT INTO private (id, secrets) VALUES (2, "Here is my secret");
// INSERT INTO private (id, secrets) VALUES (3, "I am a spy");
// INSERT INTO private (id, secrets) VALUES (4, "I plan to hack your account");


// Prepared statement (or parameterized statement) happens in 2 phases:
//   1. prepare() sends a template to the server, the server analyzes the syntax
//                and initialize the internal structure.
//   2. bind value (if applicable) and execute
//      bindValue() fills in the template (~fill in the blanks).
//                For example, bindValue(':name', $name);
//                the server will locate the missing part signified by a colon
//                (in this example, :name) in the template
//                and replaces it with the actual value from $name.
//                Thus, be sure to match the name; a mismatch is ignored.
//      execute() actually executes the SQL statement

function getPersonInfo($name)
{
	global $db;
	
	// bad, vulnerable to sql injection
	$query = 'SELECT * FROM person WHERE name ="' . $name . '"';
	$statement = $db->query($query);
   
	// good, use prepare statement to minimize chance of sql injection
// 	$query = "SELECT * FROM person WHERE name = :name";
// 	$statement = $db->prepare($query);
// 	$statement->bindValue(':name', $name);
// 	$statement->execute();
	
	$results = $statement->fetchAll();
	$statement->closecursor();
	
	return $results;
}

