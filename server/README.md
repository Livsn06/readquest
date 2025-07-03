# ReadQuest: AI-Powered Language Learning App for Grade 4 to 6 Students

## About The Project

An AI-Powered Language Learning Application that serves as a reading supplement for Grades 4 to 6 at Urdaneta I Central School in enhancing the reading experience of the students..

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP >= 8.1
- Composer
- A database server (e.g., MariaDB, MySQL, PostgreSQL, SQLite)

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/sample/repo
   cd readquest
   ```

2. **Install PHP dependencies:**

   ```bash
   composer install
   ```

3. **Set up your environment file:**

   - Copy the environment file to the root folder:
     ```bash
     cp .env
     ```
   - Create a System Database:
     ```bash
      php databases/config/create_database.php
     ```

4. **Run database migrations and seeders:**
   ```bash
      vendor/bin/phinx migrate -e development
   ```
