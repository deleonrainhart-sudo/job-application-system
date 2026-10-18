CREATE DATABASE IF NOT EXISTS job_application_db;
USE job_application_db;

CREATE TABLE job_applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    contact_number VARCHAR(20) NOT NULL,
    position_applied VARCHAR(100) NOT NULL,
    main_language VARCHAR(50) NOT NULL,
    years_experience INT NOT NULL DEFAULT 0,
    portfolio_link VARCHAR(255),
    status ENUM('Pending', 'Interview', 'Hired', 'Rejected') NOT NULL DEFAULT 'Pending',
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
