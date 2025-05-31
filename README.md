# 📘 Laravel 12 Facebook Friend System

A Laravel 12 application that allows users to log in via Facebook, search for users, send and accept friend requests (with email notifications), view mutual friends, and retrieve a list of friends via an authenticated API.

---

## ⚙️ Requirements

- PHP 8.2+
- Composer
- Laravel 12
- MySQL / SQLite
- Facebook Developer Account

---

## 🚀 Features

-  Facebook login using Laravel Socialite
-  User search by name or email
-  Friend request system (with email notification via Log)
-  Accept friend requests
-  View mutual friends
-  API token authentication with Sanctum
-  API endpoint to retrieve authenticated user's friends

---

## 🛠️ Setup Instructions

### 1. Clone and Install Dependencies

git clone https://github.com/pankajpriney34/laravelfaceapp.git


## API ENDPOINTS
1. POST /api/login (FOR LOGIN)
2. GET /api/friends (for retrieve user friends)