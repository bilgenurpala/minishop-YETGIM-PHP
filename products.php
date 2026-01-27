<?php
session_start();
$page_title = "Ürünler - MiniShop";
require_once 'includes/db.php';

mysqli_set_charset($conn, "utf8");

$sql = "SELECT id, name, description, price, stock, image, status
        FROM products
        WHERE status = 'active'
        ORDER BY created_at DESC";
$result = $conn->query($sql);

require_once 'includes/header.php';
?>

<!-- Modern Page Header with Gradient -->
<section class="position-relative overflow-hidden" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 80px 0 120px;">
    <!-- Animated Background -->
    <div class="position-absolute w-100 h-100" style="top: 0; left: 0; opacity: 0.1;">
        <div class="position-absolute" style="width: 300px; height: 300px; background: white; border-radius: 50%; top: -100px; right: 10%; animation: float 8s ease-in-out infinite;"></div>
        <div class="position-absolute" style="width: 200px; height: 200px; background: white; border-radius: 50%; bottom: -50px; left: 5%; animation: float 6s ease-in-out infinite reverse;"></div>
    </div>

    <div class="container position-relative" style="z-index: 1;">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb justify-content-center bg-transparent">
                        <li class="breadcrumb-item"><a href="index.php" class="text-white text-decoration-none opacity-75">Ana Sayfa</a></li>
                        <li class="breadcrumb-item text-white active">Ürünler</li>
                    </ol>
                </nav>

                <!-- Title -->
                <div class="mb-4" style="animation: fadeInUp 0.8s ease-out;">
                    <div class="badge bg-white bg-opacity-25 text-white px-4 py-2 rounded-pill mb-3">
                        <i class="bi bi-stars"></i> Premium Koleksiyon
                    </div>
                    <h1 class="display-3 fw-bold text-white mb-3">
                        Tüm Ürünler
                    </h1>
                    <p class="lead text-white opacity-90 mb-0">
                        En yeni teknoloji ürünlerini keşfedin ve hayallerinizdeki ürüne sahip olun
                    </p>
                </div>

                <!-- Filter/Search Bar -->
                <div class="card border-0 shadow-lg mx-auto" style="max-width: 600px; border-radius: 50px; animation: fadeInUp 0.8s ease-out 0.2s backwards;">
                    <div class="card-body p-2">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-0 ps-4">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-0 shadow-none" placeholder="Ürün ara..." id="searchInput" style="font-size: 1.1rem;">
                            <button class="btn btn-primary px-4 m-1" style="border-radius: 40px;">
                                Ara
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Wave Bottom -->
    <div class="position-absolute bottom-0 start-0 w-100">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" style="display: block;">
            <path fill="#f8fafc" d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,48C672,43,768,53,864,58.7C960,64,1056,64,1152,58.7C1248,53,1344,43,1392,37.3L1440,32L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z"></path>
        </svg>
    </div>
</section>

