# 🗂️ My_Dynamic-Portfolio
## 📌 Overview
A fully dynamic, database-driven personal portfolio website built with **PHP**, **MySQL**, and vanilla **HTML/CSS/JavaScript**. Features a public-facing portfolio page and a secure admin dashboard for managing all content — no manual code editing required.

---

![image alt](https://github.com/mtxmln-devs/My_Dynamic-Portfolio/blob/dea235edfe31d7fd32d4cd7e86c5a05d6fd35b20/about.png)

<div align="center">
    <img src= "https://img.shields.io/badge/Xampp-F37623?style=for-the-badge&logo=xampp&logoColor=white" />
    <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" />
    <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" />  
    <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" />
    <img src="https://img.shields.io/badge/JavaScript-323330?style=for-the-badge&logo=javascript&logoColor=F7DF1E" />
</div>

## ✨ Features
### 🌐 Public Portfolio
- Animated hero section with profile photo
- Skill bars with animated progress indicators
- Education & experience timeline
- Featured projects grid with tech tags
- Contact form with live validation
- Fully responsive (mobile-friendly)
- Smooth scroll navigation

### 🔐 Admin Dashboard
- Secure login with session-based authentication
- Manage **Personal Info** (name, bio, email, phone, address, social links)
- Full **CRUD** for Skills, Experience, and Projects
- Flash messages for success/error feedback
- All changes reflected immediately on the public page

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|-----------|
| Frontend | HTML5, CSS3, JavaScript (Vanilla) |
| Backend | PHP 8.2 |
| Database | MySQL / MariaDB (via MySQLi) |
| Server | Apache (XAMPP) |
| Auth | PHP Sessions + bcrypt password hashing |

---

## 📁 File Structure

```
FinalProject_BSIT3C_Taway/
├── admin/
│   ├── add_edit_experience.php     # Add/Edit Experience Form
│   ├── add_edit_project.php        # Add/Edit Project Form
│   ├── add_edit_skill.php          # Add/Edit Skill Form
│   ├── admin_style.css             # Admin Dashboard Styles
│   ├── dashboard.php               # Main Admin Dashboard
│   ├── delete_experience.php       # Delete Experience Handler
│   ├── delete_project.php          # Delete Project Handler
│   ├── delete_skill.php            # Delete Skill Handler
│   ├── footer.php                  # Admin Footer Template
│   ├── header.php                  # Admin Header Template
│   ├── login.php                   # Admin Login Page
│   ├── logout.php                  # Logout Handler
│   ├── manage_experience.php       # Experience Management
│   ├── manage_personal_info.php    # Personal Info Management
│   ├── manage_projects.php         # Projects Management
│   └── manage_skills.php           # Skills Management
|
├── db_connect.php                  # Database Connection & Helper Functions
├── about.png                       # Display photo GitHub
├── index.php                       # Public Portfolio Page
├── style.css                       # Public Portfolio Styles
├── script.js                       # Public Portfolio Scripts
├── pik.png                         # Profile Image
├── portfolio_db.sql                # Database SQL Dump
├── ReadMe.pdf                      # Installation Instructions
├── README.txt                      # Admin Credentials
└── Screenshots.docx                # UI Screenshots
```

---

## ⚙️ Installation

### Prerequisites
- [XAMPP](https://www.apachefriends.org/) (PHP 8.x + Apache + MySQL)
- A web browser

### Steps

**1. Clone or extract the project**
```bash
git clone https://github.com/mtxmlndevs/FinalProject_BSIT3C_Taway.git
```
Or extract the ZIP into your `htdocs` folder:
```
C:\xampp\htdocs\FinalProject_BSIT3C_Taway\
```

**2. Set up the database**
- Open [phpMyAdmin](http://localhost/phpmyadmin)
- Create a new database named `portfolio_db`
- Click **Import** and select `portfolio_db.sql`

**3. Configure the database connection** *(if needed)*

Open `db_connect.php` and update these values to match your setup:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');          // Change if you have a password
define('DB_NAME', 'portfolio_db');
```

**4. Start XAMPP**
- Start **Apache** and **MySQL** from the XAMPP Control Panel

**5. Open in browser**
```
http://localhost/FinalProject_BSIT3C_Taway/index.php
```

---

## 🔑 Admin Access

| Field | Value |
|-------|-------|
| URL | `http://localhost/FinalProject_BSIT3C_Taway/admin/login.php` |
| Username | `admin` |
| Password | `admin123` |

> ⚠️ **Change the default password after your first login in a production environment.**

---

## 🗄️ Database Schema

The database consists of **5 tables**:

| Table | Description | Operations |
|-------|-------------|------------|
| `users` | Admin credentials (bcrypt-hashed passwords) | — |
| `personal_info` | Portfolio owner's info (name, bio, contact, social links) | Update |
| `skills` | Technical skills with proficiency levels (1–100) | Full CRUD |
| `experience` | Work experience and education history | Full CRUD |
| `projects` | Portfolio projects with technologies and URLs | Full CRUD |

---

## 🔒 Security

- ✅ Prepared statements / parameterized queries (SQL injection prevention)
- ✅ Passwords hashed with `password_hash()` using **BCRYPT**
- ✅ Session-based authentication with access control on all admin pages
- ✅ Input sanitization via custom `sanitize_input()` function
- ✅ HTML special characters escaped with `htmlspecialchars()` (XSS prevention)

---

## 📸 Screenshots

Screenshots of all major UI pages are included in `Screenshots.docx`.

Key pages:
- Public portfolio (About, Skills, Education, Projects, Contact)
- Admin Dashboard
- Admin login & management pages

---

## 🚀 Projects Showcased

| Project | Technologies |
|---------|-------------|
| Spelling Bee System | HTML, CSS, JavaScript |
| Quiz System | HTML, CSS, JavaScript |
| Confidence Interval Calculator | HTML, CSS, JavaScript |
| Library Management System | PHP, SQL |

---

## 🎓 About the Developer

**Mark Laurence Taway** is a BSIT student at Camarines Sur Polytechnic Colleges (CSPC), Nabua Campus. A passionate full-stack developer specializing in modern web technologies — blending back-end logic with front-end aesthetics to build clean, efficient digital solutions.

- 🏆 Elementary Valedictorian — Bagumbayan Elementary School
- 🏆 Senior High School Valedictorian — Camarines Science Oriented High School
- 🎓 Currently pursuing BSIT at CSPC (2022 – Present)

---

## 🛠️ Troubleshooting

| Problem | Solution |
|---------|----------|
| Can't login | Verify the database was imported and credentials are correct |
| Database connection error | Check `db_connect.php` settings match your MySQL config |
| Pages not found (404) | Ensure files are in the correct `htdocs` path |
| Changes not reflected | Clear browser cache or press `Ctrl + F5` |
| SQL errors | Confirm all tables were created properly from the SQL dump |

---


