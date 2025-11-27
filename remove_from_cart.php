<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['cart_id'])) {
    header('Location: cart.php');
    exit;
}

$cart_id = intval($_POST['cart_id']);
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $cart_id, $user_id);

if ($stmt->execute()) {
    $_SESSION['success'] = "Ürün sepetten çıkarıldı.";
} else {
    $_SESSION['error'] = "Ürün silinirken bir hata oluştu.";
}

$stmt->close();
$conn->close();

header('Location: cart.php');
exit;
?>
