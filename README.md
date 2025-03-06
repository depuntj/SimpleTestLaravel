A Laravel-based application for managing customers, contacts, and sales records. This system allows businesses to track customer information, manage their contacts, record sales transactions, and generate sales reports.
Features
Customer Management

Create, read, update, and delete customer records
Search for customers by name or email
View customer details with associated contacts and sales
Group customers by location or category

Contact Management

Create, read, update, and delete contact records for each customer
View contacts associated with specific customers

Sales Management

Record sales transactions with date, customer, quantity, and price
View sales details and history
Generate sales reports by time period and customer
Track sales metrics including quantity and revenue

Technical Requirements

PHP 8.2+
Laravel 12.0
MySQL/MariaDB, PostgreSQL, or SQLite
Composer

Installation

Clone the repository:
git clone https://github.com/depuntj/SimpleTestLaravel.git
cd customer-management-system

Install dependencies:
Copycomposer install

Copy the example environment file and configure your environment variables:
Copycp .env.example .env

Generate application key:
Copyphp artisan key:generate

Configure your database connection in the .env file:
CopyDB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

Run migrations and seed the database with sample data:
Copyphp artisan migrate
php artisan db:seed

Start the development server:
Copyphp artisan serve

Access the application at http://localhost:8000

Database Structure
Customers Table

id (primary key)
name (string)
email (string, unique)
phone (string)
address (text)
location (string)
category (string)
created_at (timestamp)
updated_at (timestamp)

Contacts Table

id (primary key)
customer_id (foreign key)
name (string)
email (string)
phone (string)
created_at (timestamp)
updated_at (timestamp)

Sales Table

id (primary key)
customer_id (foreign key)
sale_date (date)
quantity (integer)
total_price (decimal)
notes (text, nullable)
created_at (timestamp)
updated_at (timestamp)

Routes
Customer Routes

GET /customers - List all customers
GET /customers/create - Show customer creation form
POST /customers - Store a new customer
GET /customers/{customer} - Show a specific customer
GET /customers/{customer}/edit - Show customer edit form
PUT/PATCH /customers/{customer} - Update a specific customer
DELETE /customers/{customer} - Delete a specific customer
GET /customers/group - Group customers by location or category

Contact Routes

GET /customers/{customer}/contacts - List all contacts for a customer
GET /customers/{customer}/contacts/create - Show contact creation form
POST /customers/{customer}/contacts - Store a new contact
GET /customers/{customer}/contacts/{contact} - Show a specific contact
GET /customers/{customer}/contacts/{contact}/edit - Show contact edit form
PUT/PATCH /customers/{customer}/contacts/{contact} - Update a specific contact
DELETE /customers/{customer}/contacts/{contact} - Delete a specific contact

Sales Routes

GET /sales - List all sales
GET /sales/create - Show sale creation form
POST /sales - Store a new sale
GET /sales/{sale} - Show a specific sale
GET /sales/{sale}/edit - Show sale edit form
PUT/PATCH /sales/{sale} - Update a specific sale
DELETE /sales/{sale} - Delete a specific sale
GET /sales-report - Generate sales reports
