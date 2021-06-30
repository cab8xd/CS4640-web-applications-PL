--
-- Simple library database for PHP and database programming activity
-- CS 4640: WebPL
-- 
-- Import into phpMyAdmin using one of the following options:
--   Option 1: copy and paste 
--     1. Log into phpMyAdmin
--     2. Click on your database name on the left-hand side
--     3. Go to the "SQL" table
--     4. Copy all of the code in this file, paste it into the SQL tab. Then, click "Go"
--     5. Click back onto your database name and check the three tables were added
--     6. (Sanity check) Execute a simple query in the "SQL" tab to ensure tables are there
--   Option 2: use the Import feature 
--     1. Log into phpMyAdmin
--     2. Click on your database name on the left-hand side
--     3. Click the "Import" tab
--     4. Select the SQL file (library.sql) you want to run. Then, click "Go"
--     5. Click back onto your database name and check the three tables were added
--     6. (Sanity check) Execute a simple query in the "SQL" tab to ensure tables are there
--


CREATE TABLE IF NOT EXISTS borrow_records (
    title VARCHAR(225),
    authors VARCHAR(225),
    email VARCHAR(30),
    borrower_name VARCHAR(30),
    checkout_date DATE,
    PRIMARY KEY (title, email, checkout_date));

-- Aassume each user would borrow one copy of a particular book. 
-- If the library allows a user to borrow multiple copies of a particular book, a primary key needs to be modified.    
    

-- One way to write an insert statement: specify the colunm names and then values for the columns. 
-- INSERT INTO `borrow_records`(`title`, `authors`, `email`, `borrower_name`, `checkout_date`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5])

-- If we know the order of the columns, we can omit the column names. 
INSERT INTO borrow_records VALUES ('The Snowy Day', 'Ezra Jack Keats', 'webpl.uva@gmail.com', 'Humpty', '2021-03-01');
INSERT INTO borrow_records VALUES ('The Cat in the Hat', 'Dr. Seuss', 'webpl.uva@gmail.com', 'Humpty', '2021-03-01');
INSERT INTO borrow_records VALUES ('Where The Wild Things Are', 'Maurice Sendak', 'webpl.uva@gmail.com', 'Dumpty', '2021-03-16');
INSERT INTO borrow_records VALUES ('Where The Wild Things Are', 'Maurice Sendak', 'webpl.uva@gmail.com', 'Humpty', '2021-03-27');
INSERT INTO borrow_records VALUES ("Charlotte's Web by", 'E.B. White', 'webpl.uva@gmail.com', 'Dumpty', '2021-03-26');
INSERT INTO borrow_records VALUES ("Harry Potter and the Sorcerer's Stone", 'J.K. Rowling', 'webpl.uva@gmail.com', 'Wacky', '2021-03-26');
INSERT INTO borrow_records VALUES ('The Very Hungry Caterpillar', 'Eric Carle', 'webpl.uva@gmail.com', 'Dumpty', '2021-03-06');
INSERT INTO borrow_records VALUES ("Harry Potter and the Sorcerer's Stone", 'J.K. Rowling', 'webpl.uva@gmail.com', 'Wacky', '2021-03-29');
    