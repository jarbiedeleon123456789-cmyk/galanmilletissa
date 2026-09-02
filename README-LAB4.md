# Laboratory Exercise No. 4 — Notes

## Files added/edited for this lab

- `app/models/UsersModel.php` — model for the `users` table
- `app/controllers/UsersController.php` — loads `UsersModel`, calls `all()`, passes data to the view
- `app/views/users_view.php` — HTML table that loops through `$users`
- `app/config/routes.php` — added `$router->get('/users', 'UsersController::index');`
- `sql/setup.sql` — creates `mydb`, the `users` table, and inserts the 5 sample records
- `app/config/database.php` — added an optional `ssl_ca` key (needed only if you connect to Aiven)
- `scheme/database/Database.php` — added optional SSL support so the PDO connection can use Aiven's `ca.pem` if you set `DB_SSL_CA`
- `.env.example` — fixed `DB_USER` → `DB_USERNAME` so it actually matches what `config/database.php` reads (this was a mismatch in the original template — using `DB_USER` alone would leave your username blank)

## What you still need to do

1. **Database**: Run `sql/setup.sql` in Navicat, on either your Aiven MySQL connection or a local MySQL server.
2. **.env**: `cp .env.example .env`, then run `php lava key:generate`, then fill in `DB_HOST`, `DB_PORT`, `DB_USERNAME`, `DB_PASSWORD`, `DB_NAME=mydb`.
   - Local MySQL: `DB_HOST=localhost`, `DB_USERNAME=root`, `DB_PASSWORD=` (blank), leave `DB_SSL_CA` blank.
   - Aiven MySQL: use the host/port/`avnadmin` from your Aiven Overview page, and set `DB_SSL_CA` to the path of the `ca.pem` you downloaded (only needed if your PDO connection rejects a non-SSL handshake — try without it first).
3. **Run it**: start your PHP server (e.g. `php -S localhost:8000 -t public`) and visit `/users`.
4. **Submission screenshots**: database/table/records, `config/database.php` (hide the password), `UsersModel.php`, `UsersController.php`, `users_view.php`, the route line, and the browser output.
