CREATE DATABASE IF NOT EXISTS task_library;
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
  id SERIAL PRIMARY KEY,
  title VARCHAR (50) NOT NULL
);

CREATE TABLE statuses
(
  id SERIAL PRIMARY KEY,
  title VARCHAR (50) NOT NULL
);

CREATE TABLE categories
(
  id SERIAL PRIMARY KEY,
  title VARCHAR (50) NOT NULL
);

CREATE TABLE users
(
  id SERIAL PRIMARY KEY,
  name VARCHAR (50) NOT NULL,
  city_id INTEGER,
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
    user_id INTEGER NOT NULL,
    selected_user_id INTEGER NOT NULL,
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
    user_id INTEGER NOT NULL,
    category_id INTEGER NOT NULL,
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
  id SERIAL PRIMARY KEY,
  user_id INTEGER,
  photo_src VARCHAR (50) NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users (id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE tasks
(
    id SERIAL PRIMARY KEY,
    status_id INTEGER NOT NULL,
    title VARCHAR(50) NOT NULL,
    text TEXT,
    customer_id INTEGER NOT NULL,
    executor_id INTEGER,
    category_id INTEGER NOT NULL,
    address TEXT,
    city_id INTEGER,
    longitude FLOAT,
    latitude FLOAT,
    budget BIGINT,
    deadline DATE
);

CREATE TABLE files
(
  id SERIAL PRIMARY KEY,
  task_id INTEGER,
  file_src VARCHAR (50) NOT NULL,
  FOREIGN KEY (task_id) REFERENCES tasks (id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE comments
(
  id SERIAL PRIMARY KEY,
  task_id INTEGER,
  text TEXT,
  score INTEGER,
  FOREIGN KEY (task_id) REFERENCES tasks (id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

CREATE TABLE responses
(
  id SERIAL PRIMARY KEY,
  text TEXT,
  task_id INTEGER NOT NULL,
  user_id INTEGER NOT NULL,
  status_id INTEGER,
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
  id SERIAL PRIMARY KEY,
  task_id INTEGER NOT NULL,
  user_id INTEGER NOT NULL,
  status_id INTEGER,
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
