<?php
$page_title = "MiniShop - Modern E-Ticaret";
require_once 'includes/db.php';
require_once 'includes/header.php';

$sql = "SELECT * FROM products WHERE status = 'active' ORDER BY created_at DESC LIMIT 3";
$result = $conn->query($sql);
?>

<!-- Revolutionary Hero Section -->
<section class="position-relative overflow-hidden" style="min-height: 85vh; background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);">
    <!-- Animated Background Shapes -->
    <div class="position-absolute w-100 h-100" style="top: 0; left: 0; overflow: hidden; z-index: 0;">
        <div class="position-absolute rounded-circle" style="width: 400px; height: 400px; background: rgba(255,255,255,0.1); top: -100px; right: -100px; animation: float 6s ease-in-out infinite;"></div>
        <div class="position-absolute rounded-circle" style="width: 300px; height: 300px; background: rgba(255,255,255,0.08); bottom: -80px; left: -80px; animation: float 8s ease-in-out infinite reverse;"></div>
        <div class="position-absolute rounded-circle" style="width: 200px; height: 200px; background: rgba(255,255,255,0.06); top: 50%; left: 10%; animation: float 7s ease-in-out infinite;"></div>
    </div>

    <div class="container position-relative" style="z-index: 1; padding-top: 100px; padding-bottom: 100px;">
        <div class="row align-items-center">
            <!-- Left Content -->
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="badge bg-white bg-opacity-25 text-white px-4 py-2 rounded-pill mb-4" style="animation: fadeInUp 0.8s ease-out;">
                    <i class="bi bi-stars"></i> Premium Ürünler
                </div>
                <h1 class="display-2 fw-bold text-white mb-4" style="line-height: 1.1; animation: fadeInUp 0.8s ease-out 0.2s backwards;">
                    Teknolojinin <br>
                    <span style="background: linear-gradient(90deg, #ffd89b 0%, #19547b 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        Zirvesini
                    </span><br>
                    Keşfet
                </h1>
                <p class="lead text-white mb-4 opacity-90" style="font-size: 1.3rem; animation: fadeInUp 0.8s ease-out 0.4s backwards;">
                    En yeni teknoloji ürünleri, en uygun fiyatlarla. Hayallerinizdeki ürünler artık çok daha yakın.
                </p>
                <div class="d-flex gap-3 flex-wrap" style="animation: fadeInUp 0.8s ease-out 0.6s backwards;">
                    <a href="products.php" class="btn btn-light btn-lg px-5 shadow-lg" style="border-radius: 50px; font-weight: 600;">
                        <i class="bi bi-bag-check me-2"></i> Alışverişe Başla
                    </a>
                    <?php if (empty($_SESSION['user_id'])): ?>
                        <a href="register.php" class="btn btn-outline-light btn-lg px-5" style="border-radius: 50px; border-width: 2px; font-weight: 600;">
                            <i class="bi bi-rocket-takeoff me-2"></i> Ücretsiz Kayıt
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Stats -->
                <div class="row mt-5 text-white" style="animation: fadeInUp 0.8s ease-out 0.8s backwards;">
                    <div class="col-4">
                        <h3 class="fw-bold mb-0">500+</h3>
                        <small class="opacity-75">Ürün</small>
                    </div>
                    <div class="col-4">
                        <h3 class="fw-bold mb-0">10K+</h3>
                        <small class="opacity-75">Mutlu Müşteri</small>
                    </div>
                    <div class="col-4">
                        <h3 class="fw-bold mb-0">%99</h3>
                        <small class="opacity-75">Memnuniyet</small>
                    </div>
                </div>
            </div>

            <!-- Right Side - Floating Product Cards -->
            <div class="col-lg-6 d-none d-lg-block">
                <div class="position-relative" style="height: 500px;">
                    <?php
                    $hero_products = $conn->query("SELECT * FROM products WHERE status = 'active' ORDER BY RAND() LIMIT 3");
                    if ($hero_products && $hero_products->num_rows > 0) {
                        $positions = [
                            ['top' => '5%', 'right' => '15%', 'delay' => '0s'],
                            ['top' => '35%', 'right' => '5%', 'delay' => '0.2s'],
                            ['top' => '65%', 'right' => '25%', 'delay' => '0.4s']
                        ];
                        $i = 0;
                        while ($hp = $hero_products->fetch_assoc()) {
                            $pos = $positions[$i];
                            ?>
                            <div class="position-absolute" style="top: <?php echo $pos['top']; ?>; right: <?php echo $pos['right']; ?>; animation: float 5s ease-in-out infinite, fadeInUp 0.8s ease-out <?php echo $pos['delay']; ?> backwards;">
                                <div class="card border-0 shadow-lg" style="width: 200px; border-radius: 20px; transform: rotate(<?php echo rand(-5, 5); ?>deg);">
                                    <img src="assets/images/<?php echo htmlspecialchars($hp['image']); ?>"
                                         class="card-img-top"
                                         style="height: 150px; object-fit: cover; border-radius: 20px 20px 0 0;"
                                         alt="<?php echo htmlspecialchars($hp['name']); ?>">
                                    <div class="card-body p-3">
                                        <h6 class="fw-bold mb-1 small"><?php echo htmlspecialchars(substr($hp['name'], 0, 25)); ?></h6>
                                        <p class="text-gradient fw-bold mb-0"><?php echo number_format($hp['price'], 0); ?> ₺</p>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $i++;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Wave Bottom -->
    <div class="position-absolute bottom-0 start-0 w-100" style="z-index: 0;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" style="display: block;">
            <path fill="#ffffff" d="M0,64L48,69.3C96,75,192,85,288,80C384,75,480,53,576,48C672,43,768,53,864,58.7C960,64,1056,64,1152,58.7C1248,53,1344,43,1392,37.3L1440,32L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z"></path>
        </svg>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center p-4 h-100">
                    <div class="feature-icon text-white mb-4 mx-auto" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="bi bi-rocket-takeoff"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Hızlı Teslimat</h5>
                    <p class="text-muted mb-0">Siparişleriniz 24 saat içinde kapınızda</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4 h-100">
                    <div class="feature-icon text-white mb-4 mx-auto" style="background: linear-gradient(135deg, #0ba360 0%, #3cba92 100%);">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Güvenli Ödeme</h5>
                    <p class="text-muted mb-0">SSL sertifikası ile korumalı alışveriş</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4 h-100">
                    <div class="feature-icon text-white mb-4 mx-auto" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Kolay İade</h5>
                    <p class="text-muted mb-0">14 gün içinde ücretsiz iade hakkı</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Products Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-gradient mb-3">
                ✨ Öne Çıkan Ürünler
            </h2>
            <p class="lead text-muted">En popüler ve yeni ürünlerimizi keşfedin</p>
        </div>

        <div class="row g-4 mb-5">
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card product-card h-100 border-0 shadow-sm">
                            <div class="position-relative overflow-hidden">
                                <img src="assets/images/<?php echo htmlspecialchars($row['image'] ?: 'no-image.png'); ?>"
                                     class="card-img-top"
                                     alt="<?php echo htmlspecialchars($row['name']); ?>">
                                <?php if ($row['stock'] < 10 && $row['stock'] > 0): ?>
                                    <span class="position-absolute top-0 end-0 m-3 badge bg-warning text-dark">
                                        <i class="bi bi-lightning-fill"></i> Son <?php echo $row['stock']; ?> Ürün
                                    </span>
                                <?php elseif ($row['stock'] == 0): ?>
                                    <span class="position-absolute top-0 end-0 m-3 badge bg-danger">
                                        <i class="bi bi-x-circle"></i> Tükendi
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold mb-2"><?php echo htmlspecialchars($row['name']); ?></h5>
                                <p class="card-text text-muted small mb-3 flex-grow-1">
                                    <?php echo htmlspecialchars($row['description']); ?>
                                </p>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <span class="h4 text-gradient fw-bold mb-0">
                                            <?php echo number_format($row['price'], 2, ',', '.'); ?> ₺
                                        </span>
                                    </div>
                                    <span class="badge bg-light text-dark border">
                                        <i class="bi bi-box"></i> Stok: <?php echo intval($row['stock']); ?>
                                    </span>
                                </div>
                                <?php if (!empty($_SESSION['user_id'])): ?>
                                    <a href="add_to_cart.php?id=<?php echo $row['id']; ?>" class="btn btn-primary w-100">
                                        <i class="bi bi-cart-plus me-2"></i> Sepete Ekle
                                    </a>
                                <?php else: ?>
                                    <a href="login.php" class="btn btn-outline-primary w-100">
                                        <i class="bi bi-box-arrow-in-right me-2"></i> Giriş Yapın
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<div class="col-12">';
                echo '<div class="alert alert-info text-center border-0">';
                echo '<i class="bi bi-info-circle fs-1 d-block mb-3"></i>';
                echo '<h5>Henüz ürün bulunmamaktadır</h5>';
                echo '<p class="mb-0">Yakında yeni ürünler eklenecek!</p>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>

        <?php if ($result && $result->num_rows > 0): ?>
            <div class="text-center">
                <a href="products.php" class="btn btn-outline-primary btn-lg px-5">
                    <i class="bi bi-grid-3x3-gap me-2"></i> Tüm Ürünleri Görüntüle
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-gradient-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="display-5 fw-bold mb-4">
                    <i class="bi bi-gift"></i> Özel Fırsatları Kaçırmayın!
                </h2>
                <p class="lead mb-4">
                    Yeni ürünler ve kampanyalardan haberdar olmak için hemen kayıt olun.
                </p>
                <?php if (empty($_SESSION['user_id'])): ?>
                    <a href="register.php" class="btn btn-light btn-lg px-5 shadow-lg">
                        <i class="bi bi-person-plus me-2"></i> Ücretsiz Kayıt Ol
                    </a>
                <?php else: ?>
                    <a href="products.php" class="btn btn-light btn-lg px-5 shadow-lg">
                        <i class="bi bi-bag-check me-2"></i> Alışverişe Başla
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
$conn->close();
require_once 'includes/footer.php';
?>
