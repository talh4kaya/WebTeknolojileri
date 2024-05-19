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
        <h2 class="mb-3 font-weight-bold" id="iletisimkontrolbaslik">FORUM KONTROL</h2>
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
            <td id="basliklar">İsminiz</td>
            <td id="basliklar">
                <?php echo isset($_POST['name']) ? $_POST['name'] : "Veri alınamadı."; ?>
            </td>
        </tr>
        <tr>
            <td id="basliklar">E-Mail</td>
            <td id="basliklar">
                <?php echo isset($_POST['email']) ? $_POST['email'] : "Veri alınamadı."; ?>
            </td>
        </tr>
        <tr>
            <td id="basliklar">Mesaj</td>
            <td id="basliklar">
                <?php echo isset($_POST['message']) ? $_POST['message'] : "Veri alınamadı."; ?>
            </td>
        </tr>
        <tr>
            <td id="basliklar">Cinsiyet</td>
            <td id="basliklar">
                <?php echo isset($_POST['gender']) ? $_POST['gender'] : "Veri alınamadı."; ?>
            </td>
        </tr>
    </tbody>
</table>

<?php
$servername = "localhost"; // MySQL sunucu adı
$username = "root"; // MySQL kullanıcı adı (varsayılan olarak root)
$password = ""; // MySQL şifre (varsayılan olarak boş)
$database = "forum"; // Kullanılacak veritabanı adı
$table = "forum"; // Kullanılacak tablo adı

// Veritabanı bağlantısı
$conn = new mysqli($servername, $username, $password, $database);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// Form verilerini al
$isim = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$telefon = isset($_POST['message']) ? $_POST['message'] : '';
$mesaj = isset($_POST['gender']) ? $_POST['gender'] : '';

// SQL sorgusuyla veritabanına ekle
$sql = "INSERT INTO forum (İsim, Email, Mesaj, Cinsiyet) VALUES ('$isim', '$email', '$telefon', '$mesaj')";

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
    echo "<tr><th>İsim</th><th>E-Mail</th><th>Telefon</th><th>Mesaj</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["İsim"]."</td><td>".$row["Email"]."</td><td>".$row["Mesaj"]."</td><td>".$row["Cinsiyet"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "Veritabanında herhangi bir kayıt bulunamadı.";
}
$conn->close();
?>
</body>
</html>