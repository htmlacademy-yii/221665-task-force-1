CREATE DATABASE IF NOT EXISTS task_library
    CHARACTER SET utf8;
USE task_library;

DROP TABLE IF EXISTS cities;
DROP TABLE IF EXISTS statuses;
DROP TABLE IF EXISTS categories;

DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS tasks;

DROP TABLE IF EXISTS responses;
DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS messages;

DROP TABLE IF EXISTS files;
DROP TABLE IF EXISTS photos;
DROP TABLE IF EXISTS favorites;
DROP TABLE IF EXISTS users_categories;

CREATE TABLE cities
(
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR (50) NOT NULL
);

CREATE TABLE statuses
(
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR (50) NOT NULL
);

CREATE TABLE categories
(
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR (50) NOT NULL,
  icon VARCHAR (50) NOT NULL
);

CREATE TABLE users
(
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR (50) NOT NULL,
  city_id INT,
  avatar VARCHAR (50) NOT NULL,
  email VARCHAR (50) NOT NULL,
  phone VARCHAR (50) NOT NULL,
  skype VARCHAR (50),
  telegram VARCHAR (50),
  birthday DATE,
  password VARCHAR (50) NOT NULL,
  about TEXT,
  popularity BIGINT,
  activity DATETIME,
  settings INTEGER,
  FOREIGN KEY (city_id) REFERENCES cities (id)
		ON DELETE SET NULL
		ON UPDATE SET NULL
);

CREATE TABLE favorites
(
    user_id INT NOT NULL,
    selected_user_id INT NOT NULL,
    CONSTRAINT favorites_pk PRIMARY KEY (user_id, selected_user_id),
    FOREIGN KEY (user_id) REFERENCES users (id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (selected_user_id) REFERENCES users (id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE users_categories
(
    user_id INT NOT NULL,
    category_id INT NOT NULL,
    CONSTRAINT users_categories_pk PRIMARY KEY (user_id, category_id),
    FOREIGN KEY (user_id) REFERENCES users (id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories (id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE photos
(
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  photo_src VARCHAR (50) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users (id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE tasks
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    status_id INT NOT NULL,
    title VARCHAR(50) NOT NULL,
    text TEXT,
    customer_id INT NOT NULL,
    executor_id INT,
    category_id INT NOT NULL,
    address TEXT,
    city_id INT,
    longitude FLOAT,
    latitude FLOAT,
    budget BIGINT,
    deadline DATE
);

CREATE TABLE files
(
  id INT AUTO_INCREMENT PRIMARY KEY,
  task_id INT,
  file_src VARCHAR (50) NOT NULL,
  FOREIGN KEY (task_id) REFERENCES tasks (id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE comments
(
  id INT AUTO_INCREMENT PRIMARY KEY,
  task_id INT,
  text TEXT,
  score INT,
  FOREIGN KEY (task_id) REFERENCES tasks (id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE responses
(
  id INT AUTO_INCREMENT PRIMARY KEY,
  text TEXT,
  task_id INT NOT NULL,
  user_id INT NOT NULL,
  status_id INT,
  price BIGINT,
  FOREIGN KEY (status_id) REFERENCES statuses (id)
		ON DELETE SET NULL
		ON UPDATE SET NULL,
  FOREIGN KEY (user_id) REFERENCES users (id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
  FOREIGN KEY (task_id) REFERENCES tasks (id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE messages
(
  id INT AUTO_INCREMENT PRIMARY KEY,
  task_id INT NOT NULL,
  user_id INT NOT NULL,
  status_id INT,
  timestamp TIMESTAMP,
  text TEXT,
  FOREIGN KEY (status_id) REFERENCES statuses (id)
		ON DELETE SET NULL
		ON UPDATE SET NULL,
  FOREIGN KEY (user_id) REFERENCES users (id)
		ON DELETE CASCADE
		ON UPDATE CASCADE,
  FOREIGN KEY (task_id) REFERENCES tasks (id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);
