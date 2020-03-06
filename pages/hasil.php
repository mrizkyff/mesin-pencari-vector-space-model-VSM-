<?php
    $koneksi = mysqli_connect("localhost","root","","tasearchengine");
?>
    <table border="1" class="table table-bordered">
        <tr>
            <td width="100px">ID Dokumen</td>
            <td>Penulis</td>
            <td>Tahun</td>
            <td>Judul</td>
            <td>Abstrak</td>
            <td width="100px">File</td>
            <td width="100px">Similarity</td>
        </tr>
        <?php
        $query = "SELECT * FROM daftarta ORDER BY bobot DESC";
        $sql = mysqli_query($koneksi, $query);
        while($data = mysqli_fetch_array($sql)){
            ?>
        <tr>
            <?php
                $persen = 0;
                $persen = $data['bobot'];
                $persen = round($persen,4);
                $persen = $persen*100;
            ?>
            <td><?php echo $data['id']?></td>
            <td><?php echo $data['penulis']?></td>
            <td><?php echo $data['tahun']?></td>
            <td><?php echo $data['judul']?></td>
            <td><?php echo $data['abstrak']?></td>
            <td><a style="padding-right: 40px; padding-left:40px" class="btn btn-success" href="file/<?php echo $data['file']?>"><i class="nav-icon fas fa-download"></i></a></td>
            <td><?php echo $persen?>%</td>
        </tr>
            <?php
        }
        ?>
    </table>
