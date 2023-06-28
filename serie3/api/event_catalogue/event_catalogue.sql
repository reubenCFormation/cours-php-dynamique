
CREATE TABLE if not exists users(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    firstname VARCHAR (100) NOT NULL,
    lastname VARCHAR (100) NOT NULL,
    email VARCHAR (100) NOT NULL,
    password VARCHAR (100) NOT NULL
);

CREATE TABLE if not exists events(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    title VARCHAR (255) NOT NULL,
    description TEXT NOT NULL,
    category VARCHAR (100),
    capacity INT NOT NULL,
    user_id INT NOT NULL,
    registration_date DATE not null,
    FOREIGN KEY (user_id)
    REFERENCES users(id)
    ON DELETE CASCADE 
    
);

CREATE TABLE if not exists ticket(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL 
    FOREIGN KEY (user_id)
    REFERENCES users (id)
    ON DELETE CASCADE 
    event_id INT NOT NULL,
    FOREIGN KEY (event_id) 
    REFERENCES events (id) 
    ON DELETE CASCADE
    
);