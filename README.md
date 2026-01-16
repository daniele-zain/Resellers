## Demo Video

https://github.com/user-attachments/assets/18dc53c7-9cac-4555-8db4-a8cf9dddfb27



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
```
