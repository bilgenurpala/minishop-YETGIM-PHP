
# 🛒 MiniShop - Modern E-Commerce Platform

[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com)
[![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)](https://html.spec.whatwg.org)
[![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)](https://www.w3.org/Style/CSS)

### 🚀 A modern, user-friendly e-commerce web application built with vanilla PHP

[Live Demo](https://minishop.space/) • [Installation](#-installation) • [Features](#-features) • [Documentation](#-project-structure)

---

## ✨ Features

<table>
<tr>
<td width="50%">

### 👥 User Management
* ✅ Secure registration system
* ✅ Login/Logout functionality
* ✅ Session management
* ✅ Admin & User roles

### 🛍️ Product Management
* ✅ Product listing and search
* ✅ Category-based filtering
* ✅ Detailed product views
* ✅ Stock tracking

</td>
<td width="50%">

### 🛒 Shopping Cart
* ✅ Add/Remove products
* ✅ Quantity updates
* ✅ Total price calculation
* ✅ User-specific cart

### ⚙️ Admin Panel
* ✅ Product CRUD operations
* ✅ Image upload
* ✅ Inventory management
* ✅ User management

</td>
</tr>
</table>

### 🎨 Additional Features

* 📱 **Responsive Design** - Perfect display on all devices
* 🔒 **Security** - SQL injection protection with prepared statements
* ⚡ **Performance** - Fast and optimized code structure
* 🎯 **Modern UI/UX** - Sleek interface with Bootstrap 5
* 🌐 **SEO Friendly** - Optimized for search engines

## 🛠️ Technologies

<div align="center">

| <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" width="48" height="48"/><br>PHP | <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" width="48" height="48"/><br>MySQL | <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/bootstrap/bootstrap-original.svg" width="48" height="48"/><br>Bootstrap 5 | <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" width="48" height="48"/><br>HTML5 | <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" width="48" height="48"/><br>CSS3 | <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" width="48" height="48"/><br>JavaScript |
|:---:|:---:|:---:|:---:|:---:|:---:|

</div>

* 🔧 **Backend**: PHP 7.4+ (Vanilla PHP - No Framework!)
* 💾 **Database**: MySQL 5.7+ (MySQLi connection)
* 🎨 **Frontend**: HTML5, CSS3, Modern JavaScript
* 📦 **UI Framework**: Bootstrap 5.3.2
* 🎯 **Icons**: Bootstrap Icons 1.11.3

## 📋 Requirements

| Requirement | Minimum Version | Recommended |
|------------|----------------|-------------|
| ![PHP](https://img.shields.io/badge/-PHP-777BB4?style=flat&logo=php&logoColor=white) | 7.4+ | 8.0+ |
| ![MySQL](https://img.shields.io/badge/-MySQL-4479A1?style=flat&logo=mysql&logoColor=white) | 5.7+ | 8.0+ |
| ![Apache](https://img.shields.io/badge/-Apache-D22128?style=flat&logo=apache&logoColor=white) | 2.4+ | 2.4+ |

**For Local Development:**
* 💻 [XAMPP](https://www.apachefriends.org/) (Windows, Linux, Mac)
* 💻 [WAMP](https://www.wampserver.com/) (Windows)
* 💻 [MAMP](https://www.mamp.info/) (Mac, Windows)
* 💻 [Laragon](https://laragon.org/) (Windows)

## 🚀 Installation

### Step 1️⃣: Clone the Repository

```bash
git clone https://github.com/bilgenurpala/minishop-YETGIM-PHP.git
cd minishop-YETGIM-PHP
```

### Step 2️⃣: Create Database

**Option A: Using phpMyAdmin** (Recommended)
1. Access phpMyAdmin (`http://localhost/phpmyadmin`)
2. Go to "Import" tab
3. Select `database.sql` file and click "Go"

**Option B: Using Command Line**
```bash
mysql -u root -p < database.sql
```

### Step 3️⃣: Configure Database Connection

Edit `includes/db.php`:

```php
<?php
$servername = "localhost";      // Database server
$username = "root";             // MySQL username
$password = "";                 // MySQL password
$database = "urun_katalogu";    // Database name

$conn = mysqli_connect($servername, $username, $password, $database);
?>
```

### Step 4️⃣: Run the Project

**For XAMPP Users:**
1. 🟢 Start Apache
2. 🟢 Start MySQL
3. 🌐 Open in browser: `http://localhost/minishop-YETGIM-PHP`

**Using Built-in PHP Server (Alternative):**
```bash
php -S localhost:8000
```
Then visit: `http://localhost:8000`

### ✅ Installation Complete!

Your project is now ready to use! 🎉

## 🔑 Default Login Credentials

<table>
<tr>
<td width="50%">

### 👨‍💼 Admin Account
```
📧 Email:    admin@minishop.com
🔐 Password: admin123
```

**Permissions:**
* ✅ Product CRUD operations
* ✅ View all users
* ✅ System administration

</td>
<td width="50%">

### 👤 Test User Account
```
📧 Email:    ahmet@example.com
🔐 Password: admin123
```

**Permissions:**
* ✅ Browse products
* ✅ Add to cart
* ✅ Place orders

</td>
</tr>
</table>

> ⚠️ **Security Note:** Change passwords in production environment!

## 📁 Project Structure

```
minishop-YETGIM-PHP/
│
├── 📂 assets/                  # Static files
│   ├── 📂 css/
│   │   └── style.css          # Main stylesheet (590+ lines)
│   └── 📂 images/             # Product images
│       └── products-images/
│
├── 📂 includes/               # Common PHP files
│   ├── db.php                # Database connection
│   ├── header.php            # Top menu & navbar
│   └── footer.php            # Footer
│
├── 📄 index.php              # Homepage
├── 📄 products.php           # Product listing
├── 📄 cart.php               # Shopping cart
├── 📄 login.php              # User login
├── 📄 register.php           # User registration
├── 📄 logout.php             # Logout
│
├── 📄 admin.php              # Admin panel
├── 📄 add_to_cart.php        # Add to cart
├── 📄 remove_from_cart.php   # Remove from cart
├── 📄 edit_product.php       # Edit product
├── 📄 delete_product.php     # Delete product
│
├── 📄 database.sql           # Database schema
├── 📄 README.md              # Project documentation
└── 📄 .gitignore             # Git ignore file
```

### 📊 Statistics

* 📝 **Total Lines of Code**: 3,967+
* 📄 **PHP Files**: 13
* 🎨 **CSS Lines**: 590+
* 🗄️ **Database Tables**: 3 (users, products, cart)

## 🎯 Usage

### For Customers:
1. **Browse Products**: View available products on the homepage
2. **Register/Login**: Create an account or login
3. **Add to Cart**: Select products and add to shopping cart
4. **Checkout**: Review cart and complete purchase

### For Administrators:
1. **Login**: Use admin credentials
2. **Manage Products**: Add, edit, or delete products
3. **Upload Images**: Add product images
4. **Track Inventory**: Monitor stock levels
5. **User Management**: View registered users

## 🔒 Security Features

* 🛡️ **SQL Injection Prevention**: Prepared statements throughout
* 🔐 **Password Security**: Hashed password storage
* ✅ **Input Validation**: Server-side validation
* 🚫 **XSS Protection**: Output escaping
* 👤 **Session Security**: Secure session management
* 🎯 **Role-Based Access**: Admin and user roles

## 🤝 Contributing

Contributions are welcome! To contribute to this project:

1. 🍴 **Fork** the project
2. 🌿 Create a new **branch**
   ```bash
   git checkout -b feature/amazing-feature
   ```
3. 💾 **Commit** your changes
   ```bash
   git commit -m '✨ Add amazing feature'
   ```
4. 📤 **Push** to your branch
   ```bash
   git push origin feature/amazing-feature
   ```
5. 🎉 Open a **Pull Request**

### 🐛 Bug Reports

Found a bug? [Open an issue](https://github.com/bilgenurpala/minishop-YETGIM-PHP/issues/new) and let us know!

## 🚀 Future Enhancements

- [ ] Payment gateway integration
- [ ] Order tracking system
- [ ] Email notifications
- [ ] Product reviews and ratings
- [ ] Wishlist functionality
- [ ] Multi-language support
- [ ] Advanced search filters
- [ ] Mobile app version

## 📸 Screenshots

### Homepage
![Homepage Preview](https://via.placeholder.com/800x400?text=Homepage+Preview)

### Product Listing
![Products Preview](https://via.placeholder.com/800x400?text=Products+Page)

### Admin Panel
![Admin Preview](https://via.placeholder.com/800x400?text=Admin+Panel)

### Shopping Cart
![Cart Preview](https://via.placeholder.com/800x400?text=Shopping+Cart)

---

## 📄 License

This project is licensed under the **MIT License**.

```
MIT License - Free to use, modify, and distribute.
```

See [LICENSE](LICENSE) file for details.

---

## 👨‍💻 Developer

**Bilgenur Pala**

[![GitHub](https://img.shields.io/badge/GitHub-bilgenurpala-181717?style=for-the-badge&logo=github)](https://github.com/bilgenurpala)
[![LinkedIn](https://img.shields.io/badge/LinkedIn-Connect-0077B5?style=for-the-badge&logo=linkedin)](https://linkedin.com/in/bilgenurpala)
[![Email](https://img.shields.io/badge/Email-Contact-D14836?style=for-the-badge&logo=gmail)](mailto:your.email@example.com)

---

## 🌟 Star History

[![Star History Chart](https://api.star-history.com/svg?repos=bilgenurpala/minishop-YETGIM-PHP&type=Date)](https://star-history.com/#bilgenurpala/minishop-YETGIM-PHP&Date)

---

## 🙏 Acknowledgments

* [Bootstrap](https://getbootstrap.com) - UI Framework
* [Bootstrap Icons](https://icons.getbootstrap.com) - Icon library
* [Font Awesome](https://fontawesome.com) - Additional icons
* PHP Community for excellent documentation

---

## 📞 Support

Need help? Feel free to:
* 📧 [Email me](mailto:your.email@example.com)
* 🐛 [Open an issue](https://github.com/bilgenurpala/minishop-YETGIM-PHP/issues)
* 💬 [Start a discussion](https://github.com/bilgenurpala/minishop-YETGIM-PHP/discussions)

---

### 💖 If you like this project, don't forget to give it a star!

[![GitHub stars](https://img.shields.io/github/stars/bilgenurpala/minishop-YETGIM-PHP?style=social)](https://github.com/bilgenurpala/minishop-YETGIM-PHP/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/bilgenurpala/minishop-YETGIM-PHP?style=social)](https://github.com/bilgenurpala/minishop-YETGIM-PHP/network/members)
[![GitHub watchers](https://img.shields.io/github/watchers/bilgenurpala/minishop-YETGIM-PHP?style=social)](https://github.com/bilgenurpala/minishop-YETGIM-PHP/watchers)

---

<div align="center">

**Made with ❤️ and PHP**

⭐ **Star this repo if you find it helpful!** ⭐

</div>

