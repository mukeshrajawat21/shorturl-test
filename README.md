

# URL Shortener Service (Laravel)

This project is a URL Shortener service built using **Laravel 12** as part of an assignment.


## 📌 Features

- Multi-company support
- Role-based access control
- URL shortening and redirection
- Invitation-based user onboarding
- Secure authentication & authorization

---

## 👥 User Roles

- **SuperAdmin**
- **Admin**
- **Member**
- **Sales**
- **Manager**

---

## 🔐 Role Permissions

### SuperAdmin
- Cannot create short URLs
- Cannot see any short URLs
- Cannot invite Admin in a new company
- Created using database seeder (raw SQL)

### Admin
- Cannot create short URLs
- Can invite **Sales** and **Manager**
- Can see short URLs **not created in their own company**

### Member
- Cannot create short URLs
- Can see short URLs **not created by themselves**

### Sales / Manager
- Can create short URLs
- Can see **only their own short URLs**

---

## ✉️ Invitation Rules

- SuperAdmin **cannot** invite Admin in a new company
- Admin **cannot** invite Admin or Member
- Invitations are sent via email with a one-time registration link

---

## 🔗 URL Shortener Rules

- Only **Sales** and **Manager** can generate short URLs
- Short URLs are **NOT publicly accessible**
- Guest users must login to access short URLs
- Each visit increases hit count

---

## 🛠 Tech Stack

- PHP 8.2
- Laravel 12
- MySQL
- Blade Templates

---

## ⚙️ Setup Instructions

### 1. Clone Repository

```bash
git clone <https://github.com/mukeshrajawat21/shorturl-test>
cd laravelassignmenttest

--------------------------------------*****************Project Setup ***********************------------------------------------

## Setup
1. git clone
2. composer install
3. cp .env.example .env
4. php artisan key:generate
5. php artisan migrate --seed
6. php artisan serve











