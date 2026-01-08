# PHP Core MVC Mini Apps (Docker: Nginx + PHP-FPM + MySQL)

This repo contains **4 separate Core PHP MVC apps**, each with its own **Nginx + PHP-FPM** containers.
They are designed to connect to your **existing MySQL container** (already running elsewhere).

Apps:
- `login-app`   (register/login/logout + protected dashboard)
- `todo-app`    (simple todo CRUD)
- `contact-app` (contact form + DB storage + admin listing page)
- `csv-app`     (upload CSV -> store rows in DB -> preview latest batch)

## Prereqs
- Docker + Docker Compose
- An existing MySQL container running on a Docker network that these apps can join.

## 1) Create/choose a shared Docker network
If you already have one, use it. Otherwise:

```bash
docker network create appnet
```

## 2) Configure DB connection for each app
Each app has its own `.env`. Set:
- `DOCKER_NETWORK` = the shared network name (e.g., `appnet`)
- `DB_HOST` = the **service/container name** of your MySQL on that network (e.g., `mysql`)
- `DB_NAME`, `DB_USER`, `DB_PASS`

## 3) Run an app
Example (todo-app):

```bash
cd todo-app
docker compose up --build
```

Open:
- Todo app: http://localhost:8082

## Database tables
SQL for all tables is provided in `sql/schema_all.sql`.
Run it once in your DB (phpMyAdmin, mysql CLI, etc).

---

### Ports
- login-app:   8081
- todo-app:    8082
- contact-app: 8083
- csv-app:     8084
