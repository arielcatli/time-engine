CREATE DATABASE time_engine;

-- DROP DATABASE time_engine;

USE time_engine;

CREATE TABLE IF NOT EXISTS employee(
	id int(10) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    middle_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    address VARCHAR(200) NOT NULL,
    barangay VARCHAR(200) NOT NULL,
    city VARCHAR(100) NOT NULL,
    province VARCHAR(100) NOT NULL,
    zip VARCHAR(10) NOT NULL,
    gender VARCHAR(1) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    role VARCHAR(20) NOT NULL,
    birth_day varchar(5),
    birth_month varchar(20),
    birth_year varchar(10),
    time_status varchar(10)
);

CREATE TABLE IF NOT EXISTS time_records(
	id int(10) AUTO_INCREMENT PRIMARY KEY,
    employee_id int(10) NOT NULL,
    timed_at datetime NOT NULL,
    time_type varchar(10),
    FOREIGN KEY (employee_id) REFERENCES employee(id)
); 

CREATE TABLE IF NOT EXISTS login_records(
	id int(10) AUTO_INCREMENT PRIMARY KEY,
    employee_id int(10) NOT NULL,
    logged_in_at datetime NOT NULL,
    FOREIGN KEY (employee_id) REFERENCES employee(id)
); 

INSERT into employee (username, password, first_name, middle_name, last_name, address, barangay, city, province, zip, gender, phone, role, birth_day, birth_month, birth_year, time_status)
VALUES ('admin_login@timeengine.com', 'root', 'Jessica', 'Morning', 'Day', 'P. Sherman', 'Walloughby Oakwoods', 'Taguig', 'Metro Manila', '77842', 'F', '+639741154478', 'administrator', '07', '14', '1985', 'out');
