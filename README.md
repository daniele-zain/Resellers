
<img width="300" alt="product detail" src="https://github.com/user-attachments/assets/3c338c77-8eab-400b-b40f-3707ad2d9af9" />
<img width="300" alt="products" src="https://github.com/user-attachments/assets/b6aa92de-67c2-4127-9715-9f2cfca98139" />
<img width="300" alt="add review" src="https://github.com/user-attachments/assets/f2c0d373-8e3f-40d2-9866-dd1108738160" />
<img width="300" alt="search" src="https://github.com/user-attachments/assets/560dcbc0-2af2-46c5-9edb-636bac892cff" />
<img width="300" alt="cart" src="https://github.com/user-attachments/assets/64d59f1b-daea-4690-a2c7-bc9cb9eb1009" />
<img width="300" alt="favorite" src="https://github.com/user-attachments/assets/597e3e92-0333-41bf-b98c-3552bb86b6c7" />
<img width="300" alt="comment" src="https://github.com/user-attachments/assets/4592f3b4-22e8-4696-b957-d792488232d4" />
<img width="300" alt="profile" src="https://github.com/user-attachments/assets/23f85494-d33b-415e-9666-34c45de47062" />

<img width="300" alt="reviews 2" src="https://github.com/user-attachments/assets/50f8b4c9-7aa0-4194-9d0a-08fd464bdf32" />
<img width="300" alt="settings" src="https://github.com/user-attachments/assets/d305a0a5-e86a-486c-975e-0d38d465f5d4" />
<img width="300" alt="reviews" src="https://github.com/user-attachments/assets/d9a4a55b-aee9-4756-a632-f0a6c72657bc" />

<img width="600" alt="Admin Dashboard Orders" src="https://github.com/user-attachments/assets/3c239d75-2034-42bf-95cb-fc766d65f43a" />
<img width="600" alt="Admin Dashboard Users" src="https://github.com/user-attachments/assets/5e0dda96-0e8e-4786-82bc-bd6c48f66543" />


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
