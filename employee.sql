-- Create the database
CREATE DATABASE IF NOT EXISTS Emp_recruitment;

-- Use the database
USE Emp_recruitment;

-- 1️⃣ Create Users Table
CREATE TABLE Users (
    userId INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL
);

-- 2️⃣ Create Post Table
CREATE TABLE Post (
    postId INT AUTO_INCREMENT PRIMARY KEY,
    postName VARCHAR(100) NOT NULL
);

-- 3️⃣ Create Candidates Table
CREATE TABLE Candidates (
    C_ID INT AUTO_INCREMENT PRIMARY KEY,
    C_firstname VARCHAR(100) NOT NULL,
    C_lastname VARCHAR(100) NOT NULL,
    C_Gender VARCHAR(10),
    C_DateOfBirth DATE,
    PhoneNumber VARCHAR(20),
    PostId INT,
    FOREIGN KEY (PostId) REFERENCES Post(postId)
);

-- 4️⃣ Create CandidateResult Table
CREATE TABLE CandidateResult (
    CR_Id INT AUTO_INCREMENT PRIMARY KEY,
    C_ID INT,
    ExamDate DATE,
    CR_marks DECIMAL(5,2),
    CR_decision VARCHAR(50),
    FOREIGN KEY (C_ID) REFERENCES Candidates(C_ID)
);


-- Insert sample users
INSERT INTO Users (username, password) VALUES
('admin', 'admin123'),
('hr_manager', 'hr2024'),
('recruiter1', 'pass456');

-- Insert sample posts
INSERT INTO Post (postName) VALUES
('Software Developer'),
('System Administrator'),
('Accountant'),
('Graphic Designer');

-- Insert sample candidates
INSERT INTO Candidates (C_firstname, C_lastname, C_Gender, C_DateOfBirth, PhoneNumber, PostId) VALUES
('John', 'Doe', 'Male', '1990-05-20', '0788123456', 1),
('Jane', 'Smith', 'Female', '1995-10-12', '0722345678', 2),
('Eric', 'Johnson', 'Male', '1993-07-15', '0733123456', 3),
('Linda', 'Williams', 'Female', '1998-02-25', '0799876543', 1);

-- Insert sample candidate results
INSERT INTO CandidateResult (C_ID, ExamDate, CR_marks, CR_decision) VALUES
(1, '2025-04-15', 85.5, 'Passed'),
(2, '2025-04-16', 78.0, 'Passed'),
(3, '2025-04-17', 62.5, 'Passed'),
(4, '2025-04-18', 45.0, 'Failed');
