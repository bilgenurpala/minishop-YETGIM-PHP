<?php
$page_title = "Admin Paneli - MiniShop";
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
    exit();
}

require_once 'includes/db.php';

$message = "";
$error = "";

if (isset($_SESSION['success'])) {
    $message = $_SESSION['success'];
    unset($_SESSION['success']);
}
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);
    $status = 'active';
    $image = 'no-image.png';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $filename = $_FILES['image']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed)) {
            $new_filename = uniqid() . '.' . $ext;
            $target = "assets/images/" . $new_filename;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $image = $new_filename;
            }
        } else {
            $error = "Sadece JPG, PNG, GIF ve WEBP formatları kabul edilir.";
        }
    }

    if (empty($error)) {
        $stmt = $conn->prepare("INSERT INTO products (name, description, price, stock, image, status, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssdiss", $name, $description, $price, $stock, $image, $status);

        if ($stmt->execute()) {
            $message = "Ürün başarıyla eklendi!";
        } else {
            $error = "Ürün eklenirken bir hata oluştu.";
        }

        $stmt->close();
    }
}

$sql = "SELECT * FROM products ORDER BY created_at DESC";
$products_result = $conn->query($sql);

require_once 'includes/header.php';
?>

<!-- Modern Admin Header with Gradient -->
<section class="position-relative overflow-hidden" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 80px 0;">
    <!-- Animated Background -->
    <div class="position-absolute w-100 h-100" style="top: 0; left: 0; opacity: 0.1;">
        <div class="position-absolute" style="width: 300px; height: 300px; background: white; border-radius: 50%; top: -100px; right: 15%; animation: float 8s ease-in-out infinite;"></div>
        <div class="position-absolute" style="width: 200px; height: 200px; background: white; border-radius: 50%; bottom: -50px; left: 10%; animation: float 6s ease-in-out infinite reverse;"></div>
    </div>

    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="badge bg-white bg-opacity-25 text-white px-4 py-2 rounded-pill mb-3">
                    <i class="bi bi-shield-check"></i> Yönetici Paneli
                </div>
                <h1 class="display-4 fw-bold text-white mb-3">
                    <i class="bi bi-speedometer2"></i> Admin Dashboard
                </h1>
                <p class="lead text-white opacity-90 mb-0">
                    Ürünlerinizi ekleyin, düzenleyin ve yönetin
                </p>
            </div>
            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                <div class="bg-white rounded-4 p-4 shadow-lg">
                    <div>
                        <h3 class="fw-bold mb-1 text-gradient" style="font-size: 2.5rem;"><?php echo $products_result ? $products_result->num_rows : 0; ?></h3>
                        <small class="text-muted fw-semibold">Toplam Ürün</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Admin Content with Modern Cards -->
