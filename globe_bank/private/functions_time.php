<?php 

    // format   : 0 = default : YYYYMMDD, 1 = iso : YYYY-MM-DD,  2 =  iso : YYYY/MM/DD, 3 =  eu : DD-MM-YYYY, 4 =  eu : DD/MM/YYYY, 
    function getISODate($format = 0){      

        $date = getdate();

        if($date['mon'] < 10){
            $date['mon'] = "0".$date['mon'];
        }

        if($date['mday'] < 10){
            $date['mday'] = "0".$date['mday'];
        }

        switch($format){               
            case 1:
                return $date['year'].'-'.$date['mon'].'-'.$date['mday'];   
            case 2:
                return $date['year'].'/'.$date['mon'].'/'.$date['mday'];
            case 3:
                return $date['mday'].'-'.$date['mon'].'-'.$date['year'];   
            case 4:
                return $date['mday'].'/'.$date['mon'].'/'.$date['year']; 
            default:
                return $date['year'].$date['mon'].$date['mday'];
        }
    };

    
    // format   : 0 = default : H:M:S, 1 = H:M,  2 =  H, 3 =   M,  4 =  S, 5 = HMS   
    function getTime($format = 0){      

        $time = getDate();

        if($time['hours'] < 10){
            $time['hours'] = "0".$time['hours'];
        }

        if($time['minutes'] < 10){
            $time['minutes'] = "0".$time['minutes'];
        }

        switch($format){
            case 1:
                return $time['hours'].':'.$time['minutes'];   
            case 2:
                return $time['hours'];
            case 3:
                return $time['minutes'];   
            case 4:
                return $time['seconds']; 
            default:
                return $time['hours'].':'.$time['minutes'].':'.$time['seconds'];
        }
    };



?>
