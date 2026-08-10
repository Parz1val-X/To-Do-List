# To-Do List

Aplicación web para la gestión de tareas personales, construida con **Laravel**. Permite organizar el trabajo mediante **tareas**, agrupadas en **categorías** y clasificadas con **etiquetas**, a través de una interfaz web sencilla y de una **API RESTful**.

## Contexto

El proyecto surgió como práctica de aprendizaje de Laravel: un CRUD completo (crear, listar, ver, editar y eliminar) sobre tres recursos relacionados, con validación, persistencia en MySQL y una API JSON para que pueda consumirla una aplicación externa (frontend, móvil, etc.). No incluye autenticación: tanto la web como la API son públicas.

## Características principales

- CRUD de tareas, categorías y etiquetas desde la interfaz web.
- Las tareas se vinculan a una categoría (opcional) y a varias etiquetas.
- Una categoría o etiqueta con tareas asociadas no puede eliminarse.
- Interfaz responsive con Bootstrap: mensajes de éxito/error, validación de formularios y confirmación antes de eliminar.
- API RESTful pública bajo el prefijo `/api` con respuestas JSON.

## Tecnologías

- **Laravel 10** con PHP 8.x
- **MySQL** (sugerencia: Laragon, que agrupa PHP, Composer y MySQL)
- **Blade** + **Bootstrap 5** y **Bootstrap Icons** (CDN)

## Requisitos previos

- PHP 8.1 o superior
- Composer
- MySQL
- Git

## Puesta en marcha (instalación)

1. Clonar el repositorio:

   ```bash
   git clone git@github.com:Parz1val-X/To-Do-List.git
   cd To-Do-List
   ```

2. Instalar las dependencias de PHP:

   ```bash
   composer install
   ```

3. Crear el archivo de entorno:

   ```bash
   cp .env.example .env
   ```

   En Windows (cmd):

   ```bash
   copy .env.example .env
   ```

4. Generar la clave de la aplicación:

   ```bash
   php artisan key:generate
   ```

5. Configurar la conexión a MySQL en `.env` (por defecto, Laragon usa root sin contraseña):

   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=todo_list
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. Crear la base de datos (por ejemplo `todo_list` desde phpMyAdmin o la CLI de Laragon) y ejecutar las migraciones:

   ```bash
   php artisan migrate
   ```

7. Levantar el servidor de desarrollo:

   ```bash
   php artisan serve
   ```

La aplicación queda disponible en `http://127.0.0.1:8000`.

## Cómo usar la aplicación

- La barra de navegación da acceso a **Tareas**, **Categorías** y **Etiquetas**.
- Para empezar: crea una categoría (por ejemplo "Trabajo") y una etiqueta (por ejemplo "urgente"), y luego una tarea asignándole categoría y etiquetas.
- Cada listado muestra las acciones **Ver**, **Editar** y **Eliminar**; los formularios validan los datos y muestran los errores junto a cada campo.

## API RESTful

La API está disponible bajo el prefijo `/api` y no requiere autenticación. Todos los endpoints responden en JSON.

| Recurso      | Endpoints                                                     |
|--------------|---------------------------------------------------------------|
| Categorías   | `/api/categories` (GET, POST) · `/api/categories/{id}` (GET, PUT, DELETE) |
| Etiquetas    | `/api/tags` (GET, POST) · `/api/tags/{id}` (GET, PUT, DELETE) |
| Tareas       | `/api/tasks` (GET, POST) · `/api/tasks/{id}` (GET, PUT, DELETE) |

Al listar, cada recurso incluye sus relaciones (las tareas traen su categoría y sus etiquetas; las categorías y etiquetas traen sus tareas).

Formato típico de respuesta:

- Éxito: `{ "data": ..., "message": "..." }` (códigos 200 / 201).
- Error de validación: `{ "message": "...", "errors": { "campo": ["..."] } }` (código 422).
- No encontrado: `{ "message": "..." }` (código 404).
- Conflicto (eliminar algo con relaciones): `{ "message": "..." }` (código 409).

### Ejemplo: crear una tarea

```
POST /api/tasks
Content-Type: application/json
Accept: application/json

{
    "title": "Comprar regalo",
    "description": "Para el cumpleaños del sábado",
    "completed": false,
    "category_id": 3,
    "tags": [2, 3]
}
```

### Probar los endpoints

- Con **Bruno** o **Postman**, creando una colección y usando las URLs de la tabla.
- O desde el navegador, consultando directamente una ruta GET (por ejemplo `http://127.0.0.1:8000/api/tasks`); el JSON se puede inspeccionar con las herramientas de desarrollador (F12).