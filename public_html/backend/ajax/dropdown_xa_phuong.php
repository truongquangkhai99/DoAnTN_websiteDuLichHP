<?php
$id=$_POST['x'];
$parms= require ('../../common/config/main-local.php');
$host = $parms['components']['db']['dsn'];
$hosts=explode(';',$host);
$ip_address=$hosts[0];
$servernames=explode('=',$ip_address);
$servername=$servernames[1];
$dbnames=$hosts[1];
$names=explode('=',$dbnames);
$dbname=$names[1];
$username = $parms['components']['db']['username'];
$password = $parms['components']['db']['password'];
$charset = $parms['components']['db']['charset'];
$conn= new mysqli($servername,$username,$password,$dbname);
$conn->set_charset($charset);
if($conn->connect_error){
    echo "lỗi kết nối";
}
else {
    $result="";
    $query="select * from xaphuong where QuanHuyen_id={$id} order by TenXaPhuong";
    $results=$conn->query($query);
    echo "<option value=''>Chọn quận huyện</option>";
    if ($results->num_rows > 0) {
        // output data of each row
        while($row = $results->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['TenXaPhuong']}</option>";
        }
    }
}