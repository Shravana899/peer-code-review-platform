CREATE DATABASE IF NOT EXISTS peer_code_review CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE peer_code_review;
DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS submissions;

CREATE TABLE submissions(
 id INT AUTO_INCREMENT PRIMARY KEY,
 student_name VARCHAR(100) NOT NULL,
 title VARCHAR(200) NOT NULL,
 language VARCHAR(50) NOT NULL,
 code LONGTEXT NOT NULL,
 status ENUM('Pending','In Review','Reviewed') DEFAULT 'Pending',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE comments(
 id INT AUTO_INCREMENT PRIMARY KEY,
 submission_id INT NOT NULL,
 reviewer_name VARCHAR(100) NOT NULL,
 comment_type ENUM('General','Line') NOT NULL,
 line_number INT NULL,
 comment TEXT NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(submission_id) REFERENCES submissions(id) ON DELETE CASCADE
);

INSERT INTO submissions(student_name,title,language,code,status) VALUES
('Riya','Test Python Program','Python','def hello():\n    print("Hello, Peer Review!")\n\nhello()','Reviewed'),
('Demo Student','Simple Java Program','Java','public class Main {\n public static void main(String[] args) {\n  System.out.println("Hello");\n }\n}','Pending');

INSERT INTO comments(submission_id,reviewer_name,comment_type,line_number,comment) VALUES
(1,'Peer Reviewer','General',NULL,'Good example. Consider adding input validation for better practice.'),
(1,'Peer Reviewer','Line',2,'Consider using a clear output message for readability.');
