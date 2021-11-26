### Steps

- Clone this repository
- Run `docker-compose up -d`
- Run 
```
docker exec vehicle_loans_api php artisan migrate:fresh --seed
docker exec vehicle_loans_api php artisan serve --host=0.0.0.0 --port=8000
```

and

```
docker exec vehicle_loans_frontend npm run serve
```
- Open your browser at http://localhost:8080
