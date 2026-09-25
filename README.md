# WawSys Lite v2.0

WawSys Lite es un sistema para el control de consumo de agua potable, gestión de abonados, inventario de medidores y registro de lecturas desarrollado en **PHP** y **MySQL**.

---

## 🚀 Novedades y Actualizaciones (2026)

- **Base de Datos Simplificada**: Estructura limpia de 7 tablas (`client`, `meter`, `val`, `location`, `category`, `user`, `configuration`), eliminando tablas obsoletas del modelo anterior.
- **Arquitectura MVC con Enrutamiento Limpio**: Uso de **FastRoute** para URLs amigables (`/home`, `/vals`, `/clients`, `/meters`, `/locations`, `/categories`, `/users`, `/settings`).
- **Motor de Plantillas Twig**: Vistas desacopladas con herencia de layouts y renderizado seguro.
- **Seguridad Integrada**: Validación de tokens **CSRF** en todas las peticiones POST.
- **Capa de Servicios**: Lógica de negocio separada en clases dedicadas (`ValService`, `ClientService`, `MeterService`, `LocationService`, `CategoryService`, `DashboardService`).
- **Toma de Lecturas con Cálculo Automático**: Carga de lectura previa por AJAX, cálculo de consumo neto en tiempo real y soporte para fotografía de evidencia.
- **Gestión de Medidores**: Control de número de serie, marca, identificador único, fechas de vigencia y estados (activo, mantenimiento, baja).
- **Interfaz Moderna**: Plantilla basada en **CoreUI v4**, **Bootstrap 5**, **Bootstrap Icons**, **DataTables** y notificaciones con **SweetAlert2**.

---

## 📦 Módulos Principales

- **Dashboard / Inicio**: Indicadores clave de clientes activos, medidores instalados, lecturas del mes actual y volumen consumido.
- **Lecturas**: Registro de lecturas con lectura previa, consumo neto en m³, fotografía del medidor y observaciones.
- **Clientes**: Directorio de abonados con expediente individual, historial de consumos y asignación de medidores.
- **Medidores**: Inventario técnico y control de ciclo de vida de los equipos de medición.
- **Ubicaciones**: Catálogo de sectores y zonas para organizar las rutas de lectura.
- **Categorías**: Clasificación de tipos de consumo (Doméstico, Comercial, Industrial, etc.).
- **Usuarios y Ajustes**: Administración de cuentas de acceso, roles y configuración global del sistema.

---

## 🛠️ Requisitos del Sistema

- **Servidor Web**: Apache (con `mod_rewrite` habilitado) o Nginx.
- **PHP**: versión 7.4 o superior (recomendado PHP 8.x) con extensiones PDO y MySQLi.
- **Base de Datos**: MySQL 5.7+ o MariaDB 10.3+.
- **Gestor de dependencias**: Composer.

---

## ⚙️ Instalación y Configuración

1. **Colocar el proyecto**:
   Ubica la carpeta del proyecto en tu servidor web local (ej. `htdocs/wawsys2` en XAMPP).

2. **Instalar dependencias**:
   ```bash
   composer install
   ```

3. **Base de Datos**:
   Crea la base de datos `wawsys` e importa el archivo `schema.sql`:
   ```sql
   CREATE DATABASE wawsys;
   USE wawsys;
   SOURCE schema.sql;
   ```

4. **Conexión**:
   Verifica los parámetros en `core/controller/Database.php`:
   ```php
   $this->user = "root";
   $this->pass = "";
   $this->host = "localhost";
   $this->ddbb = "wawsys";
   ```

5. **Acceso al sistema**:
   Ingresa desde el navegador a:
   ```
   http://localhost/wawsys2/
   ```

6. **Credenciales por defecto**:
   - **Usuario**: `admin`
   - **Contraseña**: `admin`

---

## 📄 Créditos

Desarrollado por [Evilnapsis](https://evilnapsis.com/).