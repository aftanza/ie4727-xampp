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
3. Open `phpMyAdmin` in your browser by navigating to `http://localhost/phpmyadmin`.
4. Create a new database with the same name (`xampp_db`).
5. Import the `xampp_db.sql` file into the newly created database:
    - Click on the database name in phpMyAdmin.
    - Select the `Import` tab.
    - Upload the `xampp_db.sql` file and execute the import.
