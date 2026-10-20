
-- QuizHub Database
CREATE DATABASE IF NOT EXISTS quizhub_db;
USE quizhub_db;

-- Table 1: Users (both students and admins live here)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,       -- stored as a secure hash, never plain text
    role ENUM('admin','student') DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table 2: Categories (e.g. "General Knowledge", "Web Development")
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

-- Table 3: Quizzes (each quiz belongs to a category)
CREATE TABLE quizzes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    category_id INT,
    duration_minutes INT DEFAULT 5,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Table 4: Questions (each question belongs to one quiz)
CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    quiz_id INT NOT NULL,
    question_text TEXT NOT NULL,
    option_a VARCHAR(255) NOT NULL,
    option_b VARCHAR(255) NOT NULL,
    option_c VARCHAR(255) NOT NULL,
    option_d VARCHAR(255) NOT NULL,
    correct_option ENUM('A','B','C','D') NOT NULL,
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE
);

-- Table 5: Results (one row per quiz attempt)
CREATE TABLE results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    quiz_id INT NOT NULL,
    score INT NOT NULL,
    total_questions INT NOT NULL,
    attempted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id)
);
-- Sample data so you have something to test with right away

INSERT INTO categories (name) VALUES ('General Knowledge'), ('Web Development');

INSERT INTO quizzes (title, category_id, duration_minutes) VALUES
('GK Basics', 1, 2),
('HTML & CSS Basics', 2, 3);

INSERT INTO questions (quiz_id, question_text, option_a, option_b, option_c, option_d, correct_option) VALUES
(1, 'What is the capital of France?', 'Berlin', 'Madrid', 'Paris', 'Rome', 'C'),
(1, 'Which planet is known as the Red Planet?', 'Earth', 'Mars', 'Jupiter', 'Venus', 'B'),
(1, 'How many continents are there on Earth?', '5', '6', '7', '8', 'C'),
(2, 'What does HTML stand for?', 'Hyper Trainer Marking Language', 'HyperText Markup Language', 'Hyper Text Marketing Language', 'None of these', 'B'),
(2, 'Which tag is used for the largest heading?', '<h6>', '<heading>', '<h1>', '<head>', 'C'),
(2, 'Which property changes text color in CSS?', 'font-color', 'text-color', 'color', 'background-color', 'C');
