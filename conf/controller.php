<?php
    if(isset($_GET['pages'])){
        $page = $_GET['pages'];
        if($page == 'details'){
            echo $page;
        }
    }
?>