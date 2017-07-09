<?php 
$host=gethostbyname("localhost");
define("connection_string","host=".$host." dbname=leave user=postgres password=password");
define("MAXCL", 8);
define("MAXRH", 2);
define("TMAXCL", 12);
define("TMAXRH", 0);
define("MSG_NO_CONN","Failed to connect to database.");
define("MSG_NO_PERS","No Persons Found.");
define("MSG_NO_CHOICE","You did not choose an option.");
define("MSG_NO_MAIL","Failed while sending a mail.");
define("MSG_NO_COMPID","Invalid or missing Complaint ID.");
define("MSG_NO_SLIP","Your Pay Slip was not found.");
define("MSG_NO_EMPID","Invalid or missing Employee ID.");
define("MSG_NO_LEVID","Invalid or missing Leave ID.");
define("MSG_LRG_FILE","File too large.");
define("MSG_NO_COMPS","No Complaints.");
define("MSG_NO_LEVS","No Leave Applications.");
define("MSG_MISS_DETAILS","Please Fill all the Details");
define("MSG_WRG_ID","Wrong User ID.");
define("MSG_WRG_PASS","Wrong Password.");
define("MSG_WRG_PRV","We can't mail you the password. Please contact the administrator to get your password back.");
define("MSG_NO_PRV","You don't have the priveleges to view this page.");
define("MSG_MORE_PREVS","This login is only meant for employees & not for administrators or engineers.");
?>
