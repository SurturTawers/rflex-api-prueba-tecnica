# rFlex.io-Fluctuación del dólar API

## Ejecución
### DB MySQL 
* Se ha utilizado MySQL
* DB Name: **rflex_dolar**
* Crear User y password están en el .env.example
  * User: **rFlex**
  * Password: **rflex123**

Modelado
### Laravel 9
* http://localhost:8000/api/currencies
```shell
# DB init
php artisan migrate:fresh 
# Ejecuta CRON localmente
php artisan schedule:work
# Serve
php artisan serve
```
#### Rutas
| Ruta                                             | Descripcion                                                                                                                            |
|--------------------------------------------------|----------------------------------------------------------------------------------------------------------------------------------------|
| /                                                | Entrega todas las monedas disponibles en la base de datos                                                                              |
| /summary                                         | Entrega un resumen de los valores actuales de las monedas disponibles                                                                  |
| /{currency}?fechas_desde=desde&fecha_hasta=hasta | Entrega los valores de una moneda "currency" (en este caso dolar) <br/>según el rango de fechas desde y hasta (requeridos)             |
| /{currency}/dates                                | Entrega todas las fechas recopiladas de una moneda <br/>(en este caso sería desde el primer registro de 2023 hasta el mas reciente de 2024) |

#### Comandos
```shell
# Obtiene los registros del valor del dolar desde la API mindicador
# según el periodo (sin periodo obtiene para el año actual)
# con la opción --summary para actualizar el registro del resumen del dolar dede la API o registros de la BD
php artisan store:dolar {periodo?} --summary

# Almacena las monedas disponibles definidas en CurrenciesSeeder
# con la opción --summary para actualizar el registro de resumen 
# de las monedas disponibles dede la API o registros de la BD
php artisan store:currencies --summary
```
