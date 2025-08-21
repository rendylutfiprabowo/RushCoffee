# ☕ Rush Coffee Web Application

A web application that assists cashiers and admins in recording sales and monitoring daily transactions at **Rush Coffee**.

---

## ✨ Features

### 👩‍💼 Admin

* 🛒 **Pemesanan**: Manage customer orders.
* 📜 **Riwayat**: View history of transactions.
* 💰 **Keuangan**: Monitor and manage financial records.
* 🍔 **Menu**: Manage available menu items.
* 👤 **Akun Kasir**: Manage cashier accounts.

### 🧑‍💻 Cashier

* 🛒 **Pemesanan**: Create and manage orders.
* 📜 **Riwayat**: View transaction history.

---

## ⚙️ Installation

1. 📦 Unzip `node_modules.zip`.
2. 📂 Move the `node_modules` folder into `/RushCoffee`.
3. 🧩 Run `composer install`.
4. ⚙️ Configure the `.env` file according to your environment.
5. 🔑 Generate the application key:

   ```bash
   php artisan key:generate
   ```
6. 🗄️ Run database migrations:

   ```bash
   php artisan migrate
   ```
7. 🌱 Seed the database:

   ```bash
   php artisan db:seed
   ```
8. 🚀 Serve the application:

   ```bash
   php artisan serve
   ```

---

## 🛠️ Tools & Technologies

* **Framework**: Laravel 11

* **PHP**: ^8.2

* **Packages**:

  * 📄 `barryvdh/laravel-dompdf`
  * ⚡ `laravel/tinker`
  * 🛠️ `laravel/breeze`

* **Development Tools**:

  * 🎲 `fakerphp/faker`
  * 🧪 `phpunit/phpunit`
  * 🧩 `mockery/mockery`
  * 💥 `nunomaduro/collision`
  * ⛴️ `laravel/sail`

* **Autoloading**: PSR-4 for `App`, `Database\Factories`, and `Database\Seeders`.

---

## 👨‍💻 Developer

🧑‍💻 **Rendy Lutfi Prabowo**
GitHub: [github.com/rendylutfiprabowo](https://github.com/rendylutfiprabowo)

---

## 📜 License

This project is free to use and modify as needed.
---
