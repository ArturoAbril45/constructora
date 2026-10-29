# Constructora - Sistema de Gestion

## Descripcion del proyecto

Este repositorio contiene el codigo fuente completo de un sistema de gestion administrativa para una empresa constructora, desarrollado con el framework **Laravel** (PHP) y **Livewire** para la parte interactiva de la interfaz, usando **Tailwind CSS** y **Vite** para los estilos y el empaquetado de assets del frontend.

El sistema cubre, entre otros, los siguientes modulos de negocio (visibles en `app/Livewire` y `app/Models`):

- Gestion de clientes (Clients) y leads / prospectos (Leads) con seguimiento (LeadFollowup).
- Proyectos de construccion (Projects): presupuestos (ProjectBudgetItem, ProjectEstimation), bitacoras (ProjectLog), actividades (ProjectActivity), planos (ProjectPlan), requisiciones de materiales (ProjectRequisition), subcontratos (ProjectSubcontract), destajos (ProjectPiecework), asistencia y pagos de mano de obra (ProjectLaborAttendance, ProjectLaborPayment), galeria de imagenes y pruebas de calidad (ProjectTest).
- Catalogo de productos, categorias y subcategorias (Catalogs).
- Almacenes e inventario (Warehouses, WarehouseStock, InventoryMovement).
- Proveedores (Providers) y ordenes de compra (PurchaseOrders).
- Cuentas por cobrar y por pagar con sus respectivos pagos (Receivables, Payables).
- Cotizaciones (Quotes), maquinaria y herramientas con prestamos (Machinery, Tool, ToolLoan) y rentas (Rentals).
- Reportes administrativos y operativos (Reports).
- Gestion de usuarios, roles/permisos, sucursales (Branch), empleados (Employee) y control de intentos de inicio de sesion (LoginAttempt).
- Configuracion general del sistema (Settings).

La autenticacion y las vistas de negocio estan construidas como componentes Livewire (`app/Livewire/...`) en lugar de controladores HTTP tradicionales; solo un par de controladores clasicos existen en `app/Http/Controllers` (por ejemplo, el logout).

> Nota sobre este repositorio: este es un respaldo integral del proyecto tal como existia en el equipo de desarrollo, incluido el archivo de configuracion de entorno (`.env`) y las dependencias instaladas (`vendor/`, `node_modules/`). Antes de usar este codigo en un entorno nuevo, revisa y regenera las credenciales/claves sensibles (ver seccion de instalacion).

## Requisitos previos

Para ejecutar este proyecto en un equipo nuevo se necesita tener instalado:

