<?php
$connect = mysqli_connect("localhost", "root", "", "beutiful");

if($connect){
    mysqli_query($connect, "SET NAMES 'UTF8'");
    // echo 'Kết nối thành công';

}else{
    echo 'Kết nối thất bại';
}
?>