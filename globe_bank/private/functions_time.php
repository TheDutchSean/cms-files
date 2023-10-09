<?php 

    // format   : 0 = default : YYYYMMDD, 1 = iso : YYYY-MM-DD,  2 =  iso : YYYY/MM/DD, 3 =  eu : DD-MM-YYYY, 4 =  eu : DD/MM/YYYY, 
    function getISODate($format = 0, $custom = '%Y-%m-%d'){
        
        switch($format){
            case 0:
                return strftime('%Y%m%d');
            case 1:
                return strftime('%Y-%m-%d');   
            case 2:
                return strftime('%Y/%m/%d');
            case 3:
                return strftime('%d-%m-%Y');   
            case 4:
                return strftime('%d/%m/%Y'); 
            case 5:
                return strftime($custom);
        }
    };



?>
