fix function db_error to no show vital parts of the sql query

Chapter 9-4 | PREPAIRED SQL STATMENTS

LEARN MORE ABOUT THEM

GENERAL FIX 
db_query =>
-   Rewrite db_query to oop methode
-   query result if its only 1 always have a assco key 
    - 20230913 Fixed the query in so that it always pushes the result into an raay with the assoc function. db_query needs more improvment and     fixing mabey add options to configure which way data is outputed.
-   input can be 1 value as in string, int ecta

getAdmin data 
-   fix fields so that it will not show hashed_password



READY: Fix positions on pages
-   20230913 Fixed positions, bug in javascript where element was not passed to functio setPositions and page_options.php added foreach loop to get right array index.

Logout if the admin thats logged in is deleted

Beter admin edit controls (only the logged in admin can be deleted)

Add superadmin/user 

Improve logging