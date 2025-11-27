<div align="center">

# 🛒 MiniShop - Modern E-Ticaret Platformu

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)

### 🚀 Modern ve kullanıcı dostu arayüzü ile geliştirilmiş, saf PHP tabanlı e-ticaret web uygulaması

[Demo](#) • [Kurulum](#-kurulum) • [Özellikler](#-özellikler) • [Dokümantasyon](#-proje-yapısı)

</div>

---

## ✨ Özellikler

<table>
<tr>
<td width="50%">

### 👥 Kullanıcı Yönetimi
- ✅ Güvenli kayıt sistemi
- ✅ Giriş/Çıkış işlemleri
- ✅ Oturum yönetimi
- ✅ Admin & Kullanıcı rolleri

### 🛍️ Ürün Yönetimi
- ✅ Ürün listeleme ve arama
- ✅ Kategori bazlı filtreleme
- ✅ Detaylı ürün görünümü
- ✅ Stok takibi

</td>
<td width="50%">

### 🛒 Alışveriş Sepeti
- ✅ Sepete ürün ekleme/çıkarma
- ✅ Miktar güncelleme
- ✅ Toplam fiyat hesaplama
- ✅ Kullanıcı bazlı sepet

### ⚙️ Admin Paneli
- ✅ Ürün ekleme/düzenleme/silme
- ✅ Görsel yükleme
- ✅ Stok yönetimi
- ✅ Kullanıcı yönetimi

</td>
</tr>
</table>

### 🎨 Ek Özellikler

- 📱 **Responsive Tasarım** - Tüm cihazlarda mükemmel görünüm
- 🔒 **Güvenlik** - Prepared statements ile SQL injection koruması
- ⚡ **Performans** - Hızlı ve optimize edilmiş kod yapısı
- 🎯 **Modern UI/UX** - Bootstrap 5 ile şık arayüz
- 🌐 **SEO Dostu** - Arama motorları için optimize

## 🛠️ Teknolojiler

<table>
<tr>
<td align="center" width="96">
<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" width="48" height="48" alt="PHP" />
<br>PHP
</td>
<td align="center" width="96">
<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" width="48" height="48" alt="MySQL" />
<br>MySQL
</td>
<td align="center" width="96">
<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/bootstrap/bootstrap-original.svg" width="48" height="48" alt="Bootstrap" />
<br>Bootstrap 5
</td>
<td align="center" width="96">
<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" width="48" height="48" alt="HTML5" />
<br>HTML5
</td>
<td align="center" width="96">
<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" width="48" height="48" alt="CSS3" />
<br>CSS3
</td>
<td align="center" width="96">
<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" width="48" height="48" alt="JavaScript" />
<br>JavaScript
</td>
</tr>
</table>

- 🔧 **Backend**: PHP 7.4+ (Native/Vanilla PHP - Framework yok!)
- 💾 **Veritabanı**: MySQL 5.7+ (MySQLi ile bağlantı)
- 🎨 **Frontend**: HTML5, CSS3, Modern JavaScript
- 📦 **UI Framework**: Bootstrap 5.3.2
- 🎯 **İkonlar**: Bootstrap Icons 1.11.3

## 📋 Gereksinimler

| Gereksinim | Minimum Versiyon | Önerilen |
|------------|------------------|----------|
| ![PHP](https://img.shields.io/badge/-PHP-777BB4?style=flat&logo=php&logoColor=white) | 7.4+ | 8.0+ |
| ![MySQL](https://img.shields.io/badge/-MySQL-4479A1?style=flat&logo=mysql&logoColor=white) | 5.7+ | 8.0+ |
| ![Apache](https://img.shields.io/badge/-Apache-D22128?style=flat&logo=apache&logoColor=white) | 2.4+ | 2.4+ |

**Yerel Geliştirme için:**
- 💻 [XAMPP](https://www.apachefriends.org/) (Windows, Linux, Mac)
- 💻 [WAMP](https://www.wampserver.com/) (Windows)
- 💻 [MAMP](https://www.mamp.info/) (Mac, Windows)
- 💻 [Laragon](https://laragon.org/) (Windows)

## 🚀 Kurulum

### Adım 1️⃣: Projeyi İndirin

```bash
git clone https://github.com/bilgenurpala/minishop-YETGIM-PHP.git
cd minishop-YETGIM-PHP
```

### Adım 2️⃣: Veritabanını Oluşturun

**Seçenek A: phpMyAdmin ile** (Önerilen)
1. phpMyAdmin'e giriş yapın (`http://localhost/phpmyadmin`)
2. "Import" sekmesine gidin
3. `database.sql` dosyasını seçin ve "Go" butonuna tıklayın

**Seçenek B: Komut satırı ile**
```bash
mysql -u root -p < database.sql
```

### Adım 3️⃣: Veritabanı Bağlantısını Yapılandırın

`includes/db.php` dosyasını düzenleyin:

```php
<?php
$servername = "localhost";  // Veritabanı sunucusu
$username = "root";         // MySQL kullanıcı adı
$password = "";             // MySQL şifresi
$database = "urun_katalogu"; // Veritabanı adı

$conn = mysqli_connect($servername, $username, $password, $database);
?>
```

### Adım 4️⃣: Projeyi Çalıştırın

**XAMPP Kullanıcıları:**
1. 🟢 Apache'yi başlatın
2. 🟢 MySQL'i başlatın
3. 🌐 Tarayıcıda açın: `http://localhost/minishop-YETGIM-PHP`

**Built-in PHP Server (Alternatif):**
```bash
php -S localhost:8000
```
Ardından: `http://localhost:8000` adresine gidin

### ✅ Kurulum Tamamlandı!

Artık projenizi kullanmaya hazırsınız! 🎉

## 🔑 Varsayılan Giriş Bilgileri

<table>
<tr>
<td width="50%">

### 👨‍💼 Admin Hesabı
```
📧 E-posta: admin@minishop.com
🔐 Şifre:    admin123
```
**Yetkiler:**
- ✅ Ürün ekleme/düzenleme/silme
- ✅ Tüm kullanıcıları görüntüleme
- ✅ Sistem yönetimi

</td>
<td width="50%">

### 👤 Test Kullanıcı Hesabı
```
📧 E-posta: ahmet@example.com
🔐 Şifre:    admin123
```
**Yetkiler:**
- ✅ Ürün görüntüleme
- ✅ Sepete ekleme
- ✅ Alışveriş yapma

</td>
</tr>
</table>

> ⚠️ **Güvenlik Notu:** Canlı ortamda mutlaka şifreleri değiştirin!

## 📁 Proje Yapısı

```
minishop-YETGIM-PHP/
│
├── 📂 assets/                  # Statik dosyalar
│   ├── 📂 css/
│   │   └── style.css          # Ana stil dosyası (590+ satır)
│   └── 📂 images/             # Ürün görselleri
│       └── products-images/
│
├── 📂 includes/               # Ortak PHP dosyaları
│   ├── db.php                # Veritabanı bağlantısı
│   ├── header.php            # Üst menü & navbar
│   └── footer.php            # Alt bilgi
│
├── 📄 index.php              # Ana sayfa
├── 📄 products.php           # Ürün listeleme
├── 📄 cart.php               # Alışveriş sepeti
├── 📄 login.php              # Kullanıcı girişi
├── 📄 register.php           # Kullanıcı kaydı
├── 📄 logout.php             # Çıkış işlemi
│
├── 📄 admin.php              # Admin paneli
├── 📄 add_to_cart.php        # Sepete ekleme
├── 📄 remove_from_cart.php   # Sepetten çıkarma
├── 📄 edit_product.php       # Ürün düzenleme
├── 📄 delete_product.php     # Ürün silme
│
├── 📄 database.sql           # Veritabanı şeması
├── 📄 README.md              # Proje dokümantasyonu
└── 📄 .gitignore             # Git ignore dosyası
```

### 📊 İstatistikler

- 📝 **Toplam Kod Satırı**: 3,967+
- 📄 **PHP Dosyaları**: 13
- 🎨 **CSS Satırları**: 590+
- 🗄️ **Veritabanı Tabloları**: 3 (users, products, cart)

## 🤝 Katkıda Bulunma

Katkılarınızı bekliyoruz! Projeye katkıda bulunmak için:

1. 🍴 Bu projeyi **fork** edin
2. 🌿 Yeni bir **branch** oluşturun
   ```bash
   git checkout -b feature/harika-ozellik
   ```
3. 💾 Değişikliklerinizi **commit** edin
   ```bash
   git commit -m '✨ Harika özellik eklendi'
   ```
4. 📤 Branch'inizi **push** edin
   ```bash
   git push origin feature/harika-ozellik
   ```
5. 🎉 **Pull Request** oluşturun

### 🐛 Bug Bildirimi

Bir hata mı buldunuz? [Issue açın](https://github.com/bilgenurpala/minishop-YETGIM-PHP/issues/new) ve bize bildirin!

---

## 📄 Lisans

Bu proje **MIT** lisansı altında lisanslanmıştır.

```
MIT License - Özgürce kullanabilir, değiştirebilir ve dağıtabilirsiniz.
```

---

## 👨‍💻 Geliştirici

<div align="center">

**Bilgenur Pala**

[![GitHub](https://img.shields.io/badge/GitHub-bilgenurpala-181717?style=for-the-badge&logo=github)](https://github.com/bilgenurpala)

</div>

---

## 🌟 Yıldız Geçmişi

[![Star History Chart](https://api.star-history.com/svg?repos=bilgenurpala/minishop-YETGIM-PHP&type=Date)](https://star-history.com/#bilgenurpala/minishop-YETGIM-PHP&Date)

---

<div align="center">

### 💖 Beğendiyseniz yıldız vermeyi unutmayın!

[![GitHub stars](https://img.shields.io/github/stars/bilgenurpala/minishop-YETGIM-PHP?style=social)](https://github.com/bilgenurpala/minishop-YETGIM-PHP/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/bilgenurpala/minishop-YETGIM-PHP?style=social)](https://github.com/bilgenurpala/minishop-YETGIM-PHP/network/members)

**Made with ❤️ and PHP**

</div>
