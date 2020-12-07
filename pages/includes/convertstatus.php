<?php

    function statusth($status_name) {
        $statuseng = $status_name;
        switch ($statuseng) {
            case "Plan":
                return "แผนงาน";
                break;
            case "Open":
                return "เปิดงาน";
                break;
            case "In Process":
                return "กำลังดำเนินงาน";
                break;
            case "In Review":
                return "รอตรวจสอบงาน";
                break;
            case "In Permit":
                return "รอตรวจรับงาน";
                break;
            case "Done":
                return "เสร็จสมบูรณ์";
                break;
            case "Disable":
                return "ถูกลบ";
                break;
        }       
    }

function roleth($role_name)
{
    $roleeng = $role_name;
    switch ($roleeng) {
        case "customer":
            return "ลูกค้า";
            break;
        case "staff":
            return "ผู้ปฏิบัติงาน";
            break;
        case "leader":
            return "หัวหน้างาน";
            break;
        
    }
}

    function convertTodigitalStorage($sizefile) {
        switch ($sizefile) {
            case $sizefile > 1000 && $sizefile < 1000000:
                $size = $sizefile / 1000;
                return $size. "kb";
                break;
            case $sizefile > 1000000:
                $size = $sizefile / 1000000;
                return $size. "mb";
                break;
        }
    }