<!-- Products Grid Section -->
<section class="py-5" style="background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%); margin-top: -60px;">
    <div class="container">
        <!-- Product Count & Sort -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5 class="mb-0 text-muted">
                    <i class="bi bi-grid-3x3-gap"></i>
                    <?php echo $result ? $result->num_rows : 0; ?> Ürün Bulundu
                </h5>
            </div>
            <div class="btn-group shadow-sm" role="group">
                <button class="btn btn-outline-primary active" style="border-radius: 12px 0 0 12px;">
                    <i class="bi bi-grid-3x3-gap"></i> Grid
                </button>
                <button class="btn btn-outline-primary" style="border-radius: 0 12px 12px 0;">
                    <i class="bi bi-list-ul"></i> Liste
                </button>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="row g-4" id="productsContainer">
            <?php
            if ($result && $result->num_rows > 0) {
                $delay = 0;
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-sm-6 col-md-4 col-lg-3 product-item" data-name="<?php echo strtolower($row['name']); ?>" style="animation: fadeInUp 0.6s ease-out <?php echo $delay; ?>s backwards;">
                        <div class="card product-card h-100 border-0 shadow-sm position-relative">
                            <!-- Discount Badge (if any) -->
                            <?php if ($row['stock'] < 10 && $row['stock'] > 0): ?>
                                <div class="position-absolute top-0 start-0 m-3" style="z-index: 10;">
                                    <span class="badge bg-danger shadow-sm">
                                        <i class="bi bi-fire"></i> Son <?php echo $row['stock']; ?> Ürün!
                                    </span>
                                </div>
                            <?php elseif ($row['stock'] == 0): ?>
                                <div class="position-absolute top-0 start-0 m-3" style="z-index: 10;">
                                    <span class="badge bg-secondary shadow-sm">
                                        <i class="bi bi-x-circle"></i> Tükendi
                                    </span>
                                </div>
                            <?php endif; ?>

                            <!-- Wishlist Button -->
                            <button class="btn btn-light position-absolute top-0 end-0 m-3 rounded-circle shadow-sm" style="width: 40px; height: 40px; z-index: 10;">
                                <i class="bi bi-heart"></i>
                            </button>

                            <!-- Product Image -->
                            <div class="position-relative overflow-hidden" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);">
                                <img src="assets/images/<?php echo htmlspecialchars($row['image'] ?: 'no-image.png'); ?>"
                                     class="card-img-top p-3"
                                     alt="<?php echo htmlspecialchars($row['name']); ?>"
                                     style="height: 220px; object-fit: contain;">
                            </div>

                            <!-- Product Info -->
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title fw-bold mb-2" style="min-height: 40px; line-height: 1.3;">
                                    <?php echo htmlspecialchars($row['name']); ?>
                                </h6>

                                <p class="card-text text-muted small mb-3" style="min-height: 60px; font-size: 0.85rem;">
                                    <?php
                                    $desc = htmlspecialchars($row['description']);
                                    echo strlen($desc) > 80 ? substr($desc, 0, 80) . '...' : $desc;
                                    ?>
                                </p>

                                <!-- Price & Stock -->
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <h5 class="text-gradient fw-bold mb-0">
                                                <?php echo number_format($row['price'], 2, ',', '.'); ?> ₺
                                            </h5>
                                        </div>
                                        <span class="badge bg-light text-dark border">
                                            <i class="bi bi-box"></i> <?php echo intval($row['stock']); ?>
                                        </span>
                                    </div>

                                    <!-- Action Button -->
                                    <?php if (!empty($_SESSION['user_id'])): ?>
                                        <?php if ($row['stock'] > 0): ?>
                                            <a href="add_to_cart.php?id=<?php echo $row['id']; ?>" class="btn btn-primary w-100">
                                                <i class="bi bi-cart-plus me-2"></i> Sepete Ekle
                                            </a>
                                        <?php else: ?>
                                            <button class="btn btn-secondary w-100" disabled>
                                                <i class="bi bi-x-circle me-2"></i> Stokta Yok
                                            </button>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <a href="login.php" class="btn btn-outline-primary w-100">
                                            <i class="bi bi-box-arrow-in-right me-2"></i> Giriş Yap
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $delay += 0.05;
                    if ($delay > 0.3) $delay = 0; // Reset after 0.3s
                }
            } else {
                ?>
                <div class="col-12">
                    <div class="card border-0 shadow-sm text-center p-5" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);">
                        <div class="mb-4">
                            <i class="bi bi-inbox text-muted" style="font-size: 5rem; opacity: 0.3;"></i>
                        </div>
                        <h3 class="fw-bold mb-3">Henüz Ürün Bulunmuyor</h3>
                        <p class="text-muted mb-4">Çok yakında yeni ürünler eklenecek. Takipte kalın!</p>
                        <a href="index.php" class="btn btn-primary mx-auto" style="max-width: 200px;">
                            <i class="bi bi-house me-2"></i> Ana Sayfaya Dön
                        </a>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>

<!-- Simple Search Filter Script -->
<script>
document.getElementById('searchInput')?.addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const products = document.querySelectorAll('.product-item');

    products.forEach(product => {
        const productName = product.getAttribute('data-name');
        if (productName.includes(searchTerm)) {
            product.style.display = 'block';
        } else {
            product.style.display = 'none';
        }
    });
});
</script>

<?php
$conn->close();
require_once 'includes/footer.php';
?>
