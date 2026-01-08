# Using with your existing MySQL container

These apps assume you already have a MySQL container running on a Docker network.

## Steps
1) Put your MySQL container on a network (example: appnet):
```bash
docker network create appnet
docker network connect appnet <your-mysql-container-name>
```

2) For each app, set `.env`:
- DOCKER_NETWORK=appnet
- DB_HOST=<your-mysql-container-name-or-service-on-that-network>
- DB_NAME, DB_USER, DB_PASS

3) Run schema (once) in your DB:
Use `sql/schema_all.sql`

4) Run an app:
```bash
cd todo-app
docker compose up --build
```
