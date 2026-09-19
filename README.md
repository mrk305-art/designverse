# 🎨 DesignVerse

**DesignVerse** is a full-stack creative design-sharing platform built with **Laravel**. It provides a dedicated space where designers can showcase their work, build profiles, discover other creatives, interact with designs, and organize their favorite content.

The platform includes separate experiences for **Designers, Clients, and Administrators**, with role-based functionality and a responsive interface.

---

## ✨ Features

### 👨‍🎨 Designer Features

* Create and manage a designer profile
* Upload and manage design projects
* Add multiple images to designs
* Edit and delete published designs
* View design statistics
* Manage followers and following
* Save and organize designs into collections
* View public designer profiles
* Receive notifications
* Manage profile information

### 👤 Client Features

* Browse published designs
* Explore designers
* View designer profiles
* Like designs
* Save designs
* Create and manage collections
* Follow designers
* View followers and following
* Manage personal profile
* Receive notifications
* Report inappropriate content

### 🛡️ Admin Features

* Admin dashboard
* User management
* Designer/client management
* Category management
* Design moderation
* Reports management
* Review reported designs
* Admin activity tracking

---

## 🖼️ Main Platform Areas

### Home

A modern landing page featuring:

* Hero section
* Featured designs
* Popular designers
* Design categories
* Call-to-action sections
* Responsive navigation

### Explore

Discover creative work through the platform's design exploration interface.

### Designer Profiles

Public profiles allow visitors to view:

* Designer information
* Portfolio
* Published designs
* Followers
* Following
* Profile details

### Collections

Users can organize saved designs into custom collections for easier management.

---

## 🧩 User Roles

| Role         | Main Capabilities                                                           |
| ------------ | --------------------------------------------------------------------------- |
| **Designer** | Create portfolio, upload designs, manage followers and collections          |
| **Client**   | Explore designs, follow designers, like/save designs and create collections |
| **Admin**    | Manage users, categories, designs, reports and platform activity            |

---

## 🛠️ Technologies Used

### Backend

* **PHP**
* **Laravel**
* **MySQL**
* Laravel Eloquent ORM
* Laravel Blade

### Frontend

* HTML5
* CSS3
* JavaScript
* Tailwind CSS
* Vite

### Development Tools

* Composer
* Node.js
* npm
* Git
* GitHub

---

## 🗄️ Database Structure

DesignVerse uses a relational MySQL database with dedicated tables for the platform's main functionality.

Some of the major entities include:

* Users
* Profiles
* Designs
* Design Images
* Categories
* Likes
* Comments
* Saves
* Follows
* Collections
* Notifications
* Reports
* Admin Activities

The application uses Laravel migrations and Eloquent relationships to manage the database structure.

---

## 🔐 Authentication & Authorization

DesignVerse includes authentication and role-based access control.

Different users receive access to functionality based on their assigned role:

```text
Guest
  │
  ├── Browse public content
  │
  ▼
Authenticated User
  │
  ├── Client
  │
  └── Designer

Administrator
  │
  └── Admin Dashboard
```

---

## 📱 Responsive Design

The interface is designed to work across different screen sizes, including:

* Desktop
* Laptop
* Tablet
* Mobile

The project also includes responsive navigation, dashboards, sidebars, cards and profile layouts.

---

## 🌙 UI Features

* Modern dashboard interfaces
* Dark mode
* Responsive sidebar
* Responsive navigation
* Dropdown menus
* Notification system
* Profile interfaces
* Design cards
* Collection interfaces
* Interactive UI components

---

## 🚀 Installation

### 1. Clone the repository

```bash
git clone https://github.com/mrk305-art/designverse.git
```

### 2. Navigate to the project

```bash
cd designverse
```

### 3. Install PHP dependencies

```bash
composer install
```

### 4. Create environment file

```bash
cp .env.example .env
```

On Windows PowerShell, you can use:

```powershell
Copy-Item .env.example .env
```

### 5. Generate application key

```bash
php artisan key:generate
```

### 6. Configure the database

Create a MySQL database and update your `.env` file:

```env
DB_DATABASE=designverse
DB_USERNAME=root
DB_PASSWORD=
```

Adjust the database credentials according to your local environment.

### 7. Run migrations

```bash
php artisan migrate
```

If seed data is available:

```bash
php artisan db:seed
```

### 8. Install frontend dependencies

```bash
npm install
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

The application will normally be available at:

```text
http://127.0.0.1:8000
```

---

## 📁 Project Structure

```text
designverse/
│
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   ├── Middleware/
│   │   └── Requests/
│   │
│   ├── Models/
│   └── Providers/
│
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
│
├── public/
│   ├── designs/
│   └── profiles/
│
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│
├── routes/
│   ├── web.php
│   ├── auth.php
│   └── console.php
│
├── tests/
├── composer.json
├── package.json
└── vite.config.js
```

---

## 📸 Screenshots

Screenshots can be added here to showcase the main interfaces.

### Home Page

*Add screenshot here*

### Designer Dashboard

*Add screenshot here*

### Explore Designs

*Add screenshot here*

### Designer Profile

*Add screenshot here*

### Admin Dashboard

*Add screenshot here*

---

## 🎯 Project Goals

DesignVerse was created to explore the development of a complete creative platform rather than a simple CRUD application.

The project focuses on:

* Role-based application architecture
* Authentication and authorization
* Relational database design
* Eloquent relationships
* CRUD operations
* File/image management
* Social interactions
* Notifications
* Collections
* Admin moderation
* Responsive UI development

---

## 🧠 What I Practiced

Through this project, I worked with:

* Laravel MVC architecture
* Controllers and Models
* Blade templates
* Eloquent relationships
* Laravel migrations
* Middleware
* Form validation
* Authentication
* Authorization
* Database relationships
* CRUD functionality
* Responsive frontend development
* JavaScript interactions
* Git and GitHub

---

## 🔮 Future Improvements

Possible future improvements include:

* Real-time notifications
* Advanced design search
* Filtering and sorting
* Designer analytics
* Improved image optimization
* Social sharing
* Advanced moderation tools
* REST API
* Deployment to production
* Automated testing expansion

---

## 📌 Project Status

**Status:** Completed / Portfolio Project

The project is actively available on GitHub for development, experimentation and further improvements.

---

## 👨‍💻 Developer

**Rehan Arshad**

Web Developer focused on:

* Laravel
* PHP
* MySQL
* JavaScript
* HTML
* CSS

GitHub:
https://github.com/mrk305-art

---

## 📄 License

This project is intended for learning, portfolio and development purposes.
