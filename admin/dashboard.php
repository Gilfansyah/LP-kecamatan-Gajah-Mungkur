<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
    }
    body {
     height: 100vh;
      background: url('img/smg.jpg') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: flex-start;
    }
    .sidebar {
      width: 220px;
      background: #2c3e50;
      color: white;
      padding: 20px;
      height: 100vh;
      position: left;
    }
    .sidebar h2 {
      font-size: 22px;
      margin-bottom: 30px;
    }
    .sidebar a {
      color: #ecf0f1;
      text-decoration: none;
      display: block;
      margin-bottom: 15px;
      font-size: 16px;
    }
    .sidebar a:hover {
      color: #3498db;
    }
    .main-content {
      margin-left: 240px;
      padding: 20px;
      width: 100%;
    }
    table {
      border-collapse: collapse;
      width: 100%;
      background: white;
      margin-bottom: 40px;
      
    }
    th, td {
      padding: 10px;
      border: 1px solid #ccc;
      text-align: left;
    }
    th {
      background-color: #3498db;
      color: white;
    }
    h4 {
     
  font-family: 'Montserrat', sans-serif;
  font-size: 20px;
  font-weight: 700;
  color: #2c3e50;
}

    
    button {
      padding: 8px 16px;
      background: #3498db;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover {
      background: #2980b9;
    }
   
  </style>
</head>
<body>
  <div class="sidebar">
    <h2>Admin Panel</h2>
    
    <a href="dashboard.php">📊 Dashboard</a>
    <a href="logout.php">🚪 Logout</a>
  </div>

  <div class="main-content">
    <h4>DAFTAR PEGAWAI ASN/NON-ASN</h4>

    <?php
      include "db.php";

      if (isset($_GET['id_pegawai'])) {
          $id_pegawai = htmlspecialchars($_GET["id_pegawai"]);
          $sql = "DELETE FROM pegawai WHERE id_pegawai='$id_pegawai'";
          $hasil = mysqli_query($conn, $sql);

          if ($hasil) {
              header("Location: dashboard.php");
              exit;
          } else {
              echo "<div class='alert alert-danger'>Data Gagal dihapus.</div>";
          }
      }
    ?>

    <table class="my-3 table table-bordered">
      <thead class="table-primary">
        <tr>
          <th>id_pegawai</th>
          <th>nama</th>
          <th>jabatan</th>
          <th>unit_kerja</th>
          <th>opd</th>
          <th>status</th>
          <th colspan="2">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
          include "db.php";
          $sql = "SELECT * FROM pegawai ORDER BY id_pegawai DESC";
          $hasil = mysqli_query($conn, $sql);
          while ($data = mysqli_fetch_array($hasil)) {
        ?>
        <tr>
          <td><?= $data["id_pegawai"]; ?></td>
          <td><?= $data["nama"]; ?></td>
          <td><?= $data["jabatan"]; ?></td>
          <td><?= $data["unit_kerja"]; ?></td>
          <td><?= $data["opd"]; ?></td>
          <td><?= $data["status"]; ?></td>
          <td>
            <a href="update.php?id_pegawai=<?= htmlspecialchars($data['id_pegawai']); ?>" class="btn btn-warning">Update</a>
            <a href="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id_pegawai=<?= $data['id_pegawai']; ?>" class="btn btn-danger">Delete</a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

    <a href="create.php" class="btn btn-primary">Tambah Data</a>
  </div>
</body>
</html>
