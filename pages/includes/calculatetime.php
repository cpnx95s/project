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
    foreach ($time as $key => $value) {
        echo $value['start'];
        echo $value['end'];
    }
    // $totaltime = '';
    // foreach($time_a as $time) {
    //     $timestamp = $time;
    //     $totaltime += $timestamp;
    // }
    // $average_time = ($totaltime/$countTask);


}




?>