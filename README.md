Proyecto Laravel: Sistema de Gestión de Artículos y Etiquetas

Este proyecto es una aplicación web desarrollada con Laravel, Jetstream y Livewire. Permite a los usuarios gestionar artículos y etiquetas, además de incluir funcionalidades como autenticación, verificación de correo electrónico, políticas de autorización y un formulario de contacto.

\---

Tabla de Contenidos

1. Requisitos del Sistema
1. Clonar el Repositorio
1. Instalación
1. Configuración
1. Ejecutar el Proyecto
1. Funcionalidades
1. Generación de Datos de Prueba
1. Contribuciones
1. Licencia

\---

## Requisitos del Sistema

Asegúrate de tener instalado lo siguiente en tu entorno de desarrollo:

- PHP >= 8.1
- Composer
- Node.js (para compilar assets)
- MySQL o MariaDB
- Git
- Mailtrap (u otro servicio de correo para pruebas)

\---

## Clonar el Repositorio

Para clonar este repositorio, ejecuta el siguiente comando en tu terminal:

git clone https://github.com/tu-usuario/nombre-proyecto.git

cd nombre-proyecto

\---

## Instalación

1. Instalar dependencias de PHP:

composer install

1. Instalar dependencias de Node.js:

npm install

1. Compilar assets:

npm run build

1. Copiar archivo de configuración .env:

cp .env.example .env

1. Generar clave de la aplicación:

php artisan key:generate

\---

## Configuración

1. Configurar la base de datos:

Abre el archivo .env y configura las siguientes variables según tu entorno:

DB\_CONNECTION=mysql

DB\_HOST=127.0.0.1

DB\_PORT=3306

DB\_DATABASE=nombre\_de\_tu\_base\_de\_datos

DB\_USERNAME=tu\_usuario

DB\_PASSWORD=tu\_contraseña

Si prefieres usar sqlite deja este apartado como viene por defecto


1. Configurar el correo electrónico:

Para probar la verificación de correo y el formulario de contacto, utiliza Mailtrap o un servicio similar. Actualiza las siguientes variables en .env:

MAIL\_MAILER=smtp

MAIL\_HOST=smtp.mailtrap.io

MAIL\_PORT=2525

MAIL\_USERNAME=your-mailtrap-username

MAIL\_PASSWORD=your-mailtrap-password

MAIL\_ENCRYPTION=tls

MAIL\_FROM\_ADDRESS="example@example.com"

\---

## Ejecutar el Proyecto

1. Ejecutar migraciones:

php artisan migrate:fresh

1. Iniciar el servidor de desarrollo:

php artisan serve

El proyecto estará disponible en http://localhost:8000.

1. Acceder al sistema:
- Regístrate como un nuevo usuario.
- Verifica tu correo electrónico a través del enlace enviado (usa Mailtrap para verificar el correo).
- Inicia sesión para acceder a las funcionalidades.

\---

## Funcionalidades

Autenticación y Verificación de Correo

- Los usuarios deben registrarse e iniciar sesión.
- La verificación de correo electrónico es obligatoria para acceder a las funcionalidades principales.

CRUD de Artículos

- Los usuarios pueden crear, editar y eliminar sus propios artículos.
- Solo los propietarios de un artículo pueden editarlo o eliminarlo.

CRUD de Etiquetas

- Solo los administradores (is\_admin = true) pueden gestionar etiquetas.

Formulario de Contacto

- Cualquier usuario (registrado o no) puede enviar un mensaje a través del formulario de contacto.

\---

## Generación de Datos de Prueba

1. Ejecutar seeders:

php artisan db:seed

- cuando vayas a ejecutar las migraciones hazlo con el siguiente comando: php artisan migrate:fresh --seed

Esto generará datos ficticios para usuarios, artículos y tags.

\---

¡Gracias por usar este proyecto! Si tienes preguntas o sugerencias, no dudes en abrir un issue en el repositorio. 🚀
