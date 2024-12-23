# PHP Authentification Dashboard




## Ändern der Dateien

| Originaldateiname  | => |  Neuerdateiname   |
|---                 |--- |---                |
| database.move.php  | => |  database.php     |
| mailer.move.php    | => |  mailer.php  |

## SQL Datei

importieren der SQL Datei oder folgendes im Datenbankprogramm ausführen

``` sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    is_active TINYINT(1) DEFAULT 0,
    activation_token VARCHAR(64),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE permissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role ENUM('user', 'admin'),
    permission_name VARCHAR(50) NOT NULL
);

CREATE TABLE profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    bio TEXT,
    profile_picture VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

## Badges

![Coded with](https://img.shields.io/badge/Coded%20with-VS%20Code-ffffff?labelColor=ff0000&style=plastic)
![Created in](https://img.shields.io/badge/Created%20in-Germany-ff00ff?labelColor=ff0000&style=plastic)
![Powered](https://img.shields.io/badge/Powered%20by-LaurasWorld-ffffff?labelColor=ff0000&style=plastic)
