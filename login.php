<?php
$page_title = "Giriş Yap - MiniShop";
session_start();
require_once 'includes/db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id, name, password, is_admin FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $name, $hashed_password, $is_admin);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;
            $_SESSION['is_admin'] = $is_admin;

            header("Location: " . ($is_admin ? "admin.php" : "index.php"));
            exit();
        } else {
            $error = "Hatalı şifre girdiniz.";
        }
    } else {
        $error = "Böyle bir kullanıcı bulunamadı.";
    }

    $stmt->close();
}

require_once 'includes/header.php';
?>

<!-- Split Screen Design -->
<section class="min-vh-100 d-flex align-items-center" style="background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);">
    <div class="container-fluid">
        <div class="row g-0 justify-content-center">
            <!-- Left Side - Form -->
            <div class="col-lg-6 col-xl-5 d-flex align-items-center justify-content-center p-5 order-2 order-lg-1">
                <div class="w-100" style="max-width: 500px;">
                    <!-- Back to Home -->
                    <div class="mb-4">
                        <a href="index.php" class="text-decoration-none text-muted d-inline-flex align-items-center">
                            <i class="bi bi-arrow-left me-2"></i> Ana Sayfaya Dön
                        </a>
                    </div>

                    <!-- Header -->
                    <div class="mb-5">
                        <h1 class="display-5 fw-bold mb-2">Tekrar Hoş Geldiniz!</h1>
                        <p class="text-muted">Alışverişe devam etmek için giriş yapın</p>
                    </div>

                    <!-- Alerts -->
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i><?php echo htmlspecialchars($error); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Form -->
                    <form method="POST" action="" class="needs-validation" novalidate>
                        <!-- Email -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-envelope text-primary me-1"></i> E-posta Adresi
                            </label>
                            <input type="email" name="email" class="form-control form-control-lg" placeholder="ornek@email.com" required style="border-radius: 12px; padding: 0.9rem 1.2rem;">
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-lock text-primary me-1"></i> Şifre
                            </label>
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="••••••••" required style="border-radius: 12px; padding: 0.9rem 1.2rem;">
                        </div>

                        <!-- Remember & Forgot -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" style="border-radius: 6px;">
                                <label class="form-check-label text-muted small" for="remember">
                                    Beni Hatırla
                                </label>
                            </div>
                            <a href="#" class="text-primary text-decoration-none small fw-semibold">Şifremi Unuttum?</a>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-4 shadow-sm" style="border-radius: 12px; padding: 0.9rem;">
                            <i class="bi bi-box-arrow-in-right me-2"></i> Giriş Yap
                        </button>

                        <!-- Divider -->
                        <div class="text-center mb-4">
                            <span class="text-muted">veya</span>
                        </div>

                        <!-- Social Login -->
                        <div class="row g-2 mb-4">
                            <div class="col-6">
                                <button type="button" class="btn btn-outline-secondary w-100" style="border-radius: 12px;">
                                    <i class="bi bi-google me-1"></i> Google
                                </button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-outline-secondary w-100" style="border-radius: 12px;">
                                    <i class="bi bi-facebook me-1"></i> Facebook
                                </button>
                            </div>
                        </div>

                        <!-- Register Link -->
                        <div class="text-center">
                            <p class="text-muted mb-0">
                                Hesabınız yok mu?
                                <a href="register.php" class="text-primary fw-semibold text-decoration-none">Hemen Kayıt Olun</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Side - Visual/Info -->
            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center position-relative overflow-hidden order-1 order-lg-2" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); min-height: 100vh;">
                <!-- Animated Circles -->
                <div class="position-absolute" style="width: 450px; height: 450px; background: rgba(255,255,255,0.1); border-radius: 50%; top: -120px; left: -120px; animation: float 7s ease-in-out infinite;"></div>
                <div class="position-absolute" style="width: 350px; height: 350px; background: rgba(255,255,255,0.08); border-radius: 50%; bottom: -100px; right: -100px; animation: float 9s ease-in-out infinite reverse;"></div>
                <div class="position-absolute" style="width: 200px; height: 200px; background: rgba(255,255,255,0.06); border-radius: 50%; top: 40%; right: 10%; animation: float 5s ease-in-out infinite;"></div>

                <div class="text-center text-white px-5 position-relative" style="z-index: 1;">
                    <div class="mb-4">
                        <i class="bi bi-bag-heart" style="font-size: 5rem; opacity: 0.9;"></i>
                    </div>
                    <h2 class="display-4 fw-bold mb-4">
                        Alışverişe Devam!
                    </h2>
                    <p class="lead mb-5 opacity-90">
                        Sepetinizdeki ürünler sizi bekliyor. Hemen giriş yapın ve alışverişe kaldığınız yerden devam edin.
                    </p>

                    <!-- Stats -->
                    <div class="row text-center mt-5">
                        <div class="col-4">
                            <div class="bg-white bg-opacity-25 rounded-4 p-4 mb-3">
                                <i class="bi bi-lightning-charge fs-1"></i>
                            </div>
                            <h6 class="mb-0 fw-bold">Hızlı Teslimat</h6>
                            <small class="opacity-75">24 saat içinde</small>
                        </div>
                        <div class="col-4">
                            <div class="bg-white bg-opacity-25 rounded-4 p-4 mb-3">
                                <i class="bi bi-shield-check fs-1"></i>
                            </div>
                            <h6 class="mb-0 fw-bold">Güvenli Alışveriş</h6>
                            <small class="opacity-75">SSL korumalı</small>
                        </div>
                        <div class="col-4">
                            <div class="bg-white bg-opacity-25 rounded-4 p-4 mb-3">
                                <i class="bi bi-award fs-1"></i>
                            </div>
                            <h6 class="mb-0 fw-bold">Kalite Garantisi</h6>
                            <small class="opacity-75">%100 orijinal</small>
                        </div>
                    </div>

                    <!-- Customer Quote -->
                    <div class="mt-5 bg-white bg-opacity-15 rounded-4 p-4 backdrop-blur">
                        <div class="mb-3">
                            <i class="bi bi-star-fill opacity-75"></i>
                            <i class="bi bi-star-fill opacity-75"></i>
                            <i class="bi bi-star-fill opacity-75"></i>
                            <i class="bi bi-star-fill opacity-75"></i>
                            <i class="bi bi-star-fill opacity-75"></i>
                        </div>
                        <p class="mb-3 opacity-90 fst-italic">
                            "MiniShop'tan aldığım ürünlerin kalitesi harika! Hızlı teslimat ve müşteri hizmetleri çok başarılı."
                        </p>
                        <p class="mb-0 small fw-semibold">
                            - Ahmet Y. <span class="opacity-75">/ Mutlu Müşteri</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>
