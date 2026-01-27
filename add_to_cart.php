<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: products.php');
    exit;
}

$product_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT stock FROM products WHERE id = ? AND status = 'active'");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    $_SESSION['error'] = "Ürün bulunamadı veya satışta değil.";
    header('Location: products.php');
    exit;
}

$product = $result->fetch_assoc();
if ($product['stock'] <= 0) {
    $_SESSION['error'] = "Bu ürün stokta yok.";
    header('Location: products.php');
    exit;
}

$stmt->close();

$check_stmt = $conn->prepare("SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ?");
$check_stmt->bind_param("ii", $user_id, $product_id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
    $cart_item = $check_result->fetch_assoc();
    $new_quantity = $cart_item['quantity'] + 1;

    if ($new_quantity > $product['stock']) {
        $_SESSION['error'] = "Stokta yeterli ürün yok.";
        header('Location: products.php');
        exit;
    }

    $update_stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
    $update_stmt->bind_param("ii", $new_quantity, $cart_item['id']);
    $update_stmt->execute();
    $update_stmt->close();
} else {
    $insert_stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity, created_at) VALUES (?, ?, 1, NOW())");
    $insert_stmt->bind_param("ii", $user_id, $product_id);
    $insert_stmt->execute();
    $insert_stmt->close();
}

$check_stmt->close();
$conn->close();

$_SESSION['success'] = "Ürün sepete eklendi!";
header('Location: products.php');
exit;
?>
