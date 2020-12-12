<?php include_once('../authen.php') ?>
<?php include_once('../includes/connect.php') ?>
<?php include_once('../includes/convertstatus.php') ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ระบบติดตามสำหรับการจัดการสื่อโฆษณาบนสังคมออนไลน์</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="../../dist/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../../dist/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../../dist/img/favicons/favicon-16x16.png">
    <link rel="manifest" href="../../dist/img/favicons/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/0ff79eb7ba.js"></script>
    <!-- Ionicons -->
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar & Main Sidebar Container -->
        <?php include_once('../includes/sidebar_leader.php') ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <!-- Main content -->
            <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                    <div class="col-12">
                        <h4>
                            <i class="fa fa-pie-chart"></i> รายงานประสิทธิภาพการทำงานของพนักงาน
                            <small class="float-right"> <?php
                                                        function DateThai($strDate)
                                                        {
                                                            date_default_timezone_set("Asia/Bangkok");
                                                            $strYear = date("Y", strtotime($strDate)) + 543;
                                                            $strMonth = date("n", strtotime($strDate));
                                                            $strDay = date("j", strtotime($strDate));
                                                            $strHour = date("H", strtotime($strDate));
                                                            $strMinute = date("i", strtotime($strDate));
                                                            $strSeconds = date("s", strtotime($strDate));
                                                            $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
                                                            $strMonthThai = $strMonthCut[$strMonth];
                                                            return "$strDay $strMonthThai $strYear";
                                                        }

                                                        $strDate = date("Y-m-d");
                                                        echo "วันที่ : " . DateThai($strDate);
                                                        ?>
                            </small>
                        </h4>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->

                <!-- /.row -->

                <div class="row">

                    <!-- /.col -->
                    <div class="col-12">
                        <p class="lead">TIFFANY HWANG</p>


                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <p class="lead">รายการงานทั้งหมด</p>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>ชื่อรายการงาน</th>
                                    <th>วันที่ทำงาน</th>
                                    <th>เวลาเริ่มทำงาน</th>
                                    <th>เวลาสิ้นสุดการทำงาน</th>
                                    <th>ใช้เวลาทำงานทั้งหมด (นาที)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Call of Duty</td>
                                    <td>455-981-221</td>
                                    <td>El snort testosterone trophy driving gloves handsome</td>
                                    <td>$64.50</td>
                                    <td>$64.50</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Need for Speed IV</td>
                                    <td>247-925-726</td>
                                    <td>Wes Anderson umami biodiesel</td>
                                    <td>$50.00</td>
                                    <td>$64.50</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Monsters DVD</td>
                                    <td>735-845-642</td>
                                    <td>Terry Richardson helvetica tousled street art master</td>
                                    <td>$10.70</td>
                                    <td>$64.50</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Grown Ups Blue Ray</td>
                                    <td>422-568-642</td>
                                    <td>Tousled lomo letterpress</td>
                                    <td>$25.99</td>
                                    <td>$64.50</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                    <div class="table-responsive ">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width:50%">จำนวนงานทั้งหมดที่ดำเนินการ :</th>
                                    <td>X งาน</td>
                                </tr>
                                <tr>
                                    <th>เวลาเฉลี่ยในการทำงานต่อหนึ่งงาน</th>
                                    <td>X นาที</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-12">

                        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                            <i class="fa fa-download"></i> ดาวน์โหลดรายงาน
                        </button>
                    </div>
                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- footer -->
        <?php include_once('../includes/footer.php') ?>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- SlimScroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- DataTables -->
    <script src="https://adminlte.io/themes/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap4.min.js"></script>

    <script>
        $(function() {
            $('#dataTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": true
            });
        });

        function disableItem(id) {
            if (confirm('ยันยันการลบใช่หรือไม่') == true) {
                window.location = `disable.php?id=${id}`;
                // window.location='delete.php?id='+id;
            }
        };
    </script>

    <script>
        $(document).ready(function() {
            $('[data-toggle="popover"]').popover();
        });
    </script>


</body>

</html>