# pizza-delivery-webapp

A full-stack pizza delivery web app built with PHP and MariaDB, containerized with Docker. Features a real-time order tracking system with role-based views for customers, kitchen staff, and delivery drivers — following MVC architecture.

## Tech Stack

- **Backend:** PHP 8 + Apache
- **Database:** MariaDB
- **Admin:** phpMyAdmin
- **Infrastructure:** Docker & Docker Compose

## Features

- Customer order placement with pizza selection
- Kitchen (baker) view to manage incoming orders
- Driver view to track and update deliveries
- Real-time order status updates via REST API

## Project Structure

```
src/
└── Prak/
    ├── index.php          # Customer order page
    ├── baker.php          # Kitchen staff view
    ├── customer.php       # Customer status view
    ├── driver.php         # Driver delivery view
    ├── statusApi.php      # REST API for order status
    └── App/
        ├── Controller/
        ├── Model/
        ├── View/
        └── Core/
```

## Getting Started

### Prerequisites

- [Docker](https://www.docker.com) installed and running

### Setup

1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/pizza-delivery-webapp.git
   cd pizza-delivery-webapp
   ```

2. Create an `env.txt` file in the root directory:
   ```
   MARIADB_ROOT_PASSWORD=your_password
   ```

3. Start the containers:
   ```bash
   make start
   # or
   docker compose up -d
   ```

4. Open [http://localhost/Prak5](http://localhost/Prak5) in your browser.

### Available Ports

| Service    | Port |
|------------|------|
| Web App    | 80   |
| MariaDB    | 3306 |
| phpMyAdmin | 8085 |

### Makefile Commands

| Command        | Description                           |
|----------------|---------------------------------------|
| `make start`   | Start all containers                  |
| `make stop`    | Stop all containers                   |
| `make build`   | Rebuild containers (after DB changes) |
| `make clean`   | Remove all containers                 |
| `make console` | Open shell inside Apache container    |

## Database

The `pizzaservice` database is initialized automatically on first build. Schema files are located in `mariadb/`.

Tables:
- `article` — pizza menu items
- `ordering` — customer orders
- `ordered_article` — items per order

