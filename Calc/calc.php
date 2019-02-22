<?php
$datenow=getdate();
$date=$_POST['date'];
$years=$_POST['years'];
$summ=$_POST['summ'];
$daysu=365;
$percent=0.1;
$daysn=date("d", strtotime($date));
$summadd=$_POST['summadd'];
if($_POST['replenishment']=='true'){
    if($summadd=$_POST['summadd']==''){$summadd=0;}else{$summadd=$_POST['summadd'];}
}
else{
    $summadd=0;
}
$res=$summ+($summ+$summadd)*$years*(0.1/365);
echo$summ;
?>