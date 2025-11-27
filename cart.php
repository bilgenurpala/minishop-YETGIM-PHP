<?php
$page_title = "Sepetim - MiniShop";
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT cart.id AS cart_id, products.name, products.price, products.image, cart.quantity
        FROM cart
        INNER JOIN products ON cart.product_id = products.id
        WHERE cart.user_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$total = 0;

require_once 'includes/header.php';
?>

<!-- Page Header -->
<div class="bg-light py-4 mb-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="index.php">Ana Sayfa</a></li>
                <li class="breadcrumb-item active">Sepetim</li>
            </ol>
        </nav>
        <h1 class="h2 fw-bold mt-2">
            <i class="bi bi-cart3"></i> Alışveriş Sepetim
        </h1>
    </div>
</div>

<!-- Cart Content -->
<section class="py-4 mb-5">
    <div class="container">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="bi bi-bag-check"></i> Sepetinizdeki Ürünler</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Ürün</th>
                                            <th>Fiyat</th>
                                            <th>Adet</th>
                                            <th>Toplam</th>
                                            <th class="text-center">İşlem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($result)):
                                            $subtotal = $row['price'] * $row['quantity'];
                                            $total += $subtotal;
                                        ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="assets/images/<?php echo htmlspecialchars($row['image'] ?: 'no-image.png'); ?>"
                                                             alt="<?php echo htmlspecialchars($row['name']); ?>"
                                                             class="rounded me-3"
                                                             style="width: 60px; height: 60px; object-fit: cover;">
                                                        <strong><?php echo htmlspecialchars($row['name']); ?></strong>
                                                    </div>
                                                </td>
                                                <td class="text-nowrap">
                                                    <span class="text-primary fw-bold">
                                                        <?php echo number_format($row['price'], 2, ',', '.'); ?> ₺
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary">
                                                        <?php echo (int)$row['quantity']; ?> adet
                                                    </span>
                                                </td>
                                                <td class="text-nowrap">
                                                    <strong class="text-success">
                                                        <?php echo number_format($subtotal, 2, ',', '.'); ?> ₺
                                                    </strong>
                                                </td>
                                                <td class="text-center">
                                                    <form method="POST" action="remove_from_cart.php" style="display: inline;">
                                                        <input type="hidden" name="cart_id" value="<?php echo (int)$row['cart_id']; ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bu ürünü sepetten çıkarmak istediğinize emin misiniz?')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-4">
                    <div class="card shadow-sm border-0 sticky-top" style="top: 100px;">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="bi bi-receipt"></i> Sipariş Özeti</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Ara Toplam:</span>
                                <strong><?php echo number_format($total, 2, ',', '.'); ?> ₺</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Kargo:</span>
                                <strong class="text-success">Ücretsiz</strong>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-3">
                                <strong>Toplam:</strong>
                                <strong class="text-success fs-4"><?php echo number_format($total, 2, ',', '.'); ?> ₺</strong>
                            </div>
                            <button class="btn btn-success btn-lg w-100 mb-2">
                                <i class="bi bi-credit-card"></i> Sipariş Ver
                            </button>
                            <a href="products.php" class="btn btn-outline-primary w-100">
                                <i class="bi bi-arrow-left"></i> Alışverişe Devam
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 text-center p-5">
                        <div class="mb-4">
                            <i class="bi bi-cart-x text-muted" style="font-size: 5rem;"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Sepetiniz Boş</h3>
                        <p class="text-muted mb-4">Henüz sepetinize ürün eklemediniz. Hemen alışverişe başlayın!</p>
                        <a href="products.php" class="btn btn-primary btn-lg">
                            <i class="bi bi-bag-plus"></i> Ürünleri Keşfet
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>
