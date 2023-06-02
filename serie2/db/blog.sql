CREATE table if not exists users(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR (100) NOT NULL,
    role VARCHAR(100)

);

CREATE table if not exists articles(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    is_active TINYINT(1) DEFAULT 1,
    photo TEXT,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users (id)

);

CREATE TABLE if not exists comments(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    comment TEXT NOT NULL,
    is_active TINYINT(1) DEFAULT 1,
    article_id INT,
    FOREIGN KEY (article_id) REFERENCES articles (id)
);

CREATE TABLE if not exists categories (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR (100)
);

CREATE TABLE if not exists categories_articles(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    article_id INT,
    category_id INT,
    FOREIGN KEY (article_id) REFERENCES articles (id),
    FOREIGN KEY (category_id) REFERENCES categories (id)
);
