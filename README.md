# Simple Blog Platform

A simple and responsive blogging platform built using *PHP, **MySQL, **HTML, **CSS, and **Bootstrap 4*. This project allows users to manage blog content with features like create, edit, delete, and view posts.

## 🚀 Features

- 📝 Add, edit, and delete blog posts
- 📂 Upload and display blog images
- 🧩 Bootstrap 4 responsive design
- 🛠 Clean, modular PHP structure 
- 🗃 MySQL database with included SQL file

## 🗂 Project Structure
```
Simple_Blog_Platform/
├── assets/vendors/           # External CSS and JS libraries
├── uploads/                  # Uploaded blog images
├── blog.sql                  # MySQL database structure and sample data
├── connection.php            # Database connection script
├── create.php                # Page to create new blog post
├── delete.php                # Page to delete blog post
├── edit.php                  # Page to edit existing post
└── index.php                 # Homepage to list all blog posts
```



## 🛠 Installation Guide

### 1. Clone the Repository

```bash
git clone https://github.com/revachavhan/Simple_Blog_Platform.git
cd Simple_Blog_Platform

2. Setup the Database

Open phpMyAdmin or any MySQL GUI tool

Create a new database named: blog

Import the blog.sql file provided in the repository


3. Configure DB Connection

Open connection.php and edit the following lines if needed:

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'blog';

4. Run the Project

Use XAMPP, WAMP, or any local PHP server and open in your browser:

http://localhost/Simple_Blog_Platform/index.php
