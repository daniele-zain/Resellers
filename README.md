
<img width="1080" height="1920" alt="product detail" src="https://github.com/user-attachments/assets/3c338c77-8eab-400b-b40f-3707ad2d9af9" />
<img width="1080" height="1920" alt="products" src="https://github.com/user-attachments/assets/b6aa92de-67c2-4127-9715-9f2cfca98139" />
<img width="1080" height="1920" alt="add review" src="https://github.com/user-attachments/assets/f2c0d373-8e3f-40d2-9866-dd1108738160" />
<img width="1080" height="1920" alt="search" src="https://github.com/user-attachments/assets/560dcbc0-2af2-46c5-9edb-636bac892cff" />
<img width="1080" height="1920" alt="cart" src="https://github.com/user-attachments/assets/64d59f1b-daea-4690-a2c7-bc9cb9eb1009" />
<img width="1080" height="1920" alt="favorite" src="https://github.com/user-attachments/assets/597e3e92-0333-41bf-b98c-3552bb86b6c7" />
<img width="1080" height="1920" alt="comment" src="https://github.com/user-attachments/assets/4592f3b4-22e8-4696-b957-d792488232d4" />
<img width="1080" height="1920" alt="profile" src="https://github.com/user-attachments/assets/23f85494-d33b-415e-9666-34c45de47062" />


# ♻️ Resellers – E-commerce Platform for Used Products

## 📱 Project Overview
**Resellers** is a mobile-based e-commerce platform designed for buying and selling **used products**.  
The application provides a user-friendly marketplace where users can list items, browse products, and manage transactions efficiently.

The system consists of a **Flutter mobile application** for end users and a **Laravel backend with an admin dashboard** for managing users, products, and platform operations.

---

## 🚀 Features

### 👤 User Features (Mobile App)
- Browse and search used products
- Filter products by category, price range, and condition
- View detailed product information
- User-friendly mobile interface optimized for Android
- Secure communication with backend via REST APIs

### 🛠️ Admin Features (Backend Dashboard)
- Manage user accounts
- Approve and manage product listings
- Monitor platform activity and transactions
- Centralized control panel built with Laravel

---

## 🏗️ System Architecture
- **Mobile App:** Flutter (Android)
- **Backend API:** Laravel (RESTful APIs)
- **Admin Dashboard:** Laravel (Web-based)
- **Database:** MySQL

The mobile application communicates with the backend using REST APIs to fetch and manage data securely.

---

## 🛠️ Tech Stack

### Mobile Application
- Flutter
- Dart

### Backend
- Laravel
- PHP
- RESTful APIs

### Database
- MySQL

---

## ⚙️ Installation & Setup

### Backend Setup
```bash
git clone https://github.com/your-username/resellers-backend.git
cd resellers-backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
