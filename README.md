Perfect 👌 thanks for sharing your project structure! Since you want a **lively, interactive, and detailed README.md** with icons, images, and clear explanations, here’s one you can use.

I’ll assume your project is called **Airtime Top-up System (Daraja API + PHP + XAMPP)**.

---

# 📱 Airtime Top-up System (Daraja API + PHP + XAMPP)

![M-Pesa Logo](<img width="1024" height="328" alt="image" src="https://github.com/user-attachments/assets/97656a4a-bc94-4d2b-98ee-b62094a5a2bf" />)

A simple **M-Pesa Airtime Top-up System** built with **PHP** and the **Daraja API**.
Users can:
✅ Enter their phone number and amount.
✅ Initiate an **M-Pesa STK Push**.
✅ See **stylish success/failure messages**.
✅ Admin can view **transaction history** in a **dashboard**.

---

## 📂 Project Structure

Here’s the folder and file layout:

```bash
AIRTIME_TOPUP/
│── callback.php        # Handles M-Pesa callback after payment
│── dashboard.php       # Admin dashboard (overview + links)
│── db.php              # Database connection
│── history.php         # Transaction history page
│── index.php           # Homepage (user top-up form)
│── settings.php        # App configuration (API keys, DB, etc.)
│── sidebar.php         # Sidebar navigation for dashboard
│── stkpush.php         # STK Push integration logic
│── transactions.php    # Displays all saved transactions
```

---

## ⚙️ Features

* 💳 **STK Push Payments** via M-Pesa Daraja API
* 📊 **Admin Dashboard** to track payments
* 🗂 **Transaction History** with receipts and status
* 🎉 **Confetti Animation** on successful payments
* ⏳ **Loading Spinner** during processing
* 🎨 **Modern UI** with CSS animations & hover effects

---

## 🛠️ Setup Instructions

### 1️⃣ Requirements

* ✅ PHP 7+
* ✅ MySQL / MariaDB
* ✅ XAMPP / WAMP
* ✅ M-Pesa Daraja API credentials

---

### 2️⃣ Clone Repository

```bash
git clone https://github.com/yourusername/airtime_topup.git
cd airtime_topup
```

---

### 3️⃣ Database Setup

Import the `transactions` table:

```sql
CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    merchant_request_id VARCHAR(50),
    checkout_request_id VARCHAR(50),
    phone_number VARCHAR(15),
    amount DECIMAL(10,2),
    mpesa_receipt_number VARCHAR(50),
    result_code INT,
    result_desc VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

### 4️⃣ Configure Settings

Edit **`settings.php`** with your Daraja API credentials:

```php
<?php
// Daraja API Configuration
define('CONSUMER_KEY', 'YOUR_CONSUMER_KEY');
define('CONSUMER_SECRET', 'YOUR_CONSUMER_SECRET');
define('SHORTCODE', 'YOUR_SHORTCODE');
define('PASSKEY', 'YOUR_PASSKEY');
define('CALLBACK_URL', 'http://localhost/airtime_topup/callback.php');

// Database Configuration
$host = "localhost";
$user = "root";
$password = "";
$dbname = "airtime_topup";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```

---

## 🎨 UI Previews

### 🏠 Home Page

Users enter phone + amount.

![Home Screenshot](https://dummyimage.com/600x300/4caf50/ffffff\&text=Home+Page)

---

### 📊 Dashboard

Admin view with sidebar navigation.

![Dashboard Screenshot](https://dummyimage.com/600x300/2196f3/ffffff\&text=Admin+Dashboard)

---

### 💰 Transactions History

Styled table of all payments.

![Transactions Screenshot](https://dummyimage.com/600x300/f44336/ffffff\&text=Transactions+History)

---

## 🚀 How to Access

* **User Page (Home)** → [http://localhost/airtime\_topup/index.php](http://localhost/airtime_topup/index.php)
* **Admin Dashboard** → [http://localhost/airtime\_topup/dashboard.php](http://localhost/airtime_topup/dashboard.php)
* **Transactions** → [http://localhost/airtime\_topup/transactions.php](http://localhost/airtime_topup/transactions.php)

---

## 👨‍💻 Author

Made with ❤️ by **\Emmanuel M Jesse**
🌍 Kenya | 💡 Open to collaboration

---

## 📜 License

This project is licensed under the **MIT License** – free to use and modify.

---

✨ Pro Tip: For production, deploy on **Apache/Nginx server** and secure your Daraja API credentials.

---

👉 Do you want me to also create a **GIF animation demo** (fake preview showing confetti + STK push flow) so the README looks even more interactive?
