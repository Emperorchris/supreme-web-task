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
- Update User: `PUT /api/v1/users/{id}`
- Delete User: `DELETE /api/v1/users/{id}`

### Wallets
- Get All Wallets: `GET /api/v1/wallets`
- Get Wallet Details: `GET /api/v1/wallets/{id}`
- Create Wallet: `POST /api/v1/wallets`
- Delete Wallet: `DELETE /api/v1/wallets/{id}`
- Transfer Money: `POST /api/v1/wallets/transfer`
- Payload:
    ```json
    {
        "data": {
            "id": 1,
            "sender_wallet": {
                "id": 1,
                "wallet_type": {
                    "id": 1,
                    "name": "Savings",
                    "minimum_balance": "100.00",
                    "monthly_interest_rate": "1.5",
                    "created_at": "2025-01-01T12:00:00.000000Z",
                    "updated_at": "2025-01-15T12:00:00.000000Z"
                },
                "name": "John Doe Wallet",
                "balance": "900.00",
                "created_at": "2025-01-01T12:00:00.000000Z",
                "updated_at": "2025-01-21T12:00:00.000000Z"
            },
            "receiver_wallet": {
                "id": 2,
                "wallet_type": {
                    "id": 1,
                    "name": "Savings",
                    "minimum_balance": "100.00",
                    "monthly_interest_rate": "1.5",
                    "created_at": "2025-01-01T12:00:00.000000Z",
                    "updated_at": "2025-01-15T12:00:00.000000Z"
                },
                "name": "Jane Doe Wallet",
                "balance": "1100.00",
                "created_at": "2025-01-01T12:00:00.000000Z",
                "updated_at": "2025-01-21T12:00:00.000000Z"
            },
            "amount": "100.00",
            "created_at": "2025-01-21T12:00:00.000000Z",
            "updated_at": "2025-01-21T12:00:00.000000Z"
        },
        "message": "Transfer successful"
    }
    ```

### Wallet Types
- Create Wallet Type: `POST /api/v1/wallet_type`
- Delete Wallet Type: `DELETE /api/v1/wallet_type/{id}`

### Policy-Based Authorization
The application uses Laravel Policies to enforce rules. Key policies implemented:
- **Wallet**
  - Only the creator of a wallet can delete it.