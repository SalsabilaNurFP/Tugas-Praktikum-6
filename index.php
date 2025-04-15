<!-- Tugas 6 - Salsabila Nur FP -->

<?php

$bandara_asal = [
    "Soekarno Hatta" => 65000,
    "Husein Sastranegara" => 50000,
    "Abdul Rachman Saleh" => 40000,
    "Juanda" => 30000,
];

$bandara_tujuan = [
    "Ngurah Rai" => 85000,
    "Hasanuddin" => 70000,
    "Inanwatan" => 90000,
    "Sultan Iskandar Muda" => 60000,
];

ksort($bandara_asal);
ksort($bandara_tujuan);

$has_output = false;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $nama_maskapai = $_POST['maskapai'];
    $asal = $_POST['asal'];
    $tujuan = $_POST['tujuan'];
    $harga_tiket = (int)$_POST['harga'];

    $pajak_asal = $bandara_asal[$asal];
    $pajak_tujuan = $bandara_tujuan[$tujuan];
    $pajak_total = $pajak_asal + $pajak_tujuan;

    $total_harga = $harga_tiket + $pajak_total;
    $nomor = rand(1000, 9999);
    $tanggal = date("d-m-Y");

    $has_output = true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tugas 6 - Salsabila</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #ebbac2;
            padding: 40px;
            color: #333;
        }
        h2 {
            text-align: center;
            color: #2c3e50;
        }
        form {
            background: #fff;
            max-width: 500px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }
        input[type="submit"], button {
            margin-top: 20px;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            background-color:rgb(52, 219, 66);
            color: white;
            cursor: pointer;
            font-weight: bold;
            margin-right: 10px;
        }
        button {
            background-color: #e74c3c;
        }
        input[type="submit"]:hover, button:hover {
            opacity: 0.9;
        }
        #output {
            background: #ccd1db;
            max-width: 500px;
            margin: 30px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        #output p {
            margin: 8px 0;
        }
    </style>
    <script>
        function clearForm() {
            document.getElementById("formPenerbangan").reset();
            document.getElementById("output").style.display = "none";
        }
    </script>
</head>
<body>
    <h2>PENDAFTARAN RUTE PENERBANGAN</h2>
    <form method="POST" id="formPenerbangan">
        <label>Nama Maskapai:</label>
        <input type="text" name="maskapai" required>

        <label>Bandara Asal:</label>
        <select name="asal" required>
            <?php foreach ($bandara_asal as $nama => $pajak): ?>
                <option value="<?= $nama ?>"><?= $nama ?></option>
            <?php endforeach; ?>
        </select>

        <label>Bandara Tujuan:</label>
        <select name="tujuan" required>
            <?php foreach ($bandara_tujuan as $nama => $pajak): ?>
                <option value="<?= $nama ?>"><?= $nama ?></option>
            <?php endforeach; ?>
        </select>

        <label>Harga Tiket (tanpa pajak):</label>
        <input type="number" name="harga" required>

        <input type="submit" name="submit" value="Submit">
        <button type="button" onclick="clearForm()">Clear</button>
    </form>

    <?php if ($has_output): ?>
    <div id="output">
        <h3>Data Tiket:</h3>
        <p><strong>Nomor:</strong> <?= $nomor ?></p>
        <p><strong>Tanggal:</strong> <?= $tanggal ?></p>
        <p><strong>Nama Maskapai:</strong> <?= $nama_maskapai ?></p>
        <p><strong>Asal Penerbangan:</strong> <?= $asal ?></p>
        <p><strong>Tujuan Penerbangan:</strong> <?= $tujuan ?></p>
        <p><strong>Harga Tiket:</strong> Rp <?= number_format($harga_tiket, 0, ',', '.') ?></p>
        <p><strong>Pajak:</strong> Rp <?= number_format($pajak_total, 0, ',', '.') ?></p>
        <p><strong>Total Harga Tiket:</strong> Rp <?= number_format($total_harga, 0, ',', '.') ?></p>
    </div>
    <script>
    
        document.getElementById("output").style.display = "block";
    </script>
    <?php endif; ?>
</body>
</html>