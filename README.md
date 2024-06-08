# Proyecto de Prueba en Laravel

Proyecto Laravel para implementar una API con autenticación, gestión de leads y pruebas automatizadas.

## Descripción

El proyecto implementa una API RESTful para la gestión de leads, incluyendo autenticación de usuarios, creación, obtención y listado de leads.

## Requisitos Previos

- PHP >= 8.2
- Composer
- Laravel >= 11.x
- MySQL >= 8
- SQLite (para pruebas)


## Instalación

1. Clona el repositorio:

   ```bash
   git clone https://github.com/jonquintero/monoma.git
   cd monoma

2. Instala las dependencias de PHP con Composer:

    ```bash
   composer install

## Configuración

1. Copia el archivo de entorno:

   ```bash
   cp .env.example .env
   
2. Genera la clave de la aplicación:

    ```bash
   php artisan key:generate
   
3. Configura la base de datos MySQL en el archivo .env:
    
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nombre_de_tu_base_de_datos
    DB_USERNAME=tu_usuario
    DB_PASSWORD=tu_contraseña
   
4. Ejecuta las migraciones y los seeders:

    ```bash
    php artisan migrate --seed

## Configuración para Pruebas

1. Crea el archivo de base de datos SQLite:

    ```bash
    touch database/database.sqlite

## Ejecución de Pruebas

1. Para ejecutar las pruebas, utiliza el siguiente comando:

    ```bash
    php artisan test
   
# Uso

## Autenticación

Endpoint: POST /auth

Descripción: Genera un token de acceso.

Ejemplo de solicitud:

``{
"username": "tester",
"password": "PASSWORD"
}``

## Crear Candidato

Endpoint: POST /lead

Descripción: Crea un nuevo lead.

Ejemplo de solicitud:

``{
"name": "Mi candidato",
"source": "Fotocasa",
"owner": 2
}``

## Obtener Candidato por ID

Endpoint: GET /lead/{id}

Descripción: Obtiene un lead por su ID.


##Obtener Todos los Candidatos

Endpoint: GET /leads

Descripción: Devuelve todos los candidatos asignados al agente o, si es usuario manager, devuelve todos los candidatos.


## Extras

1. Uso de Redis `✔️`
2. Arquitectura modular `✔️`
3. Form Request `✔️`
4. Manejo de excepción `✔️`
5. Eloquent Api Resource `✔️`
6. Cobertura 100% de unit testing `✔️`






