# rFlex.io-Fluctuación del dólar API
```shell
git clone https/github.com/SurturTawers api
cd api && cp .env.example .env
```

## Tecnologías
* MySQL 8.0
* Laravel 9
* php 8.1


### DB MySQL 
* DB Name: **rflex_dolar**
* Crear User y password están en el .env.example
  * User: **rFlex**
  * Password: **rflex123**


#### Modelado
![Imagen de Modelo DB](./Screenshot%20from%202024-01-29%2012-44-01.png "Diagrama E-R BD")
* La BD fue modelada pensando en un posible crecimiento a futuro en cuanto a los requerimientos de la aplicación, que podrian ser:
  * Necesidad de incluir más monedas
  * Mostrar un resumen general de los valores actuales de monedas
  * Obtener información adicional de las monedas
* Entonces, las tablas creadas tiene la siguiente función
  * **currencies**: Información adicional de las monedas y definir si es que esta está disponible con *is_active*
  * **currencies_summary**: Resumen con los valores mas recientes de las monedas trabajadas desde la API o registros de la BD
  * **dolar_history**: Almacena los registros históricos del dolar, 
    * **Consideraciones**: se pensó usar una tabla general *currencies_history* para tener los registros de varias monedas en una tabla, <br> pero al momento de requerir otras cosas para distintas monedas esto podría requerir una reestructuración. <br> Por lo tanto, se decide tener tablas individuales para cada moneda que atiendan sus requerimientos.



### Laravel 9
* http://localhost:8000/api/currencies
* Puede faltar modulo de php php-mbstring
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

#### Consideraciones en implementación
* Principalmente me aseguré de dejar la lógica en app/Services, para que los controladores solo sean responsables de manejar las Request <br> y también para identificar de mejor manera el código reutilizable
