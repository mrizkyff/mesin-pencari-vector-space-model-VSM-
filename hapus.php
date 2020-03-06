<?php
$koneksi = mysqli_connect("localhost","root","","tasearchengine");

if(isset($_GET['action'])){
    if ($_GET['action'] == 'hapus'){
        $id = $_GET['id'];
        $query = mysqli_query($koneksi, "DELETE FROM daftarta where id = '$id'");
        if($query){
            header("location: index.php?page=manageData");
        }
        else{
            echo 'haus gagal';
        }
    }
}
?>