# IE4727 Project

## Prerequisites

-   [XAMPP](https://www.apachefriends.org/index.html) installed on your machine.

## Setup Instructions

### 1. XAMPP Configuration

1. Navigate to the `__custom_configs` folder in the project directory.
2. Copy the provided XAMPP configuration file.
3. Replace the corresponding configuration files in your XAMPP installation directory with the copied file. Ensure you back up your existing configuration files before making changes.
4. Restart XAMPP to apply the new configurations.

### 2. SQL Database Setup

1. Locate the SQL database file (`xampp_db.sql`) in the `__db` folder.
2. Open the XAMPP Control Panel and start the `MySQL` service.
3. Open `phpMyAdmin` in your browser by navigating to `http://localhost:3000/phpmyadmin`.
4. Create a new database with the same name (`xampp_db`).
5. Import the `xampp_db.sql` file into the newly created database:
    - Click on the database name in phpMyAdmin.
    - Select the `Import` tab.
    - Upload the `xampp_db.sql` file and execute the import.

### 3. HTDocs Setup

1. Locate the project folder in your local machine.
2. Copy the entire project folder into the `htdocs` directory inside your XAMPP installation directory (usually located at `C:\xampp\htdocs` on Windows or `/opt/lampp/htdocs` on Linux/Mac).
3. Verify the project files are in place by navigating to `http://localhost:3000` in your browser.

## Additional Notes

-   The web application should run on port `3000`
-   The database should run on port `3306`
