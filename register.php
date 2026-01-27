<?php
$page_title = "Kayıt Ol - MiniShop";
require_once 'includes/db.php';

$msg = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password !== $password_confirm) {
        $error = "Şifreler eşleşmiyor!";
    } elseif (strlen($password) < 6) {
        $error = "Şifre en az 6 karakter olmalıdır!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = "Bu e-posta adresiyle zaten kayıt olunmuş.";
        } else {
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, is_admin, created_at) VALUES (?, ?, ?, 0, NOW())");
            $stmt->bind_param("sss", $name, $email, $hashed_password);

            if ($stmt->execute()) {
                $new_user_id = $conn->insert_id;
                session_start();
                $_SESSION['user_id'] = $new_user_id;
                $_SESSION['user_name'] = $name;
                $_SESSION['is_admin'] = 0;

                header("Location: index.php");
                exit;
            } else {
                $error = "Kayıt sırasında bir hata oluştu.";
            }

            $stmt->close();
        }
        $check->close();
    }
}

require_once 'includes/header.php';
?>

<!-- Split Screen Design -->
<section class="min-vh-100 d-flex align-items-center" style="background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);">
    <div class="container-fluid">
        <div class="row g-0 justify-content-center">
            <!-- Left Side - Visual/Info -->
            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center position-relative overflow-hidden" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh;">
                <!-- Animated Circles -->
                <div class="position-absolute" style="width: 400px; height: 400px; background: rgba(255,255,255,0.1); border-radius: 50%; top: -100px; right: -100px; animation: float 8s ease-in-out infinite;"></div>
                <div class="position-absolute" style="width: 300px; height: 300px; background: rgba(255,255,255,0.08); bottom: -80px; left: -80px; animation: float 6s ease-in-out infinite reverse;"></div>

                <div class="text-center text-white px-5 position-relative" style="z-index: 1;">
                    <div class="mb-4">
                        <i class="bi bi-rocket-takeoff" style="font-size: 5rem; opacity: 0.9;"></i>
                    </div>
                    <h2 class="display-4 fw-bold mb-4">
                        Hoş Geldiniz!
                    </h2>
                    <p class="lead mb-4 opacity-90">
                        MiniShop ailesine katılın ve premium alışveriş deneyiminin tadını çıkarın.
                    </p>

                    <!-- Features -->
                    <div class="row text-start mt-5">
                        <div class="col-12 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-white bg-opacity-25 rounded-circle p-3 me-3">
                                    <i class="bi bi-check-lg fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Ücretsiz Kargo</h6>
                                    <small class="opacity-75">500₺ üzeri alışverişlerde</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-white bg-opacity-25 rounded-circle p-3 me-3">
                                    <i class="bi bi-check-lg fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Özel İndirimler</h6>
                                    <small class="opacity-75">Yeni üyelere özel kampanyalar</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items-center">
                                <div class="bg-white bg-opacity-25 rounded-circle p-3 me-3">
                                    <i class="bi bi-check-lg fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Kolay İade</h6>
                                    <small class="opacity-75">14 gün içinde ücretsiz</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Form -->
            <div class="col-lg-6 col-xl-5 d-flex align-items-center justify-content-center p-5">
                <div class="w-100" style="max-width: 500px;">
                    <!-- Back to Home -->
                    <div class="mb-4">
                        <a href="index.php" class="text-decoration-none text-muted d-inline-flex align-items-center">
                            <i class="bi bi-arrow-left me-2"></i> Ana Sayfaya Dön
                        </a>
                    </div>

                    <!-- Header -->
                    <div class="mb-5">
                        <h1 class="display-5 fw-bold mb-2">Hesap Oluştur</h1>
                        <p class="text-muted">Hemen kayıt olun ve alışverişe başlayın</p>
                    </div>

                    <!-- Alerts -->
                    <?php if (!empty($msg)): ?>
                        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                            <i class="bi bi-check-circle me-2"></i><?php echo htmlspecialchars($msg); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i><?php echo htmlspecialchars($error); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Form -->
                    <form method="POST" action="" class="needs-validation" novalidate>
                        <!-- Name -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-person text-primary me-1"></i> Ad Soyad
                            </label>
                            <input type="text" name="name" class="form-control form-control-lg" placeholder="Adınız Soyadınız" required style="border-radius: 12px; padding: 0.9rem 1.2rem;">
                        </div>

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
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="En az 6 karakter" required style="border-radius: 12px; padding: 0.9rem 1.2rem;">
                            <small class="text-muted">En az 6 karakter içermelidir</small>
                        </div>

                        <!-- Password Confirm -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="bi bi-lock-fill text-primary me-1"></i> Şifre Tekrar
                            </label>
                            <input type="password" name="password_confirm" class="form-control form-control-lg" placeholder="Şifrenizi tekrar girin" required style="border-radius: 12px; padding: 0.9rem 1.2rem;">
                        </div>

                        <!-- Terms -->
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="terms" required style="border-radius: 6px;">
                            <label class="form-check-label text-muted small" for="terms">
                                <a href="#" class="text-primary text-decoration-none">Kullanım Koşulları</a> ve
                                <a href="#" class="text-primary text-decoration-none">Gizlilik Politikası</a>'nı okudum ve kabul ediyorum
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary btn-lg w-100 mb-4 shadow-sm" style="border-radius: 12px; padding: 0.9rem;">
                            <i class="bi bi-rocket-takeoff me-2"></i> Hesap Oluştur
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

                        <!-- Login Link -->
                        <div class="text-center">
                            <p class="text-muted mb-0">
                                Zaten hesabınız var mı?
                                <a href="login.php" class="text-primary fw-semibold text-decoration-none">Giriş Yapın</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>
