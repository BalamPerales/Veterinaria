# 🐾 Veterinaria — Sistema de Gestión

Sistema de gestión para clínica veterinaria desarrollado con **Laravel 12** y la plantilla **SB Admin 2**. Incluye autenticación por roles, dashboards diferenciados por tipo de usuario y estructura modular de vistas.

---

## 🛠️ Stack tecnológico

| Tecnología | Versión |
|---|---|
| PHP | 8.3 |
| Laravel | 12.x |
| Base de datos | MySQL |
| Plantilla UI | SB Admin 2 (Bootstrap 4) |
| Autenticación | Laravel Auth (`Auth::attempt`) |

---

## 📋 Requisitos previos

- PHP >= 8.2
- Composer
- MySQL
- Servidor web (Apache / Nginx) o `php artisan serve`

---

## 🚀 Instalación

```bash
# 1. Clonar el repositorio
git clone https://github.com/BalamPerales/Veterinaria.git
cd Veterinaria

# 2. Instalar dependencias de PHP
composer install

# 3. Copiar el archivo de entorno
cp .env.example .env

# 4. Generar la clave de aplicación
php artisan key:generate
```

### Configurar `.env`

Edita el archivo `.env` y ajusta los valores de base de datos:

```env
APP_NAME=Veterinaria
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=veterinaria
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña

SESSION_DRIVER=database
```

### Migrar y poblar la base de datos

```bash
php artisan migrate --seed
```

> Esto crea todas las tablas y genera automáticamente los **usuarios de prueba** (ver sección de credenciales).

---

## 👤 Usuarios de prueba

| Rol | Email | Contraseña |
|---|---|---|
| Administrador | `admin@veterinaria.com` | `admin` |
| Veterinario | `vet@gmail.com` | `veterinario` |

---

## 🔐 Autenticación y roles

El sistema implementa **redirección automática por rol** al iniciar sesión:

| Rol | Redirige a | URL |
|---|---|---|
| `administrador` | Dashboard de administración | `/admin/home` |
| `veterinario` | Dashboard de veterinario | `/home` |

### Protección de rutas

Las rutas del área de administración (`/admin/*`) están protegidas por el middleware `EsAdministrador`. Si un usuario sin el rol adecuado intenta acceder, recibe un error **403 Forbidden**.

---

## 📁 Estructura de vistas

```
resources/views/
├── layouts/
│   ├── app.blade.php               — Layout principal (veterinario)
│   ├── auth.blade.php              — Layout de login
│   ├── admin.blade.php             — Layout del área de administración
│   ├── partials/                   — Partials del veterinario
│   │   ├── sidebar.blade.php       — Sidebar azul (bg-gradient-primary)
│   │   ├── topbar.blade.php
│   │   ├── footer.blade.php
│   │   └── logout-modal.blade.php
│   └── admin/
│       └── partials/               — Partials del administrador
│           ├── sidebar.blade.php   — Sidebar rojo (bg-gradient-danger)
│           ├── topbar.blade.php    — Badge "Admin" visible
│           ├── footer.blade.php
│           └── logout-modal.blade.php
└── modules/
    ├── auth/
    │   └── login.blade.php
    ├── dashboard/
    │   └── home.blade.php          — Dashboard veterinario
    └── admin/
        └── home.blade.php          — Dashboard administrador
```

---

## 🗺️ Rutas principales

| Método | URL | Nombre | Descripción |
|---|---|---|---|
| GET | `/` | `login` | Formulario de login |
| POST | `/logear` | `logear` | Procesar login |
| GET | `/home` | `home` | Dashboard veterinario |
| GET | `/admin/home` | `admin.home` | Dashboard administrador |
| GET | `/logout` | `logout` | Cerrar sesión |

---

## 🗂️ Estructura de la base de datos

### Tabla `users`

| Campo | Tipo | Descripción |
|---|---|---|
| `id` | bigint | Clave primaria |
| `name` | varchar | Nombre del usuario |
| `email` | varchar | Correo (único) |
| `password` | varchar | Contraseña hasheada (bcrypt) |
| `rol` | enum | `administrador` \| `veterinario` |
| `remember_token` | varchar | Token de sesión persistente |
| `created_at` | timestamp | |
| `updated_at` | timestamp | |

---

## 🧩 Componentes del sistema

### Middlewares

| Alias | Clase | Descripción |
|---|---|---|
| `auth` | Laravel built-in | Requiere sesión iniciada |
| `guest` | Laravel built-in | Solo usuarios no autenticados |
| `admin` | `EsAdministrador` | Requiere `rol = administrador` |

### Seeders

| Seeder | Descripción |
|---|---|
| `AdminUserSeeder` | Crea el administrador y un veterinario de prueba |

---

## 🎨 Plantilla UI

El proyecto utiliza [SB Admin 2](https://startbootstrap.com/theme/sb-admin-2) (Bootstrap 4), ubicada en:

```
public/plantilla/startbootstrap-sb-admin-2-gh-pages/
```

Los assets se referencian con `asset()` directamente desde `public/`, sin compilación con Vite ni npm.

### Diferenciación visual por rol

| Área | Color del sidebar | Identificación |
|---|---|---|
| Veterinario | 🔵 Azul (`bg-gradient-primary`) | — |
| Administrador | 🔴 Rojo (`bg-gradient-danger`) | Badge "Admin" en topbar |

---

## ⚙️ Comandos útiles

```bash
# Migrar y poblar desde cero
php artisan migrate:fresh --seed

# Correr solo el seeder
php artisan db:seed --class=AdminUserSeeder

# Listar todas las rutas
php artisan route:list

# Iniciar servidor de desarrollo
php artisan serve
```

---

## 📄 Licencia

Proyecto académico — sin licencia de distribución.
