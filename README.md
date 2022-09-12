# Api Crud User (Lemontech) | Julian Barrera

Proyecto CRUD de Usuarios | Lemontech


## Comandos para iniciar el proyecto

```
cd docker && docker-composer up -d && cd ../
```

```
composer install
```

```
curl -X GET http://localhost:83/run-migration.php
```

## documentación API en el siguiente link

Ver en el siguiente link o ver archivo postman "API_User_Lemontech.postman_collection.json"

https://documenter.getpostman.com/view/4776531/2s7YYoBmsV

## Comandos api curl

### Create user

```
curl --location --request POST 'localhost:83/user' \
--header 'Accept: application/json' \
--data-raw '{
    "name": "Julian",
    "email": "julian110404@gmail.com",
    "password": "123456" 
}'
```

### Show User

```
curl --location --request GET 'localhost:83/user/1'
```


### Lists Users

```
curl --location --request GET 'localhost:83/users'
```


### Update User

```
curl --location --request PUT 'localhost:83/user/1' \
--data-raw '{
    "name": "Julian Barrera"
}'
```

### Delete User

```
curl --location --request DELETE 'localhost:83/user/4'
```