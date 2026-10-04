# QuizHub — Online Quiz & Assessment Management System

## Module 1: Project Setup & Database Pipeline

**Overview**
Module 1 sets up the project structure and builds a secure MySQL database to store users, quizzes, questions, and results, along with registration and login pages in PHP.

**Pipeline Steps**
1. **Project Structure:** Organized the project into a PHP/MySQL folder structure (config, pages, css, js).
2. **Database Design:** Designed a relational MySQL schema with 5 tables — `users`, `categories`, `quizzes`, `questions`, `results` — linked with foreign keys.
3. **Secure Authentication:** Implemented user registration with `password_hash()` and login with `password_verify()`, ensuring passwords are never stored as plain text.
4. **Session Management:** Used PHP sessions to track logged-in users and control access across pages.

---

## Module 2: Admin Panel & Content Management

**Overview**
Module 2 builds the admin-side interface that lets administrators manage quiz content — creating categories, quizzes, and questions, all stored in and retrieved from the MySQL database.

**Admin Panel Steps**
1. **Role-Based Access:** Restricted admin pages to users with `role = 'admin'`, verified via session on every admin page load.
2. **Quiz & Category Management:** Built forms to create new quiz categories and quizzes with configurable duration.
3. **Question Management:** Implemented a form to add multiple-choice questions, storing 4 options and the correct answer per question.
4. **Data Verification:** Validated that quizzes and their linked questions correctly save to and display from the database, with a management view listing live question counts per quiz.
