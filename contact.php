<?php
header('Content-Type: application/json'); // JSON yanıtı için başlık

// Form verilerini al
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

// Basit doğrulama
if (empty($name) || empty($email) || empty($message)) {
  echo json_encode(['success' => false, 'message' => 'Lütfen tüm alanları doldurun.']);
  exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo json_encode(['success' => false, 'message' => 'Geçerli bir e-posta adresi girin.']);
  exit;
}

// E-posta gönderimi (örnek olarak - bunu kendi e-posta ayarlarınıza göre yapılandırın)
$to = 'info@iknowacademy.com'; // Hedef e-posta adresi
$subject = 'Yeni İletişim Formu Mesajı';
$body = "Ad: $name\nE-Posta: $email\nMesaj: $message";
$headers = "From: $email\r\n";

if (mail($to, $subject, $body, $headers)) {
  echo json_encode(['success' => true, 'message' => 'Mesajınız başarıyla gönderildi!']);
} else {
  echo json_encode(['success' => false, 'message' => 'Mesaj gönderilirken bir hata oluştu.']);
}
?>