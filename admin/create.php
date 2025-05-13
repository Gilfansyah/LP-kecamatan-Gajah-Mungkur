<!DOCTYPE html>
<html>
<head>
    <title>Input Pegawai</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php
    //Include file koneksi, untuk koneksikan ke database
    include "db.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nama=input($_POST["nama"]);
        $jabatan=input($_POST["jabatan"]);
        $unit_kerja=input($_POST["unit_kerja"]);
        $opd=input($_POST["opd"]);
        $status=input($_POST["status"]);

        //Query input menginput data kedalam tabel anggota
        $sql="insert into pegawai (nama,jabatan,unit_kerja,opd,status) values
		('$nama','$jabatan','$unit_kerja','$opd','$status')";

        //Mengeksekusi/menjalankan query diatas
        $hasil=mysqli_query($conn,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:dashboard.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }
    ?>
    <h2>Input Data</h2>


    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required />

        </div>
        <div class="form-group">
            <label>Jabatan:</label>
            <input type="text" name="jabatan" class="form-control" placeholder="Masukan Jabatan" required/>
        </div>
       <div class="form-group">
            <label>Unit Kerja :</label>
            <input type="text" name="unit_kerja" class="form-control" placeholder="Masukan Unit_Kerja" required/>
        </div>
                </p>
        <div class="form-group">
            <label>OPD:</label>
            <input type="text" name="opd" class="form-control" placeholder="Masukan Opd" required/>
        </div>
        <div class="form-group">
            <label>Status:</label>
            <textarea name="status" class="form-control" rows="5"placeholder="Masukan Status" required></textarea>
        </div>       

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>