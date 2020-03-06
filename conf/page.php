<?php
  
if(isset($_GET['page'])){
  $page = $_GET['page'];
switch ($page) {
    case 'manageData':
        include 'pages/manageData.php';
        break;
    case 'cariData';
        include 'pages/formCari.php';
        break;
  }
}
else{
    include "pages/home.php";
  }
?>