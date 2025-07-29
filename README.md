# 🛒 Top Selling Products for WooCommerce

A lightweight, developer-friendly WordPress plugin that displays the **top 12 best-selling WooCommerce products from the past 7 days** in both the **WordPress admin panel** and the **frontend** using a simple shortcode.

---

## 📦 Features

- ✅ Displays top 12 products sold in the last 7 days
- 🛍️ Product details shown:
  - Product name
  - Product image
  - Product price
  - Quantity sold
  - Link to edit the product (in admin)
- 🧩 Shortcode for frontend: `[top_selling_products]`
- 💡 Supports simple and variable products
- 🧑‍💻 Clean, object-oriented code using WooCommerce and WordPress best practices

---

## 🔌 Installation

1. Download the plugin as a `.zip` file or clone the repository:
   ```
   git clone https://github.com/your-username/top-selling-products.git
   ```

2. Upload the plugin folder to the `/wp-content/plugins/` directory via FTP or use **Plugins → Add New → Upload Plugin**.

3. Activate the plugin through the **Plugins** menu in WordPress.

---

## 🚀 Usage

### 🔧 Admin Panel

- Go to **WooCommerce → Top Selling Products** to see the top-selling products based on the last 7 days of paid orders.

### 🌐 Frontend Shortcode

Use the following shortcode in any **post**, **page**, or **widget**:

```
[top_selling_products]
```

It displays a grid of the top 12 selling products over the last 7 days.

---

## 📁 Plugin Structure

```
top-selling-products/
├── includes/
│   ├── class-top-selling-products-admin.php
│   └── class-top-selling-products-frontend.php
├── top-selling-products.php
├── README.md
└── LICENSE
```

---

## 🛠 Requirements

- WordPress 5.5 or higher
- WooCommerce 4.0 or higher
- PHP 7.2 or higher

---

## 📃 License

This project is licensed under the [MIT License](LICENSE).

---

## 🤝 Contributing

Contributions, issues, and feature requests are welcome!  
Feel free to open a pull request or submit an issue on GitHub.

---

## 📧 Author

Developed by Matin Sabernezhad
📬 matintzh@gmail.com
🌐 https://matinsaber.com

---

## 📷 Screenshots (optional)

You can add screenshots here later, like:

- Admin panel display of top-selling products
- Frontend grid using the `[top_selling_products]` shortcode

---

## ⭐️ Show Your Support

If you find this plugin helpful, please consider giving it a ⭐️ on GitHub or sharing it with others in the WordPress community!