<section class="py-5" style="background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%); margin-top: -40px;">
    <div class="container">
        <div class="row g-4">
            <!-- Add Product Form -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-lg" style="border-radius: 24px; overflow: hidden;">
                    <div class="card-header border-0 text-white position-relative" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 1.5rem;">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-plus-circle-fill me-2"></i> Yeni Ürün Ekle
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <?php if (!empty($message)): ?>
                            <div class="alert alert-success alert-dismissible fade show">
                                <i class="bi bi-check-circle"></i> <?php echo htmlspecialchars($message); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <i class="bi bi-exclamation-triangle"></i> <?php echo htmlspecialchars($error); ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form action="admin.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bi bi-tag text-primary me-1"></i> Ürün Adı
                                </label>
                                <input type="text" name="name" class="form-control form-control-lg" placeholder="Ürün adını girin" required style="border-radius: 12px;">
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bi bi-file-text text-primary me-1"></i> Açıklama
                                </label>
                                <textarea name="description" class="form-control" rows="4" placeholder="Ürün açıklaması" required style="border-radius: 12px;"></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-semibold text-dark">
                                        <i class="bi bi-currency-exchange text-primary me-1"></i> Fiyat (₺)
                                    </label>
                                    <input type="number" name="price" class="form-control form-control-lg" step="0.01" min="0" placeholder="0.00" required style="border-radius: 12px;">
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-semibold text-dark">
                                        <i class="bi bi-box-seam text-primary me-1"></i> Stok
                                    </label>
                                    <input type="number" name="stock" class="form-control form-control-lg" min="0" placeholder="0" required style="border-radius: 12px;">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bi bi-image text-primary me-1"></i> Ürün Görseli
                                </label>
                                <input type="file" name="image" class="form-control form-control-lg" accept="image/*" style="border-radius: 12px;">
                                <small class="text-muted d-block mt-2">
                                    <i class="bi bi-info-circle"></i> JPG, PNG, GIF veya WEBP formatında olmalıdır
                                </small>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm" style="border-radius: 12px; padding: 0.9rem;">
                                <i class="bi bi-plus-lg me-2"></i> Ürünü Ekle
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Products List -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-lg" style="border-radius: 24px; overflow: hidden;">
                    <div class="card-header border-0 text-white position-relative" style="background: linear-gradient(135deg, #0ba360 0%, #3cba92 100%); padding: 1.5rem;">
                        <h5 class="mb-0 fw-bold">
                            <i class="bi bi-list-check me-2"></i> Tüm Ürünler
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <?php if ($products_result && $products_result->num_rows > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.08) 0%, rgba(118, 75, 162, 0.08) 100%);">
                                        <tr>
                                            <th class="px-4 py-3 fw-bold" style="border: none;">Görsel</th>
                                            <th class="py-3 fw-bold" style="border: none;">Ürün</th>
                                            <th class="py-3 fw-bold" style="border: none;">Fiyat</th>
                                            <th class="py-3 fw-bold" style="border: none;">Stok</th>
                                            <th class="py-3 fw-bold" style="border: none;">Durum</th>
                                            <th class="py-3 fw-bold text-center" style="border: none;">İşlemler</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($product = $products_result->fetch_assoc()): ?>
                                            <tr style="transition: all 0.3s ease;">
                                                <td class="px-4 py-3">
                                                    <img src="assets/images/<?php echo htmlspecialchars($product['image']); ?>"
                                                         alt="<?php echo htmlspecialchars($product['name']); ?>"
                                                         class="rounded-3 shadow-sm"
                                                         style="width: 60px; height: 60px; object-fit: cover;">
                                                </td>
                                                <td class="py-3">
                                                    <div>
                                                        <strong class="d-block mb-1"><?php echo htmlspecialchars($product['name']); ?></strong>
                                                        <small class="text-muted">
                                                            <?php
                                                            $desc = htmlspecialchars($product['description']);
                                                            echo strlen($desc) > 40 ? substr($desc, 0, 40) . '...' : $desc;
                                                            ?>
                                                        </small>
                                                    </div>
                                                </td>
                                                <td class="py-3 text-nowrap">
                                                    <strong class="text-gradient" style="font-size: 1.1rem;">
                                                        <?php echo number_format($product['price'], 2, ',', '.'); ?> ₺
                                                    </strong>
                                                </td>
                                                <td class="py-3">
                                                    <?php if ($product['stock'] > 10): ?>
                                                        <span class="badge bg-success" style="border-radius: 10px; padding: 0.5rem 0.75rem;">
                                                            <i class="bi bi-check-circle me-1"></i><?php echo $product['stock']; ?>
                                                        </span>
                                                    <?php elseif ($product['stock'] > 0): ?>
                                                        <span class="badge bg-warning text-dark" style="border-radius: 10px; padding: 0.5rem 0.75rem;">
                                                            <i class="bi bi-exclamation-circle me-1"></i><?php echo $product['stock']; ?>
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge bg-danger" style="border-radius: 10px; padding: 0.5rem 0.75rem;">
                                                            <i class="bi bi-x-circle me-1"></i>Tükendi
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="py-3">
                                                    <?php if ($product['status'] == 'active'): ?>
                                                        <span class="badge bg-success" style="border-radius: 10px; padding: 0.5rem 0.75rem;">
                                                            <i class="bi bi-check-lg me-1"></i>Aktif
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge bg-secondary" style="border-radius: 10px; padding: 0.5rem 0.75rem;">
                                                            <i class="bi bi-dash-circle me-1"></i>Pasif
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="py-3 text-center">
                                                    <div class="btn-group shadow-sm" role="group">
                                                        <a href="edit_product.php?id=<?php echo $product['id']; ?>"
                                                           class="btn btn-sm btn-warning"
                                                           title="Düzenle"
                                                           style="border-radius: 10px 0 0 10px; padding: 0.4rem 0.8rem;">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                        <a href="delete_product.php?id=<?php echo $product['id']; ?>"
                                                           class="btn btn-sm btn-danger"
                                                           title="Sil"
                                                           style="border-radius: 0 10px 10px 0; padding: 0.4rem 0.8rem;"
                                                           onclick="return confirm('Bu ürünü silmek istediğinizden emin misiniz?')">
                                                            <i class="bi bi-trash3"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="p-5 text-center" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);">
                                <div class="mb-4">
                                    <i class="bi bi-inbox text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                                </div>
                                <h5 class="fw-bold mb-2">Henüz Ürün Yok</h5>
                                <p class="text-muted mb-0">Soldaki formdan yeni ürünler ekleyebilirsiniz</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$conn->close();
require_once 'includes/footer.php';
?>