- **PHP 8.3 o superior** (el proyecto declara `"php": "^8.3"` en `composer.json`). Se recomienda tener habilitadas las extensiones tipicas de Laravel (`pdo`, `pdo_sqlite` o `pdo_mysql` segun el motor de base de datos, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`).
- **Composer 2.x** (gestor de dependencias de PHP). Puede verificarse con `composer --version`.
- **Node.js 20 LTS o superior** y **npm** (gestor de paquetes de Node) para compilar los assets del frontend con Vite. Puede verificarse con `node -v` y `npm -v`.
- **Un motor de base de datos**. El proyecto usa el ORM de Laravel (Eloquent) y es agnostico al motor, pero esta configurado por defecto para trabajar con:
  - **SQLite** (motor usado actualmente en este entorno; no requiere servidor de base de datos, solo un archivo `database/database.sqlite`), o alternativamente
  - **MySQL / MariaDB**, o
  - **PostgreSQL**

  segun el valor de la variable `DB_CONNECTION` definida en el archivo `.env` (ver `config/database.php` para los parametros admitidos en cada caso: host, puerto, nombre de base de datos, usuario y password).
- **Git** para clonar el repositorio.
- Opcional: **Redis** si se desea usar como driver de cache/colas/sesiones en lugar de la base de datos (el proyecto trae configuracion para `database` por defecto en cache, colas y sesiones).

## Instalacion paso a paso desde cero

1. **Clonar el repositorio**

   ```bash
   git clone <url-del-repositorio>
   cd constructora
   ```

2. **Instalar dependencias de PHP**

   ```bash
   composer install
   ```

3. **Instalar dependencias de Node/npm**

   ```bash
   npm install
   ```

4. **Configurar el archivo de entorno**

   Copiar el archivo de ejemplo y ajustarlo con los datos reales del entorno donde se va a desplegar:

   ```bash
   cp .env.example .env
   ```

   Este proyecto ya incluye un archivo `.env` real (de respaldo) con la configuracion usada en el equipo de desarrollo original. Si se va a levantar en un equipo o servidor distinto, se recomienda generar uno nuevo a partir de `.env.example` y **no reutilizar** la `APP_KEY` ni ninguna credencial del `.env` de respaldo, por motivos de seguridad.

   Las variables mas relevantes que hay que revisar en `.env` son:

   - `APP_NAME`, `APP_ENV`, `APP_URL`: nombre, entorno (`local`/`production`) y URL base de la aplicacion.
   - `APP_KEY`: clave de cifrado de la aplicacion (se genera en el siguiente paso, nunca se debe compartir la de produccion).
   - `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`: motor y credenciales de conexion a la base de datos.
   - `SESSION_DRIVER`, `CACHE_STORE`, `QUEUE_CONNECTION`: en este proyecto usan por defecto el driver `database`.
   - `MAIL_MAILER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`: configuracion de envio de correo.
   - `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, `AWS_DEFAULT_REGION`, `AWS_BUCKET`: credenciales opcionales para almacenamiento en S3.

   (Ninguna contrasena real se documenta aqui; revisar el archivo `.env` directamente para ver los valores configurados).

5. **Generar la clave de la aplicacion**

   ```bash
   php artisan key:generate
   ```

6. **Configurar la base de datos**

   - Si se usa **SQLite** (configuracion por defecto de este proyecto): asegurarse de que exista el archivo indicado por `DB_DATABASE` (por defecto `database/database.sqlite`). Si no existe, crearlo vacio:

     ```bash
     touch database/database.sqlite
     ```

   - Si se usa **MySQL/MariaDB o PostgreSQL**: crear la base de datos vacia en el motor correspondiente y completar en `.env` las variables `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` y `DB_PASSWORD` con los datos de esa base de datos.

7. **Ejecutar las migraciones**

   ```bash
   php artisan migrate
   ```

   El proyecto incluye mas de 50 migraciones que crean todas las tablas de los modulos descritos arriba (clientes, proyectos, inventario, cuentas por cobrar/pagar, etc.).

8. **Ejecutar los seeders (datos iniciales/demo)**

   El proyecto incluye un `DatabaseSeeder` en `database/seeders/DatabaseSeeder.php`. Para poblar la base de datos con datos iniciales:

   ```bash
   php artisan db:seed
   ```

   o, para migrar y poblar en un solo paso (recomendado en una base de datos nueva):

   ```bash
   php artisan migrate:fresh --seed
   ```

9. **Compilar los assets del frontend**

   ```bash
   npm run build
   ```

Con esto la aplicacion queda instalada y lista para levantarse.

## Como levantar el proyecto en desarrollo

Se necesitan, como minimo, dos procesos corriendo en paralelo:

1. **Servidor de la aplicacion (backend PHP)**

   ```bash
   php artisan serve
   ```

   Por defecto queda disponible en `http://localhost:8000` (el puerto puede cambiarse con `php artisan serve --port=8080`).

2. **Compilador de assets en modo desarrollo (Vite, con recarga en caliente)**

   ```bash
   npm run dev
   ```

   Vite levanta su propio servidor de desarrollo (por defecto en el puerto `5173`) e inyecta los cambios de CSS/JS en caliente en el navegador mientras se edita el codigo del frontend.

Ambos comandos deben ejecutarse en terminales distintas mientras se desarrolla. Alternativamente, el `composer.json` del proyecto define un script `dev` (`composer run dev`) que usa `php artisan dev` para orquestar varios procesos (servidor, colas, logs y Vite) en una sola terminal.

## Como compilar para produccion

1. Instalar dependencias en modo produccion (sin paquetes de desarrollo):

   ```bash
   composer install --no-dev --optimize-autoloader
   npm ci
   ```

2. Compilar los assets optimizados del frontend:

   ```bash
   npm run build
   ```

   Esto genera los archivos finales (minificados y con hash de version) dentro de `public/build`, que es lo que Laravel sirve en produccion a traves de la directiva `@vite` en las vistas Blade.

3. Configurar `.env` para produccion (`APP_ENV=production`, `APP_DEBUG=false`, `APP_URL` con el dominio real, credenciales de base de datos de produccion, etc.) y ejecutar las optimizaciones de Laravel:

   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   php artisan migrate --force
   ```

4. Servir la aplicacion con un servidor web real (Nginx/Apache + PHP-FPM) apuntando el document root a la carpeta `public/`, en lugar de usar `php artisan serve` (pensado solo para desarrollo).

## Estructura de carpetas del proyecto

Este proyecto sigue la estructura estandar de una aplicacion Laravel:

- **`app/`**: codigo fuente de la aplicacion.
  - `app/Models/`: modelos Eloquent (uno por cada entidad de negocio: `Client`, `Project`, `Quote`, `Product`, `Warehouse`, `AccountReceivable`, `AccountPayable`, `Employee`, etc.).
  - `app/Livewire/`: componentes Livewire que implementan la logica y las vistas interactivas de cada modulo (`Clients`, `Projects`, `Leads`, `Catalogs`, `Payables`, `Receivables`, `Reports`, `Settings`, `Auth`, etc.). En este proyecto, la mayor parte de la logica de pantallas vive aqui en lugar de en controladores clasicos.
  - `app/Http/Controllers/`: controladores HTTP tradicionales (en este proyecto se usan solo para casos puntuales, como el cierre de sesion).
  - `app/Providers/`: proveedores de servicio de Laravel (registro de bindings, eventos, etc.).
- **`bootstrap/`**: arranque del framework (cache de configuracion compilada, autoload de providers).
- **`config/`**: archivos de configuracion de la aplicacion (`app.php`, `database.php`, `auth.php`, `cache.php`, `queue.php`, `session.php`, `mail.php`, `filesystems.php`, `logging.php`, `services.php`).
- **`database/`**:
  - `database/migrations/`: definicion de todas las tablas del sistema (mas de 50 migraciones).
  - `database/seeders/`: carga de datos iniciales (`DatabaseSeeder.php`).
  - `database/factories/`: fabricas de modelos para pruebas y seeders.
  - `database/database.sqlite`: archivo de base de datos SQLite usado en este entorno de desarrollo.
- **`public/`**: punto de entrada HTTP de la aplicacion (`index.php`), assets ya compilados (`public/build`), favicon e imagenes publicas.
- **`resources/`**:
  - `resources/views/`: vistas Blade, organizadas en `layouts/` (plantillas base), `components/` (componentes Blade reutilizables), `partials/` y `livewire/` (vistas asociadas a cada componente Livewire, reflejando la misma organizacion por modulo que `app/Livewire`).
  - `resources/css/` y `resources/js/`: estilos (Tailwind CSS) y JavaScript de entrada para Vite.
- **`routes/`**: definicion de rutas (`web.php` para las rutas web principales, `console.php` para comandos Artisan personalizados).
- **`storage/`**: archivos generados en tiempo de ejecucion (logs, cache de vistas compiladas, archivos subidos por usuarios en `storage/app`).
- **`tests/`**: pruebas automatizadas, separadas en `tests/Feature` (pruebas de flujo/integracion) y `tests/Unit` (pruebas unitarias), ejecutables con `php artisan test`.
- **`vendor/`**: dependencias de PHP instaladas por Composer.
- **`node_modules/`**: dependencias de Node instaladas por npm.
- **`artisan`**: linea de comandos de Laravel para ejecutar tareas (migraciones, seeders, servidor de desarrollo, generacion de claves, etc.).
- **`composer.json` / `composer.lock`**: dependencias y version de PHP/paquetes del backend.
- **`package.json` / `package-lock.json`**: dependencias de frontend (Tailwind CSS, Vite, Chart.js para graficas, plugin de Laravel para Vite).
- **`vite.config.js`**: configuracion del empaquetador de assets.
- **`phpunit.xml`**: configuracion de PHPUnit para las pruebas automatizadas.

### Particularidades de este proyecto

- Usa **Livewire 3** como arquitectura principal de interfaz: casi toda la logica de pantalla (listados, formularios, filtros) vive en clases PHP dentro de `app/Livewire`, con su vista Blade correspondiente en `resources/views/livewire`, en vez de usar controladores + API + JavaScript por separado.
- Usa **Tailwind CSS 4** junto con **Vite** para el frontend, y **Chart.js** para graficas (por ejemplo en reportes y dashboard).
- Tiene un numero elevado de migraciones (51) y modelos (mas de 35), reflejando un dominio de negocio amplio: desde la parte comercial (leads, cotizaciones, clientes) hasta la ejecucion de obra (proyectos, requisiciones, subcontratos, destajos, asistencia de personal) y la parte administrativa (cuentas por cobrar/pagar, inventario, maquinaria y herramientas).
- Incluye control de intentos de inicio de sesion (`LoginAttempt`) como medida de seguridad adicional sobre la autenticacion.
- Base de datos configurada por defecto como **SQLite** en este entorno (archivo `database/database.sqlite`), lo que facilita levantar el proyecto sin instalar un servidor de base de datos aparte, aunque el `config/database.php` tambien soporta MySQL, PostgreSQL y SQL Server.

## Nota sobre seguridad de este respaldo

Este repositorio se publico como **respaldo completo** del proyecto (incluyendo `.env`, `vendor/` y `node_modules/`) antes de formatear el equipo donde se desarrollaba. Si este repositorio es publico, se recomienda, al reutilizar el codigo en un entorno real:

- Generar una nueva `APP_KEY` con `php artisan key:generate`.
- No reutilizar en produccion ninguna clave, token o contrasena presente en el `.env` incluido en este respaldo.
- Revisar `config/services.php` y las variables `AWS_*`/`MAIL_*` antes de usarlas en un entorno real.
