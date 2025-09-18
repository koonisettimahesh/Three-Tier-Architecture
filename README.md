Here is a creative and thorough README file for your "Three Tier Architecture" project based on your steps and best documentation practices.

***

# Three Tier Architecture Project

A simple web application demonstration using AWS EC2, RDS (MySQL/MariaDB), and a segregated architecture for frontend, backend, and database services.

***

## Architecture Overview

This project uses a three-tier model:
- **Frontend:** Handles user interactions (serves an HTML login/signup form via Apache2).
- **Backend:** Processes logic (PHP/Apache2 apps communicate with the DB).
- **Database:** AWS RDS running MySQL/MariaDB for persistent storage.

***

## Getting Started

### 1. Launch Cloud Instances

- Deploy **three EC2 Ubuntu Linux instances**:
  - `frontend`
  - `backend`
  - `database`

***

### 2. Provision RDS Database

- Use **Standard Create** in AWS RDS.
- **Engine:** MySQL/MariaDB (latest version).
- **Template:** Free Tier or Sandbox.
- **Deployment:** Single-AZ (one instance only).
- **DB Identifier:** `identifierName`
- **Master username:** `admin`
- **Master password:** `password`
- **Storage:** SSD, amount per project needs.
- **Public access:** NO (for security).
- **No EC2 integration needed**.
- [x] Click *Create Database*.

***

### 3. Security Groups

- **Frontend:** Allow TCP 80, 22
- **Backend:** Allow TCP 80, 22, 3306
- **Database:** Allow TCP 22, 3306
- **RDS:** Allow all traffic on 3306

***

### 4. Configure Frontend Server

**Setup:**
```bash
sudo su
apt update
apt install apache2 -y
systemctl start apache2
systemctl enable apache2
chmod 777 /var/www/html
```
**Replace `/var/www/html/index.html`** with the provided login/signup HTML. Update `backendUrl` in the JS to point to the backend server.

***

### 5. Configure Backend Server

**Setup:**
```bash
sudo su
apt update
apt install apache2 -y
systemctl start apache2
systemctl enable apache2
chmod 777 /var/www/html
apt install php libapache2-mod-php php-mysql -y
php -v
```
**Deploy Files:**
- Copy the PHP files: `db.php`, `login.php`, `signup.php` into `/var/www/html`.
- Configure `db.php` with your RDS endpoint and credentials.

***

### 6. Setup Database Server

**Install MySQL client on Database EC2 (for management):**
```bash
sudo su
apt update
apt install mysql-client -y
mysql --version
mysql -h [RDS-ENDPOINT] -P 3306 -u admin -p
```

**Database Initialization:**
```sql
CREATE DATABASE user_db;
USE user_db;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);
```

***

### 7. Restart and Test

- Run `systemctl restart apache2` on Frontend for changes to take effect.

***

### 8. Try It Out!

- Open a browser: Visit `http://[Frontend-IP]` for signup/login.
- Test the flow:
  - Signup as a new user
  - Login as the same user
- Use `SELECT * FROM users;` in MySQL to see new users.

***

## Files Overview

- **Frontend**
  - `index.html` — Login/signup HTML+JS
- **Backend**
  - `db.php` — Database connection
  - `login.php` — User auth
  - `signup.php` — User registration
- **Database**
  - `user_db.users` — Application DB table

***

## Security & Best Practices

- **Passwords** are hashed using bcrypt in PHP
- **RDS** not public, accessed only from backend
- **Ports** are tightly controlled with security groups
- **Configurable** endpoint: change backend IP in frontend as needed

***

## Extending This Project

- Add password reset/email verification.
- Use HTTPS for frontend/backend servers.
- Enable auto scaling for each tier.
- Implement monitoring & alerting with AWS CloudWatch.

***

## Author

- Project template by [Your Name]
- Inspired by AWS and open-source best practices

***

> For any issues, raise a pull request or open an issue in this repository!

---

[1](https://docs.aws.amazon.com/AmazonRDS/latest/UserGuide/CHAP_GettingStarted.CreatingConnecting.MariaDB.html)
[2](https://aws.amazon.com/blogs/database/connect-to-mysql-and-mariadb-from-amazon-aurora-and-amazon-rds-for-postgresql-using-the-mysql_fdw-extension/)
[3](https://aws.amazon.com/blogs/database/create-linked-server-access-to-amazon-rds-for-mysql-and-amazon-rds-for-mariadb/)
[4](https://docs.aws.amazon.com/AmazonRDS/latest/UserGuide/USER_ConnectToMariaDBInstance.html)
[5](https://www.youtube.com/watch?v=PY5otQe1mEs)
[6](https://docs.aws.amazon.com/AmazonRDS/latest/UserGuide/CHAP_MariaDB.html)
[7](https://fivetran.com/docs/connectors/databases/mariadb/rds-setup-guide)
[8](https://docs.aws.amazon.com/AmazonRDS/latest/UserGuide/CHAP_GettingStarted.html)
[9](https://clickhouse.com/docs/integrations/clickpipes/mysql/source/rds_maria)
