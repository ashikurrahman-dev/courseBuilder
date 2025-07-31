# 🎓 Course Builder Web Application

A Laravel-based web application that allows users to create **courses** with multiple **modules**, and each module can contain multiple **contents**. All data is stored in the database using efficient Eloquent relationships.

---

## 🚀 Project Objective

The main goal of this project is to build a webpage that allows:

- ✅ **Category Management** (CRUD)
- ✅ **Course Creation**
- ✅ **Multiple Modules** (inside each course)
- ✅ **Multiple Contents** (inside each module)
- ✅ **Multiple Contents** (Dunamic data)

---

## 🛠️ Setup Instructions

Follow the steps below to set up and run the project locally:

### 1. 📦 Clone the Repository

```bash
git clone (https://github.com/ashikurrahman-dev/courseBuilder.git
cd courseBuilder
```

### 2. ⚙️ Install Dependencies

```bash
composer install
npm install
```

### 3. 🧪 Environment Setup

Copy the example `.env` file and update your configuration:

```bash
cp .env.example .env
php artisan key:generate
```

### 4. 🧰 Database Migration & Seeding

```bash
php artisan migrate --seed
```

### 5. 🔗 Link Storage

```bash
php artisan storage:link
```

### 6. 🧾 Compile Frontend Assets

```bash
npm run dev
```

### 7. 🚴 Run the Project

```bash
php artisan serve
```
Or using Laravel Herd
http://coursebuilder.test/

