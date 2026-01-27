<?php
$page_title = "Ürün Düzenle - MiniShop";
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] != 1) {
    header("Location: login.php");
    exit();
}

require_once 'includes/db.php';

$message = "";
$error = "";
$product = null;

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: admin.php");
    exit();
}

$product_id = intval($_GET['id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);
    $status = $_POST['status'];
    $current_image = $_POST['current_image'];
    $image = $current_image;

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $filename = $_FILES['image']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed)) {
            $new_filename = uniqid() . '.' . $ext;
            $target = "assets/images/" . $new_filename;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                if ($current_image != 'no-image.png' && file_exists("assets/images/" . $current_image)) {
                }
                $image = $new_filename;
            }
        } else {
            $error = "Sadece JPG, PNG, GIF ve WEBP formatları kabul edilir.";
        }
    }

    if (empty($error)) {
        $stmt = $conn->prepare("UPDATE products SET name = ?, description = ?, price = ?, stock = ?, image = ?, status = ? WHERE id = ?");
        $stmt->bind_param("ssdissi", $name, $description, $price, $stock, $image, $status, $product_id);

        if ($stmt->execute()) {
            $message = "Ürün başarıyla güncellendi!";
            $stmt_refresh = $conn->prepare("SELECT * FROM products WHERE id = ?");
            $stmt_refresh->bind_param("i", $product_id);
            $stmt_refresh->execute();
            $result = $stmt_refresh->get_result();
            $product = $result->fetch_assoc();
            $stmt_refresh->close();
        } else {
            $error = "Ürün güncellenirken bir hata oluştu.";
        }

        $stmt->close();
    }
}

if (!$product) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        header("Location: admin.php");
        exit();
    }

    $product = $result->fetch_assoc();
    $stmt->close();
}

require_once 'includes/header.php';
?>

<!-- Page Header -->
<div class="bg-gradient text-white py-4 mb-4">
    <div class="container">
        <h1 class="h2 fw-bold">
            <i class="bi bi-pencil-square"></i> Ürün Düzenle
        </h1>
        <p class="mb-0">Ürün bilgilerini güncelleyin</p>
    </div>
</div>

<!-- Edit Product Form -->
<section class="py-4 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0">
                            <i class="bi bi-pencil"></i> <?php echo htmlspecialchars($product['name']); ?>
                        </h5>
                    </div>
                    <div class="card-body">
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

                        <form action="edit_product.php?id=<?php echo $product_id; ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($product['image']); ?>">

                            <!-- Mevcut Görsel -->
                            <div class="mb-3 text-center">
                                <label class="form-label fw-semibold">Mevcut Görsel</label>
                                <div>
                                    <img src="assets/images/<?php echo htmlspecialchars($product['image']); ?>"
                                         alt="<?php echo htmlspecialchars($product['name']); ?>"
                                         class="img-thumbnail"
                                         style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-tag"></i> Ürün Adı
                                </label>
                                <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-file-text"></i> Açıklama
                                </label>
                                <textarea name="description" class="form-control" rows="3" required><?php echo htmlspecialchars($product['description']); ?></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-currency-exchange"></i> Fiyat (₺)
                                    </label>
                                    <input type="number" name="price" class="form-control" step="0.01" min="0" value="<?php echo $product['price']; ?>" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">
                                        <i class="bi bi-box-seam"></i> Stok
                                    </label>
                                    <input type="number" name="stock" class="form-control" min="0" value="<?php echo $product['stock']; ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-toggle-on"></i> Durum
                                </label>
                                <select name="status" class="form-select">
                                    <option value="active" <?php echo $product['status'] == 'active' ? 'selected' : ''; ?>>Aktif</option>
                                    <option value="inactive" <?php echo $product['status'] == 'inactive' ? 'selected' : ''; ?>>Pasif</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    <i class="bi bi-image"></i> Yeni Görsel (İsteğe Bağlı)
                                </label>
                                <input type="file" name="image" class="form-control" accept="image/*">
                                <small class="text-muted">Yeni görsel yüklemezseniz mevcut görsel korunur</small>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-warning flex-fill">
                                    <i class="bi bi-save"></i> Değişiklikleri Kaydet
                                </button>
                                <a href="admin.php" class="btn btn-secondary">
                                    <i class="bi bi-x-circle"></i> İptal
                                </a>
                            </div>
                        </form>
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
