
docker-compose up --build

docker exec -it app php artisan migrate

api available on: http://localhost:88/api/v1

request:
curl --location 'http://localhost:88/api/v1/payments' \
--header 'Content-Type: application/json' \
--data '{
"user_id": 2,
"amount": 15.77,
"method": "card"
}'

response:
{"id":6,"user_id":2,"amount":"15.77","method":"card","status":"failed","created_at":"2025-06-19 23:16:11"}
