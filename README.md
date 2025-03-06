# Customer Management System

A Laravel-based application for managing customers, contacts, and sales records. This system allows businesses to track customer information, manage their contacts, record sales transactions, and generate sales reports.

## 📋 Features

### 👥 Customer Management
- **CRUD Operations**: Create, read, update, and delete customer records
- **Search Functionality**: Find customers by name or email
- **Detailed Views**: See customer details with associated contacts and sales
- **Grouping**: Organize customers by location or category

### 📞 Contact Management
- **Contact CRUD**: Manage contact records for each customer
- **Relationship Management**: View contacts associated with specific customers

### 💰 Sales Management
- **Transaction Recording**: Log sales with date, customer, quantity, and price
- **Sales History**: View detailed sales records
- **Reporting**: Generate comprehensive sales reports by time period and customer
- **Metrics Tracking**: Monitor sales quantities and revenue

## 🔧 Technical Requirements

- PHP 8.2+
- Laravel 12.0
- MySQL/MariaDB, PostgreSQL, or SQLite
- Composer

## 🚀 Installation

1. **Clone the repository**:
   ```bash
   git clone [repository-url]
   cd customer-management-system
   ```

2. **Install dependencies**:
   ```bash
   composer install
   ```

3. **Set up environment variables**:
   ```bash
   cp .env.example .env
   ```

4. **Generate application key**:
   ```bash
   php artisan key:generate
   ```

5. **Configure database connection** in the `.env` file:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations and seed** the database:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Start the development server**:
   ```bash
   php artisan serve
   ```

8. **Access** the application at `http://localhost:8000`

## 📊 Database Structure

### Customers Table
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| name | string | Customer name |
| email | string | Unique email |
| phone | string | Contact number |
| address | text | Physical address |
| location | string | City or region |
| category | string | Business category |
| created_at | timestamp | Creation date |
| updated_at | timestamp | Last update date |

### Contacts Table
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| customer_id | bigint | Foreign key to customers |
| name | string | Contact name |
| email | string | Contact email |
| phone | string | Contact number |
| created_at | timestamp | Creation date |
| updated_at | timestamp | Last update date |

### Sales Table
| Column | Type | Description |
|--------|------|-------------|
| id | bigint | Primary key |
| customer_id | bigint | Foreign key to customers |
| sale_date | date | Date of sale |
| quantity | integer | Number of items sold |
| total_price | decimal | Total sale amount |
| notes | text | Optional notes |
| created_at | timestamp | Creation date |
| updated_at | timestamp | Last update date |

## 🔗 Routes

### Customer Routes
| Method | URI | Description |
|--------|-----|-------------|
| GET | `/customers` | List all customers |
| GET | `/customers/create` | Show customer creation form |
| POST | `/customers` | Store a new customer |
| GET | `/customers/{customer}` | Show a specific customer |
| GET | `/customers/{customer}/edit` | Show customer edit form |
| PUT/PATCH | `/customers/{customer}` | Update a specific customer |
| DELETE | `/customers/{customer}` | Delete a specific customer |
| GET | `/customers/group` | Group customers by location or category |

### Contact Routes
| Method | URI | Description |
|--------|-----|-------------|
| GET | `/customers/{customer}/contacts` | List all contacts for a customer |
| GET | `/customers/{customer}/contacts/create` | Show contact creation form |
| POST | `/customers/{customer}/contacts` | Store a new contact |
| GET | `/customers/{customer}/contacts/{contact}` | Show a specific contact |
| GET | `/customers/{customer}/contacts/{contact}/edit` | Show contact edit form |
| PUT/PATCH | `/customers/{customer}/contacts/{contact}` | Update a specific contact |
| DELETE | `/customers/{customer}/contacts/{contact}` | Delete a specific contact |

### Sales Routes
| Method | URI | Description |
|--------|-----|-------------|
| GET | `/sales` | List all sales |
| GET | `/sales/create` | Show sale creation form |
| POST | `/sales` | Store a new sale |
| GET | `/sales/{sale}` | Show a specific sale |
| GET | `/sales/{sale}/edit` | Show sale edit form |
| PUT/PATCH | `/sales/{sale}` | Update a specific sale |
| DELETE | `/sales/{sale}` | Delete a specific sale |
| GET | `/sales-report` | Generate sales reports |

## 💻 Development

### Asset Compilation
The project uses Laravel Vite with TailwindCSS for frontend assets:

1. **Install Node.js dependencies**:
   ```bash
   npm install
   ```

2. **Compile assets for development**:
   ```bash
   npm run dev
   ```

3. **Build for production**:
   ```bash
   npm run build
   ```

### Testing
Run the test suite with:
```bash
php artisan test
```

## 👤 Default User
After seeding, you can log in with:
- **Email**: test@example.com
- **Password**: password

## 📝 License
This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
