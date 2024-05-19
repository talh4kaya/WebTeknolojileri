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

$message = "";

// Form verilerini al
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isim = isset($_POST['kullanıcıAdı']) ? $conn->real_escape_string($_POST['kullanıcıAdı']) : '';
    $email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';
    $sifre = isset($_POST['sifre']) ? $conn->real_escape_string($_POST['sifre']) : '';

    // SQL sorgusuyla veritabanında kullanıcıyı kontrol et
    $sql = "SELECT * FROM $table WHERE KullanıcıAdı='$isim' AND Email='$email' AND Şifre='$sifre'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Kullanıcı bilgileri doğruysa
         // Başka bir sayfaya yönlendirme
         echo "<div class='container'><h3>Giriş Başarılı Hoşgeldiniz!</h3></div>";
    
         // 5 saniye sonra yönlendirme yapacak JavaScript kodu
         echo "<script>
                 setTimeout(function() {
                     window.location.href = 'http://127.0.0.1:5500/giri%C5%9F.html';
                 }, 5000);
               </script>";
     
         // Kodun devam etmemesi için
         exit();
    } 
    else {
        // Başka bir sayfaya yönlendirme
        echo "<div class='container'><h3>GİRİŞ BAŞARISIZ. SAYFAYA YÖNLENDİRİLİYORSUNUZ!</h3></div>";
    
        // 5 saniye sonra yönlendirme yapacak JavaScript kodu
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'http://127.0.0.1:5500/giri%C5%9F.html';
                }, 5000);
              </script>";
    
        // Kodun devam etmemesi için
        exit();
    }
    
}
?>

