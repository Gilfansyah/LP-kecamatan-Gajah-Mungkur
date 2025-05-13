<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Anggota</title>
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
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama id_pegawai
    if (isset($_GET['id_pegawai'])) {
        $id_pegawai=input($_GET["id_pegawai"]);

        $sql="select * from pegawai where id_pegawai=$id_pegawai";
        $hasil=mysqli_query($conn,$sql);
        $data = mysqli_fetch_assoc($hasil);


    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_pegawai=htmlspecialchars($_POST["id_pegawai"]);
        $nama=input($_POST["nama"]);
        $jabatan=input($_POST["jabatan"]);
        $unit_kerja=input($_POST["unit_kerja"]);
        $opd=input($_POST["opd"]);
        $status=input($_POST["status"]);

        //Query update data pada tabel anggota
        $sql="update pegawai set
			nama='$nama',
			jabatan='$jabatan',
			unit_kerja='$unit_kerja',
			opd='$opd',
			status='$status'
			where id_pegawai=$id_pegawai";

        //Mengeksekusi atau menjalankan query diatas
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
    <h2>Update Data</h2>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required />

        </div>
        <div class="form-group">
            <label>Jabatan:</label>
            <input type="text" name="jabatan" class="form-control" placeholder="Masukan Nama Jabatan" required/>
        </div>
        <div class="form-group">
            <label>Unit_Kerja :</label>
            <input type="text" name="unit_kerja" class="form-control" placeholder="Masukan Unit_Kerja" required/>
        </div>
        <div class="form-group">
            <label>Opd:</label>
            <input type="text" name="opd" class="form-control" placeholder="Masukan Opd" required/>
        </div>
        <div class="form-group">
            <label>status:</label>
            <textarea name="status" class="form-control" rows="5"placeholder="Masukan Status" required></textarea>
        </div>

        <input type="hidden" name="id_pegawai" value="<?php echo $data['id_pegawai']; ?>" />

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>