# Laravel CV Management System

### Requirements:
- **Laravel**: 11  
- **PHP**: 8.2  

### Setup Instructions:

1. **Install Dependencies**  
   Run the following command to install required dependencies:  
   ```bash
   composer install
   ```

2. **Set Up the Database**  
   Update your `.env` file with the following database credentials:  
   ```env
   DB_DATABASE=cv_management
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. **Run Migrations**  
   Execute the following command to create the database tables:  
   ```bash
   php artisan migrate
   ```

4. **Seed the Database**  
   Populate the database with sample data using the command:  
   ```bash
   php artisan db:seed
   ```

### Notes:
- Ensure your local environment meets the Laravel 11 and PHP 8.2 requirements.  
- For additional configurations, refer to the official [Laravel documentation](https://laravel.com/docs).  

---
