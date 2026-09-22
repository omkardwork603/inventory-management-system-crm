# Inventory Management System CRM

A professional **Inventory Management System CRM** built with **Laravel, PHP, MySQL, Tailwind CSS, and JavaScript**.

This system helps manage products, categories, suppliers, customers, purchases, sales, stock levels, and inventory reports from a centralized dashboard.

<br><br>

# Login


<img width="1366" height="768" alt="Screenshot (202)" src="https://github.com/user-attachments/assets/de463bc5-81dd-48ed-8e40-860f4b1c3847" />

<br><br>

# Dashboard

<img width="1366" height="768" alt="Screenshot (203)" src="https://github.com/user-attachments/assets/788c4ba1-bc8e-4d57-8379-51320d4b8619" />


## 🚀 Features

* 🔐 User Authentication
* 📊 Professional Dashboard
* 📦 Product Management
* 📂 Category Management
* 🏢 Supplier Management
* 👥 Customer Management
* 🛒 Purchase Management
* 💰 Sales Management
* 📉 Stock Management
* ⚠️ Low Stock Alerts
* 🧾 Sales Invoices
* 📈 Sales & Purchase Charts
* 📊 Category Distribution
* 🔎 Search and Filtering
* 📱 Responsive UI
* 👤 User Profile Management

## 🛠️ Technologies

* **Laravel**
* **PHP**
* **MySQL**
* **Blade**
* **Tailwind CSS**
* **JavaScript**
* **Chart.js**
* **Composer**
* **Node.js / npm**

## 📁 Important

The following folders are **not included in this GitHub repository**:

```text
/vendor
/node_modules
```

These folders are generated automatically and should not be uploaded to GitHub.

### Install PHP dependencies

After cloning the project, run:

```bash
composer install
```

### Install Node dependencies

Run:

```bash
npm install
```

This will recreate the `vendor` and `node_modules` dependencies required by the project.

## ⚙️ Installation

### 1. Clone the repository

```bash
git clone https://github.com/YOUR-USERNAME/inventory-management-system-crm.git
```

### 2. Open the project

```bash
cd inventory-management-system-crm
```

### 3. Install Laravel dependencies

```bash
composer install
```

### 4. Install frontend dependencies

```bash
npm install
```

### 5. Create environment file

```bash
cp .env.example .env
```

For Windows CMD:

```cmd
copy .env.example .env
```

### 6. Generate application key

```bash
php artisan key:generate
```

### 7. Configure database

Open the `.env` file and configure your MySQL database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_management
DB_USERNAME=root
DB_PASSWORD=
```

### 8. Run migrations

```bash
php artisan migrate
```

If the project contains seeders:

```bash
php artisan db:seed
```

Or:

```bash
php artisan migrate --seed
```

### 9. Build frontend assets

For development:

```bash
npm run dev
```

For production:

```bash
npm run build
```

### 10. Start Laravel

```bash
php artisan serve
```

Then open:

```text
http://127.0.0.1:8000
```

## 📊 Main Modules

| Module     | Description                     |
| ---------- | ------------------------------- |
| Dashboard  | Inventory and business overview |
| Products   | Manage products and stock       |
| Categories | Manage product categories       |
| Suppliers  | Manage suppliers                |
| Customers  | Manage customers                |
| Purchases  | Record and manage purchases     |
| Sales      | Create and manage sales         |
| Stock      | Track inventory movements       |
| Reports    | View business performance       |
| Profile    | Manage user profile             |

## 📦 Dependency Folders

Do **not** manually upload these folders:

```text
node_modules/
vendor/
```

They are already included in `.gitignore`.

After cloning the repository, recreate them with:

```bash
composer install
npm install
```

## 🔒 Environment

The `.env` file should also **not** be uploaded to GitHub because it may contain database credentials and other private configuration.

Use:

```text
.env.example
```

as the template for creating your local `.env` file.

## 🧑‍💻 Development

Start the Laravel development server:

```bash
php artisan serve
```

Start Vite:

```bash
npm run dev
```

You can run both during development.

## 📌 GitHub Repository Structure

```text
inventory-management-system-crm/
│
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
│
├── .env.example
├── .gitignore
├── artisan
├── composer.json
├── composer.lock
├── package.json
├── package-lock.json
└── README.md
```

The generated dependency directories are intentionally excluded:

```text
❌ node_modules/
❌ vendor/
```

## 📄 License

This project is developed for learning, portfolio, and project development purposes.
