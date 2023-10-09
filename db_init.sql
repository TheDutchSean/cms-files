mysql -u root

CREATE DATABASE globe_bank;

CREATE USER 'azykiel'@'localhost' IDENTIFIED BY 'myGlobeBank@2023';

GRANT ALL PRIVILEGES ON globe_bank.* TO 'azykiel'@'localhost';

exit;

mysql -u azykiel -p

*enter password manualy no pasting*

/* continue from globe_bank.sql to create tables */

/* 
    $currentPos  =   positon the subject / page is currently in ( 0 ) if item is added
    $newPos    =   positon it will be in after ( 0 ) if item is deleted
*/

/* add a new subject $currentPos == 0 */
UPDATE subjects SET position = position + 1 WHERE position >= $newPos AND id != $id;

/* delete item $newPos == 0 */
UPDATE subjects SET position = position - 1 WHERE position > $currentPos AND id != $id;

/* edit item  $currentPos < $newPos */ 
UPDATE subjects SET position = position - 1 WHERE position > $currentPos AND postion <= $newPos AND id != $id;

/* edit item  $currentPos > $newPos */ 
UPDATE subjects SET position = position + 1 WHERE position >= $newPos AND postion < $currentPos AND id != $id;