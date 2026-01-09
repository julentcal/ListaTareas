## Resumen rápido

Proyecto: plantilla Laravel 10 (PHP ^8.1) — aplicación pequeña de "Tareas" (Tasks).

- Arquitectura: MVC típica de Laravel: rutas en `routes/`, controladores en `app/Http/Controllers`, modelos en `app/Models`, vistas Blade en `resources/views`, migraciones en `database/migrations`.

## Qué hace este repositorio (big picture)

- La app expone rutas en `routes/web.php` para listar, crear, eliminar y alternar tareas (`index`, `store`, `destroy`, `toggle`).
- Modelo de dominio principal: `App\\Models\\Task` (fillable: `name`, `is_completed`).
- La vista principal es `resources/views/index.blade.php` (Blade) y actualmente la controller `TaskController` construye un array estático en `index()` en vez de usar Eloquent; revisa `app/Http/Controllers/TaskController.php` para entender los flujos.

## Comandos esenciales (setup rápido)

1. Instalar dependencias PHP:

   composer install

2. Variables de entorno y clave de aplicación:

   cp .env.example .env
   php artisan key:generate

3. Migraciones (ATENCIÓN: la migración de tasks tiene un error de sintaxis actualmente — ver abajo):

   php artisan migrate

4. Frontend (Vite):

   npm install
   npm run dev

5. Servidor de desarrollo:

   php artisan serve

6. Tests (si los ejecutas):

   ./vendor/bin/phpunit    (en Windows: vendor\\bin\\phpunit.bat)

## Convenciones y patrones específicos del proyecto

- Estructura Laravel estándar (PSR-4). Auto-load definido en `composer.json` — `App\\` -> `app/`.
- Rutas: usan controladores invocables por array `[Controller::class, 'method']` en `routes/web.php`. La ruta para alternar estado usa `PATCH` en `/tasks/{task}/toggle`.
- Modelo `Task` está en `app/Models/Task.php` y define `$fillable = ['name', 'is_completed']`.
- Migraciones en `database/migrations` — este proyecto crea la tabla `tasks` con columna `is_completed` boolean por defecto `false`.
- Vistas Blade en `resources/views` (archivo principal: `index.blade.php`).

## Integraciones y dependencias externas

- PHP 8.1+, Laravel 10.x (ver `composer.json`).
- Paquetes dev: `vite`, `laravel-vite-plugin`, `pint`, `phpunit`.
- Autenticación/API: `laravel/sanctum` está presente en `composer.json` (no necesariamente utilizado por la app pequeña actual).

## Problemas detectados (acción requerida)

- `database/migrations/2026_01_09_083313_create_tasks_table.php` contiene un error de sintaxis: falta el punto y coma en `$table->timestamps()`; arreglar antes de ejecutar `php artisan migrate`.
- `app/Http/Controllers/TaskController.php` mezcla imports innecesarios (`use Illuminate\\Support\\Facades\\Route; use App\\Http\\Controllers\\TaskController;`) y el método `index()` devuelve un array estático en vez de usar `Task::all()` — revisa si quieres persistencia o sólo demo.

## Peticiones típicas que un agente AI puede manejar aquí

- Añadir persistencia: actualizar `TaskController@index` para recuperar `Task::all()` y ajustar `resources/views/index.blade.php` para renderizar atributos (`$task->name`).
- Corregir migración y ejecutar migraciones.
- Añadir validación y manejo de errores consistente en `store()` (ya hay una validación mínima en el controller).
- Añadir o actualizar tests en `tests/Feature` para cubrir rutas CRUD.

## Archivos clave (referencias rápidas)

- Rutas: routes/web.php
- Controlador principal: app/Http/Controllers/TaskController.php
- Modelo: app/Models/Task.php
- Migración: database/migrations/2026_01_09_083313_create_tasks_table.php
- Vista: resources/views/index.blade.php

## Preguntas al mantenedor (útiles para iteraciones)

1. ¿Desea que el agente convierta la lista estática en `index()` a persistencia completa usando Eloquent?
2. ¿Debo corregir la migración y correr `php artisan migrate` automáticamente, o prefieres revisar y aplicar cambios manualmente?

---
Si quieres, aplico los cambios mínimos sugeridos (corregir la migración y actualizar `index()` para usar `Task::all()`) y añado tests básicos. ¿Quieres que proceda?
