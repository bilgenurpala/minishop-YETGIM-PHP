<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
    exit();
}

require_once 'includes/db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: admin.php");
    exit();
}

$product_id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();

    $delete_stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $delete_stmt->bind_param("i", $product_id);

    if ($delete_stmt->execute()) {
        if ($product['image'] != 'no-image.png' && file_exists("assets/images/" . $product['image'])) {
        }

        $_SESSION['success'] = "Ürün başarıyla silindi!";
    } else {
        $_SESSION['error'] = "Ürün silinirken bir hata oluştu.";
    }

    $delete_stmt->close();
} else {
    $_SESSION['error'] = "Ürün bulunamadı.";
}

$stmt->close();
$conn->close();

header("Location: admin.php");
exit();
?>
