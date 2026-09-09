# Laboratory Exercise No. 5

## Marrow's Pantry CRUD

This LavaLust application provides authenticated product inventory management:

- `GET /login` and `POST /login`
- `GET /products` - list products
- `GET|POST /products/create` - add a product
- `GET|POST /products/edit/{id}` - edit a product
- `POST /products/delete/{id}` - delete a product
- `GET /logout` - destroy the session

Every product route is protected by the session check in `ProductController::before_action()`.

## Navicat / Aiven setup

1. Create the Aiven MySQL service and database.
2. Open `sql/lab5_setup.sql` in Navicat and run it against `defaultdb`. The script supports both a fresh database and the existing Lab 4 users table.
3. Demo accounts:
	- Admin: username `admin`, password `123` - full product CRUD and user creation.
	- User: username `user`, password `123` - product list access only.
	Change both passwords before production use.
4. Confirm the `products` table and starter rows in Navicat.

If the application reports `Table 'defaultdb.users' doesn't exist`, run `sql/fix_defaultdb_users.sql` directly in Navicat while connected to `defaultdb`. This is a recovery script for databases where the earlier Lab 4 setup was run against a different database name.

## Local environment

Copy `.env.example` to `.env` and set:

```env
APP_KEY=use-a-long-random-secret
APP_ENV=development
DB_HOST=localhost
DB_PORT=3306
DB_USERNAME=root
DB_PASSWORD=
DB_NAME=mydb
DB_SSL_CA=
COOKIE_SECURE=false
```

For Aiven, use the host, port, database name, username, and password from the Aiven connection information. Set `DB_SSL_CA` to the downloaded Aiven `ca.pem` path when required.

Run locally with:

```text
php -S localhost:8000 -t public public/index.php
```

## Render environment variables

Set these as Render Environment Variables. Do not commit them to GitHub:

```text
APP_KEY=<long-random-secret>
APP_ENV=production
DB_HOST=<aiven-host>
DB_PORT=<aiven-port>
DB_USERNAME=<aiven-username>
DB_PASSWORD=<aiven-password>
DB_NAME=<aiven-database>
DB_SSL_CA=/app/app/config/ca.pem
DB_SSL_VERIFY=false
COOKIE_SECURE=true
```

The Aiven CA certificate is bundled at `app/config/ca.pem`; the application also falls back to that file when `DB_SSL_CA` contains a local Windows path. The included `Dockerfile` starts LavaLust on Render's `$PORT` and installs `pdo_mysql`.
