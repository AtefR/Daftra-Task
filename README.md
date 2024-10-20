# About Project
This project is a task for Daftra.

# Available API End-Points

## Login

```http
POST /api/login
```

| Parameter  | Type     | Description            |
|:-----------|:---------|:-----------------------|
| `email`    | `string` | **Required**. Email    |
| `password` | `string` | **Required**. Password |

#### Response
```javascript
{
    "access_token": "2|dGuPO75N1Kq5W3DN9XKSeNbnrppC3v0oK7eRthpi4c2b9599"
}
```

## Register

```http
POST /api/register
```

| Parameter               | Type     | Description                         |
|:------------------------|:---------|:------------------------------------|
| `name`                  | `string` | **Required**. Name                  |
| `email`                 | `string` | **Required**. Email                 |
| `password`              | `string` | **Required**. Password              |
| `password_confirmation` | `string` | **Required**. Password Confirmation |

#### Response
```javascript
{
    "user": {
        "name": "test",
            "email": "test@mail.com",
            "updated_at": "2024-10-20T22:06:47.000000Z",
            "created_at": "2024-10-20T22:06:47.000000Z",
            "id": 1
    },
    "access_token": "1|wwENcBLFPiaye55wa27fBiXu1Pmx3QUZfyekMRcgda3abdf1"
}
```

## Products

```http
GET /api/products
```
#### Response
```javascript
{
    "current_page": 1,
        "data": [
        {
            "id": 1,
            "name": "Krista Bechtelar",
            "description": "Maxime beatae temporibus quam nobis quisquam. Saepe voluptatum voluptas id praesentium. Itaque dicta optio eaque fugiat. Ut assumenda neque excepturi.",
            "price": "216.00",
            "created_at": "2024-10-20T22:25:29.000000Z",
            "updated_at": "2024-10-20T22:25:29.000000Z"
        },
        ...
    ],
        "first_page_url": "https://daftra-task.test/api/products?page=1",
        "from": 1,
        "last_page": 1,
        "last_page_url": "https://daftra-task.test/api/products?page=1",
        "links": [
        {
            "url": null,
            "label": "&laquo; Previous",
            "active": false
        },
        {
            "url": "https://daftra-task.test/api/products?page=1",
            "label": "1",
            "active": true
        },
        {
            "url": null,
            "label": "Next &raquo;",
            "active": false
        }
    ],
        "next_page_url": null,
        "path": "https://daftra-task.test/api/products",
        "per_page": 10,
        "prev_page_url": null,
        "to": 10,
        "total": 10
}
```


## Create Order

```http
POST /api/orders
```

| Parameter             | Type      | Description                     |
|:----------------------|:----------|:--------------------------------|
| `products`            | `array`   | **Required**. Array of products |
| `products.*.id`       | `integer` | **Required**. Product id        |
| `products.*.quantity` | `integer` | **Required**. Quantity          |

#### Response
```javascript
{
    "id": 17,
        "total": 3570,
        "user_id": 1,
        "products": [
        {
            "id": 1,
            "name": "Krista Bechtelar",
            "description": "Maxime beatae temporibus quam nobis quisquam. Saepe voluptatum voluptas id praesentium. Itaque dicta optio eaque fugiat. Ut assumenda neque excepturi.",
            "price": "216.00",
            "quantity": "2.00",
            "created_at": "2024-10-20T22:25:29.000000Z",
            "updated_at": "2024-10-20T22:25:29.000000Z"
        },
        ...
    ],
        "created_at": "2024-10-20T22:35:49.000000Z",
        "updated_at": "2024-10-20T22:35:49.000000Z"
}
```

# Tests
tests are located in `tests` folder and are written in [Pest](https://pestphp.com/), to run tests:

```bash
./vendor/bin/pest
```
