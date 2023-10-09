===========================================================================================================

Chapter 2-4 

diffrence between urlencode and rawencode:
    in urlencode the spaces are replaced + and with rawurlencode the space will be replaced with %20

rawurlencode:
    is used on the path of an URL (everything before the ?)

urlencode:
    is used on the query string of an URL (everything afther the ?)

example
    use: rawurlencode?urlencode
    url: google.com?page=1

===========================================================================================================

Chapter 2-5

htmlspecialchars:
    should be used where the user can input data using inputs fields and the url query string to inject code into our php. It will filter values of unwanted HTML charchters like <, >, &

example:
    htmlspecialchars($string);    

===========================================================================================================

Chapter 7-5 | DELETE

ALWAYS USE A FORM WITH THE POST METHODE TRYING TO DELETE RECORD FROM A DATABASE!!! This is because 
search engine spiders will click on all the links on your site if there NOT POST

===========================================================================================================

Chapter 8-4 | TYPE JUGGELING

While validating data always try to compair the same datatypes or use explicit compare ( === ) instead of ==


echo 0 == FALSE ? 'true' : 'false';
// returns true

echo 0 === FALSE ? 'true' : 'false';
// returns false
 
===========================================================================================================

Chapter 9-4 | PREPAIRED SQL STATMENTS

LEARN MORE ABOUT THEM
 
===========================================================================================================