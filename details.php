<title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<?php
    $showid = $_GET['showid'];

    $koneksi = mysqli_connect("localhost","root",'','tasearchengine');
    $query = "SELECT * FROM daftarta where id='$showid'";
    $sql = mysqli_query($koneksi,$query);
    while($data = mysqli_fetch_array($sql)){
        ?>
        <center>
        <div class="container" style="top:100px;">
        <table frame=box>
            <tr height=30>
                <td width=200px rowspan="2" valign='top' style="margin:30px">
                    <?php                
                        ?>
                            <h4>Id : <?php echo ''?> </h4>
                            <h4>Penulis : <?php echo ''?> </h4>
                            <h4>Tahun : <?php echo ''?> </h4>
                        <?php
                    ?>
                </td>
                <td width=800px>
                    <?php
                        ?>
                            <h4><?php echo $data['judul'] ?></h4>
                        <?php
                    ?>
                </td>
            </tr>
            
            <tr height='auto'>
                <td width=100 valign='top' style="justify-content:center;">
                    <h4><?php echo $data['abstrak']?></h4>
                </td>
            </tr>
            <tr height=30>
                <td>
                </td>
                <td align="right" width="100px"><a style="padding-right: 40px; padding-left: 40px;" class="btn btn-success" href="file/<?php echo $data['file']?>">Download</a></td>
            </tr>
        </table>
        </div>
        </center>
        <?php
    }
    ?>
