<?php 
function diff2time($time_a,$time_b){
    $now_time1=strtotime(date("Y-m-d ".$time_a));
    $now_time2=strtotime(date("Y-m-d ".$time_b));
    $time_diff=abs($now_time2-$now_time1);
    $time_diff_h=floor($time_diff/3600); // จำนวนชั่วโมงที่ต่างกัน
    $time_diff_m=floor(($time_diff%3600)/60); // จำวนวนนาทีที่ต่างกัน
    $time_diff_s=($time_diff%3600)%60; // จำนวนวินาทีที่ต่างกัน
    return $time_diff_h." ชั่วโมง ".$time_diff_m." นาที ".$time_diff_s." วินาที";
}



function averagetime(array $time, $countTask) {
    // foreach ($time as $key => $value) {
    //     echo $value['start'];
    //     echo $value['stop'];
    // }

  
    $intervals = array();
    $i = 0;

        foreach ($time as $key) {
            
                $newTimeAdd = new DateTime($key["start"]);
                $newTimeRead = new DateTime($key["stop"]);
                $interval = $newTimeAdd->diff($newTimeRead);

                // $intervals[$i] = $interval->format('%h:%i:%s');//get days
                $intervals[] = array($interval->format('%h:%i:%s'));
        }
        echo AddPlayTime($intervals);
        print_r($intervals);
        if(!empty($intervals))
        {
            $average = average($intervals);
            // echo $average;
        }

    // $totaltime = '';
    // foreach($time_a as $time) {
    //     $timestamp = $time;
    //     $totaltime += $timestamp;
    // }
    // $average_time = ($totaltime/$countTask);


}

function AddPlayTime($times) {
    $minutes = 0; //declare minutes either it gives Notice: Undefined variable
    // loop throught all the times
    foreach ($times as $time) {
        list($hour, $minute) = explode(':', $time);
        $minutes += $hour * 60;
        $minutes += $minute;
    }

    $hours = floor($minutes / 60);
    $minutes -= $hours * 60;

    // returns the time already formatted
    return sprintf('%02d:%02d', $hours, $minutes);
    // // loop throught all the times
    // foreach ($times as $time) {
    //     list($hour, $minute, $second) = explode(':', $time);
    //     $all_seconds += $hour * 3600;
    //     $all_seconds += $minute * 60; $all_seconds += $second;

    // }


    // $total_minutes = floor($all_seconds/60); $seconds = $all_seconds % 60;  $hours = floor($total_minutes / 60); $minutes = $total_minutes % 60;

    // // returns the time already formatted
    // return sprintf('%02d:%02d:%02d', $hours, $minutes,$seconds);
}

function average($arr)
{
//     $sum = strtotime('00:00:00');
//  $sum2=0;  
//  foreach ($arr as $v){

//         $sum1=strtotime($v)-$sum;

//         $sum2 = $sum2+$sum1;
//     }

//     $sum3=$sum+$sum2;

//     echo date("H:i:s",$sum3);

    
//     $sum = strtotime('00:00:00');
// $sum1 = 0;
// foreach ($arr as $v){
//     $sum1 += strtotime($v) - $sum;
// }
// $hours = $sum1 / 3600;
// $minutes = ($hours - floor($hours)) * 60;

// echo floor($hours) . ':' . round($minutes);
    // $totaltime = 0;

    // foreach($arr as $time) {
    //     $timestamp = $time;
    //     $totaltime += $timestamp;
    // }
    // echo $totaltime;
   return array_sum($arr)/2;
}
