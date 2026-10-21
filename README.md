# QuizHub — Online Quiz & Assessment Management System

A full-stack web-based quiz and assessment management application developed during the **Zynvex Solutions Full Stack Development Internship, Batch 4**.

QuizHub enables students to register, attempt timed multiple-choice quizzes, receive automatic scores, track their quiz history, and view leaderboard rankings. Administrators can manage quiz categories, quizzes, questions, and platform activity.

**GitHub Repository:** [QuizHub Source Code](https://github.com/sasrashah33-ctrl/QuizHub-Online-Quiz-Assessment-Management-System)

**Project Status:** Completed five-module internship project. Designed to run locally using XAMPP, PHP, and MySQL.

## Overview

QuizHub brings online assessment workflows together in one web application. It provides separate Student and Admin roles, quiz management, timed assessments, automatic scoring, results, attempt history, and a leaderboard.

## Features

- **Authentication:** User registration and login using hashed passwords and PHP sessions.
- **Role-Based Access:** Separate Student and Admin roles with restricted access to administrative pages.
- **Quiz Categories:** Organize quizzes into categories such as General Knowledge and Web Development.
- **Quiz Management:** Create quizzes, configure durations, and delete quizzes.
- **Question Management:** Add multiple-choice questions with four options and a correct answer.
- **Timed Assessments:** JavaScript countdown timer with automatic submission when time expires.
- **Automatic Scoring:** Calculate scores using PHP and save results in MySQL.
- **Results:** Display quiz scores and total questions.
- **Attempt History:** Review previous quiz attempts.
- **Leaderboard:** Display the Top 10 rankings using MySQL queries and joins.
- **Admin Dashboard:** View totals for quizzes, questions, students, and quiz attempts.

## Technology Stack

| Layer | Technologies | Purpose |
|---|---|---|
| Frontend | HTML5, CSS3 | Page structure and styling |
| Client-side scripting | JavaScript | Countdown timer and interactive behavior |
| Backend | PHP | Authentication, sessions, quiz logic, and scoring |
| Database | MySQL | Store users, quizzes, questions, and results |
| Database administration | phpMyAdmin | Database management |
| Local server | XAMPP, Apache | Run the application locally |
| Version control | Git, GitHub | Source code management |

## Architecture

```text
Student / Admin
      |
      v
HTML + CSS + JavaScript
      |
      v
PHP Application
      |
      +------ Authentication
      +------ Quiz Management
      +------ Quiz Scoring
      +------ Results and History
      +------ Admin Dashboard
      |
      v
MySQL Database
      |
      +------ Users
      +------ Categories
      +------ Quizzes
      +------ Questions
      +------ Results
```

The frontend provides the user interface, PHP processes application requests and quiz submissions, and MySQL stores application data. JavaScript manages the countdown timer and triggers automatic submission when time expires.

## Module-Wise Development

### Module 1 — Project Setup & Authentication

- Set up the project structure and MySQL database.
- Created the `quizhub_db` database.
- Implemented user registration and login.
- Stored passwords as hashes.
- Used PHP sessions to maintain authenticated access.
- Implemented logout functionality.

**Main files:** `database.sql`, `config.php`, `register.php`, `login.php`, `logout.php`

### Module 2 — Admin Panel & Content Management

- Created the admin dashboard.
- Implemented quiz category management.
- Added quiz creation and duration settings.
- Developed forms for adding MCQ questions and correct answers.
- Implemented quiz deletion and management.
- Styled the admin interface using CSS.

**Main files:** `admin/dashboard.php`, `add_quiz.php`, `add_question.php`, `manage_quizzes.php`, `css/style.css`

### Module 3 — Student Quiz Attempt & Scoring

- Displayed available quizzes to students.
- Created the quiz-taking interface.
- Implemented a JavaScript countdown timer.
- Added automatic submission when time expires.
- Calculated quiz scores using PHP.
- Saved quiz attempts and scores in MySQL.

**Main files:** `index.php`, `quiz.php`, `submit_quiz.php`, `js/timer.js`

### Module 4 — Results, History & Leaderboard

- Developed the quiz result page.
- Created a history page for previous attempts.
- Implemented a Top 10 leaderboard.
- Used MySQL joins to retrieve related records.
- Connected quiz attempts with users and quizzes.

**Main files:** `result.php`, `history.php`, `leaderboard.php`

### Module 5 — Final Testing & Completion

- Tested student registration and login.
- Verified quiz timer and automatic submission.
- Checked score calculations and result storage.
- Tested quiz history and leaderboard.
- Tested admin quiz and question management.
- Checked that students could not access admin pages.
- Documented testing and finalized the README.

**Main files:** Complete QuizHub project, `TESTING.md`, `README.md`

## Database Design

QuizHub uses a MySQL database named `quizhub_db` with five related tables.

| Table | Purpose |
|---|---|
| `users` | Stores names, email addresses, hashed passwords, and roles. |
| `categories` | Stores quiz categories. |
| `quizzes` | Stores quiz titles, categories, and durations. |
| `questions` | Stores question text, four options, correct answers, and quiz associations. |
| `results` | Stores attempts, users, quizzes, scores, total questions, and dates. |

## Getting Started

### Requirements

- XAMPP with Apache and MySQL
- PHP included with XAMPP
- A web browser
- Git (optional)

### 1. Clone the Repository

```bash
git clone https://github.com/sasrashah33-ctrl/QuizHub-Online-Quiz-Assessment-Management-System.git
```

### 2. Configure the Project

Copy the project folder into your XAMPP `htdocs` directory:

```text
C:\xampp\htdocs\quizhub
```

If the cloned folder has a different name, use that name in the local URL or rename it to `quizhub`.

### 3. Start Apache and MySQL

1. Open the XAMPP Control Panel.
2. Start Apache.
3. Start MySQL.

### 4. Import the Database

1. Open [phpMyAdmin](http://localhost/phpmyadmin).
2. Select the **Import** tab.
3. Choose the project's `database.sql` file.
4. Click **Go** to import the database and tables.

Ensure the database settings in `config.php` match your local MySQL configuration.

### 5. Run the Application

Open the registration page:

```text
http://localhost/quizhub/register.php
```

Create an account and log in to start using QuizHub.

### 6. Access the Admin Panel

For local development, you can change your own account's role to `admin` through phpMyAdmin. Log out and log in again to load the updated role.

Only grant administrative access to trusted accounts.

## Testing Summary

The project documentation records the following tests:

- Student registration and successful login.
- Countdown timer and automatic quiz submission.
- Score calculation and saving results in MySQL.
- Quiz history and leaderboard display.
- Admin quiz creation, question management, and quiz deletion.
- Restriction of admin pages for student accounts.

## Security Notes

- Store passwords using secure password hashing and verify them during login.
- Protect administrative pages with server-side role checks.
- Validate user input before processing database operations.
- Use prepared statements to reduce SQL injection risks.
- Keep database credentials and configuration files private.
- Test access permissions for both Student and Admin roles.

## Future Improvements

Potential enhancements for future versions include:

- Password reset and email verification.
- Detailed performance analytics and progress charts.
- Additional question types and difficulty levels.
- Improved mobile responsiveness.
- Enhanced administrative reports and filtering.
- Deployment to a hosting service for online access.

These are proposed improvements, not claims about existing functionality.

## Internship Context

QuizHub was developed over five modules during the **Zynvex Solutions Internship Program — Batch 4**, under the Full Stack Development track.

The project demonstrates practical experience with frontend development, PHP server-side programming, relational database design, authentication, role-based access control, SQL queries, quiz processing, testing, and GitHub version control.

**Developed by:** Syeda Asra Shah  
**Internship Organization:** Zynvex Solutions  
**Program:** Full Stack Development  
**Batch:** 04  
**Project:** QuizHub — Online Quiz & Assessment Management System

---

*QuizHub is an educational and portfolio project developed to demonstrate full-stack web development skills.*
