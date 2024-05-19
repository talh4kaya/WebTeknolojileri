<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İletişim Kontrol</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="app.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<section class="p-5 text-center">
    <div class="container">
        <h2 class="mb-3 font-weight-bold" id="iletisimkontrolbaslik">Kullanıcı Kayıtları</h2>
        <i class="fas fa-code" id="iconn"></i>
        <hr class="cizgi">
    </div>
</section>
<br><br>

<table class="table">
    <thead class="table">
        <tr>
            <th colspan="5" id="basliklar">
                <h3>GELEN BİLGİLER</h3>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td id="basliklar">Kullanıcı Adı:</td>
            <td id="basliklar">
                <?php echo isset($_POST['kullanıcıAdı']) ? htmlspecialchars($_POST['kullanıcıAdı']) : "Veri alınamadı."; ?>
            </td>
        </tr>
        <tr>
            <td id="basliklar">E-Mail</td>
            <td id="basliklar">
                <?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "Veri alınamadı."; ?>
            </td>
        </tr>
        <tr>
            <td id="basliklar">Şifre</td>
            <td id="basliklar">
                <?php echo isset($_POST['sifre']) ? htmlspecialchars($_POST['sifre']) : "Veri alınamadı."; ?>
            </td>
        </tr>
    </tbody>
</table>

<?php
$servername = "localhost"; // MySQL sunucu adı
$username = "root"; // MySQL kullanıcı adı (varsayılan olarak root)
$password = ""; // MySQL şifre (varsayılan olarak boş)
$database = "girişvekayıt"; // Kullanılacak veritabanı adı
$table = "girişvekayıt"; // Kullanılacak tablo adı

// Veritabanı bağlantısı
$conn = new mysqli($servername, $username, $password, $database);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Form verilerini al
$isim = isset($_POST['kullanıcıAdı']) ? $conn->real_escape_string($_POST['kullanıcıAdı']) : '';
$email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';
$sifre = isset($_POST['sifre']) ? $conn->real_escape_string($_POST['sifre']) : '';

// SQL sorgusuyla veritabanına ekle
$sql = "INSERT INTO $table (KullanıcıAdı, Email, Şifre) VALUES ('$isim', '$email', '$sifre')";

if ($conn->query($sql) === TRUE) {
    echo "Yeni kayıt oluşturuldu.";
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

$sql = "SELECT * FROM $table";
$result = $conn->query($sql);

// Veritabanından gelen kayıtları tablo olarak göster
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>İsim</th><th>E-Mail</th><th>Şifre</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["KullanıcıAdı"]."</td><td>".$row["Email"]."</td><td>".$row["Şifre"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "Veritabanında herhangi bir kayıt bulunamadı.";
}
$conn->close();
?>
</body>
</html>
