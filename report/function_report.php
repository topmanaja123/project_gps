<?php
function Datestr($strDate)
{
  list($m,$d,$y)=explode("/",$strDate);
  $dateTH=$y."-".$m."-".$d;
  return "$dateTH";
}

function keyCheck($statusKey,$namePoto) {

    if ($namePoto == 'meiligao'){
        if (is_null($statusKey)) {
            return '0';
        }elseif ($statusKey == '2000') {
            return '0';
        } else if ($statusKey == '2400') {
            return '0';
        } else if ($statusKey == '6400') {
            return '1';
        } else {
            return ' ';
        }
    
    }else if ($namePoto == 'meitrack'){
        if (is_null($statusKey)) {
            return '0';
        }elseif ($statusKey == '0000') {
            return '0';
        }else if ($statusKey == '0400'){
            return '1';
        }else {
            return ' ';
        }
    
    }else if ($namePoto == 'h02'){
        if (is_null($statusKey)) {
            return '0';
        }elseif ($statusKey == '4294949887'){
            return '0';
        }else if ($statusKey == '4294942719'){
            return '1';
        }else {
            return ' ';
        }
    
    } else{
        return ' ';
    }
        
}


    function fuel($fuelid,$potoName) {

        $fuelMax = 100; //น้ำมันเต็ม
    
        $fuelV = 215; //ค่าโวลต์ ต่ำสุด ที่น้ำมัน 0%
    
        $fuelUse = $fuelid / $fuelV * $fuelMax; //คำนวณค่าน้ำมันที่ใช้ไป
        $fueltotal = 100 - $fuelUse; //ผลลัพ ค่าน้ำมันเป็น เปอร์เซน

        if ($potoName == 'meiligao') {
           if (is_null($fuelid)) {
               return '';
           }elseif ($fuelid == '0') {
                return '0';
            } else if ($fuelid == '0000') {
                return $fueltotal;
            } else {
                return $fueltotal;
            }
      
        }else{
           
        }
    }
 
    function distand($point1,$point2) {      
        
        list($lat1,$lon1)=explode(",",$point1);
        list($lat2,$lon2)=explode(",",$point2);
       
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
          return 0;
        }
        else {
          $theta = $lon1 - $lon2;
          $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
          $dist = acos($dist);
          $dist = rad2deg($dist);
          $miles = $dist * 60 * 1.1515;
           
          return ($miles * 1.609344);
        }
      }

    function timeDiff($time1,$time2){
        $to_time = strtotime($time2);
        $from_time = strtotime($time1);
        return round(abs($to_time - $from_time) / 60,2). " minute";
    }
   
    function Ddiff($strDateTime1,$strDateTime2){
            $date_a = new DateTime($strDateTime1);
            $date_b = new DateTime($strDateTime2);
            $interval = date_diff($date_a,$date_b);

            if ($interval->h == '0' ) {
               return $interval->format('%i นาที');
            }else{
              return $interval->format('%h ชั่วโมง %i นาที');
            }
        }
