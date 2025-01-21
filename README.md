# Wallet Management System
A Laravel-based application for managing multiple user wallets with customizable wallet types, secure transactions, and policy-based authorization.

---

## Features
- User authentication via Laravel Sanctum.
- Users can manage wallets and wallet types.
- Wallet types include:
    - Unique names (per user)
    - Minimum balance
    - Monthly interest rate
- Wallet-to-wallet money transfers.
- Authorization policies to secure operations.


## Installation
1. Clone the repository:

    ```git
    git clone <repository-url>
    cd <repository-folder>
    ```
1. Install dependencies:

    ```git
    composer install
    ```
1. Configure .env and run migrations:

    ```git
    cp .env.example .env
    php artisan migrate
    ```

1. Start the development server:

    ```bash
    php artisan serve
    ```

## API Endpoints
All routes are prefixed with /api/v1.

### Authentication
- Register: `POST /api/v1/register`
- Login: `POST /api/v1/login`

### Users
- Get All Users: `GET /api/v1/users`
- Get User Details: `GET /api/v1/users/{id}`

### Wallets
- Get All Wallets: `GET /api/v1/wallets`
- Get Wallet Details: `GET /api/v1/wallets/{id}`
- Transfer Money: `POST /api/v1/wallets/transfer`
- Payload:
    ```json
    {
        "data": {
            "id": 1,
            "sender_wallet": {
                "id": 1,
                "user": {
                    "id": 1,
                    "username": "john_doe",
                    "email": "john@example.com",
                    "created_at": "2025-01-21T00:00:00Z",
                    "updated_at": "2025-01-21T00:00:00Z"
                },
                "wallet_type": {
                    "id": 1,
                    "name": "Standard",
                    "minimum_balance": 100,
                    "monthly_interest_rate": 2.5,
                    "created_at": "2025-01-01T00:00:00Z",
                    "updated_at": "2025-01-01T00:00:00Z"
                },
                "name": "John's Wallet",
                "balance": 1000,
                "created_at": "2025-01-01T00:00:00Z",
                "updated_at": "2025-01-21T00:00:00Z"
            },
            "receiver_wallet": {
                "id": 2,
                "user": {
                    "id": 2,
                    "username": "jane_smith",
                    "email": "jane@example.com",
                    "created_at": "2025-01-21T00:00:00Z",
                    "updated_at": "2025-01-21T00:00:00Z"
                },
                "wallet_type": {
                    "id": 1,
                    "name": "Standard",
                    "minimum_balance": 100,
                    "monthly_interest_rate": 2.5,
                    "created_at": "2025-01-01T00:00:00Z",
                    "updated_at": "2025-01-01T00:00:00Z"
                },
                "name": "Jane's Wallet",
                "balance": 1500,
                "created_at": "2025-01-01T00:00:00Z",
                "updated_at": "2025-01-21T00:00:00Z"
            },
            "amount": 500,
            "created_at": "2025-01-21T00:00:00Z",
            "updated_at": "2025-01-21T00:00:00Z"
        },
        "message": "Transfer successful"
    }   
    ```

### Wallet Types
- Create Wallet Type: `POST /api/v1/wallet_type`
- Delete Wallet Type: `DELETE /api/v1/wallet_type/{id}`