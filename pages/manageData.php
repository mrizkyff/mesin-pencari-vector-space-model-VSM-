<?php
    $koneksi = mysqli_connect("localhost","root","","tasearchengine");
?>
<div class="content-wrapper">
    <table border="1" class="table table-bordered" width="80%">
        <tr>
            <td align="center">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahData">
                <i class="nav-icon fas fa-plus-square"></i>
            </button>
            </td>
            <td colspan="7" align="center"><h4>Kelola Database</h4></td>
        </tr>
        <tr>
            <td width="100px">ID Dokumen</td>
            <td>Penulis</td>
            <td width="100px">Tahun</td>
            <td>Judul</td>
            <td>Abstrak</td>
            <td>File</td>
            <td colspan="2" align="center">Action</td>
        </tr>
        <?php
        $query = "SELECT * FROM daftarta ORDER BY bobot DESC";
        $sql = mysqli_query($koneksi, $query);
        while($data = mysqli_fetch_array($sql)){
            ?>
        <tr>
            <td><?php echo $data['id']?></td>
            <td><?php echo $data['penulis']?></td>
            <td><?php echo $data['tahun']?></td>
            <td><?php echo $data['judul']?></td>
            <!-- proses abstrak -->
            <?php 
                $len = strlen($data['abstrak']);
                $abstrak = $data['abstrak'];
                if($len<100){
                    $len = $len;
                }
                else if ($len <= 100){
                    $len = $len/2;
                }
                else if($len >100 && $len<=300){
                    $len = $len/4;
                }
                else{
                    $len = $len/6;
                }
                $abstrak = substr($abstrak,0,$len)
                // $abstrak = substr($data['abstrak'],0, $len/3)
                // $abstrak = $abstrak + "..."
            ?>
            <!-- end proses abstrak -->
            <td><?php echo $abstrak?><a href="details.php?showid=<?php echo $data['id']?>">...[Lanjutkan Membaca]</a></td>
            <td align="center" width="100px"><a style="padding-right: 40px; padding-left: 40px;" class="btn btn-success" href="file/<?php echo $data['file']?>"><i class="nav-icon fas fa-download"></i></a></td>
            <td align="center" width="100px"><button class="btn btn-primary" data-toggle="modal" data-target='#editData<?php echo $data['id']?>'> <i class="nav-icon fas fa-magic"></i></button></td>
            <td align="center" width="100px"><a href="hapus.php?action=hapus&id=<?php echo $data['id']?>" class="btn btn-danger" align="center" ><i class="nav-icon fas fa-minus"></i></a></td>
                <!-- Modal -->
                <div class="modal fade" id="editData<?php echo $data['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="penulis">Penulis</label>
                                <input type="text" name="penulis" placeholder="Penulis" class="form-control" value="<?php echo $data['penulis'] ?>">
                                <input type="hidden" name="id" value="<?php echo $data['id']?>">
                            </div>
                            <div class="form-group">
                                <label for="tahun">Tahun</label>
                                <input type="text" name="tahun" placeholder="Tahun" class="form-control" value="<?php echo $data['tahun'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" name="judul" placeholder="Judul" class="form-control" value="<?php echo $data['judul'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="abstrak">Abstrak</label>
                                <textarea name="abstrak" id="" cols="20" rows="10" placeholder="Abstrak" class="form-control"><?php echo $data['abstrak'] ?></textarea>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" name="update" value="Simpan" class="btn btn-primary">
                    </div>
                    </form>
                    </div>
                </div>
                </div>

        </tr>
            <?php
        }
        ?>
    </table>
    
</div>

<!-- Modal -->
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="penulis">Penulis</label>
                <input type="text" name="penulis" placeholder="Penulis" class="form-control">
            </div>
            <div class="form-group">
                <label for="tahun">Tahun</label>
                <input type="text" name="tahun" placeholder="Tahun" class="form-control">
            </div>
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" name="judul" placeholder="Judul" class="form-control">
            </div>
            <div class="form-group">
                <label for="abstrak">Abstrak</label>
                <textarea name="abstrak" id="" cols="20" rows="10" placeholder="Abstrak" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="file">File (PDF) :</label>
                <input type="file" name="file">
            </div>

        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" name="upload" value="Simpan" class="btn btn-primary">
      </div>
      </form>
    </div>
  </div>
</div>

<?php
    if(isset($_POST['upload'])){
        $penulis = $_POST['penulis'];
        $tahun = $_POST['tahun'];
        $judul = $_POST['judul'];
        $abstrak = $_POST['abstrak'];
        $nol = 0;

        $ekstensi_diperbolehkan = array('pdf');
        $nama = $_FILES['file']['name'];
        $x = explode('.',$nama);
        $ekstensi = strtolower(end($x));
        $ukuran = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $tujuan = "file/";

        if(in_array($ekstensi, $ekstensi_diperbolehkan) == true){
            if($ukuran < 10440700){
                move_uploaded_file($file_tmp, $tujuan.$nama);
                $query = mysqli_query($koneksi,"INSERT INTO daftarta VALUES('','$penulis','$tahun','$judul','$abstrak','$nama','$nol')");
                if($query){
                    // header("location: index.php?page=manageData");
                    echo 'berhasil ditambahkan';
                }
                else{
                    echo 'Gagal upload gambar';
                }
            }
            else{
                echo 'Ukuran file terlalu besar';
            }
        }
        else{
            echo 'ekstensi file tidak diizinkan';
        }
    }

    if(isset($_POST['update'])){
        $penulis = $_POST['penulis'];
        $tahun = $_POST['tahun'];
        $judul = $_POST['judul'];
        $abstrak = $_POST['abstrak'];
        $id = $_POST['id'];
        $query = mysqli_query($koneksi, "UPDATE daftarta SET penulis='$penulis', tahun='$tahun', judul='$judul', abstrak='$abstrak' WHERE id = $id");
        if($query){
            header("location: page/page.php?page=manageData");
        }
    }
?>