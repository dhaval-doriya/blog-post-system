# Role-Based Blog Management System

This project is a role-based blog management system that includes two types of users: **Admin** and **User**.

## Default Admin Setup

- A default admin user is created during system initialization.
- A command is provided to add one default admin user to the database.

## User Authentication

- The system provides functionalities for **forgot password** and **change password**.
- Users can **sign up** with the following information:
  - Name
  - Email
  - Phone

## User Login

- Both Admin and User have the same login page.
- Upon successful login:
  - Users see a list of **pending blogs**.
  - Admins see a list of **all blogs** that need approval.

## Home Page

- The home page displays blogs that are approved by admin.
- Each blog includes the user's name and creation time.
- Active categories are displayed on the left.
- The homepage is divided into three sections:
  - The center section displays the list of approved blogs.
  - The bottom-right section displays recent blogs.
  - The top-right section lists all categories.

## User Module

### Create Blog

- Users can create a blog with the following details:
  - Name
  - Description
  - Category (selectable from a list of categories)

### List of Pending Blogs

- Users can search for pending blogs by name.
- Sorting and filtering options by category are available.
- Users can approve blogs with a confirmation alert.
- Soft delete option is available for deleting blogs.

### Edit Blog

- Users can edit their own blogs.

## Admin Module

### Create Categories

- Admins can perform CRUD operations for categories.
- Categories have the following fields:
  - Id
  - Name
  - Is_active
- Admins cannot delete a category if it has assigned blogs.

### Blog Approval

- On the admin homepage, a list of unapproved blogs is displayed.
- Admins can approve blogs to make them visible on the home page.

### User Operations

- Admins can view a list of users and edit their information.
- Admins can generate a new user, and a registration email is sent to the user's email address.
- Admins can disable users, preventing them from logging into the system.

This project aims to create a robust role-based blog management system with features tailored for both administrators and regular users. It offers a seamless user experience with user-friendly interfaces and efficient functionalities.


## Project Requirement

   -PHP Version 8.2
   -Laravel verion  10
   -node version 14.0+

### steps to run project

    	- Create env file
    	- Create Database
    	php artisan migrate
    	- Admin Will be Automatic Created while Migrate
    	email  : admin@mail.com
    	defult password : admin123

