
# IPERC APPS

En este repositorio se encuentran las apps web y moviles en sus respectivas carpeta
  

## APP WEB

 La app Web se encuentra desarrollada con **Laravel**, lo cual **NO** es necesario tener un script de la base de datos, ya que este se encuentra dentro del proyecto.

### Instalación

Ejecutar el comando los siguientes comandos en el orden que se detalla
1. `composer install`
2. `cp .env.example .env`
3. `php artisan key:generate`
4. `php artisan migrate --seed`

Para configurar un usuario administrador, no realice el paso 4 y modifique el archivo `database/seeds/UserSeeder.php`

y modifique lo siguiente: 
`$user =  User::create([`
`				'name'  =>  'Admin',`
`				'email'  =>  'admin@deltronicsperu.com',`
`				'password'  =>  Hash::make('%admin%'),`
`			]);`

### Características del servidor

**SO:** UBUNTU: 18.04.4 LTS
**SERVIDOR DE WEB:** NGINX - versión actual: 1.14.0
**MOTOR DE BASE DE DATOS:** MYSQL 5.7.33 - versión recomendada
**PHP:** 7.3.^ - versión recomendada
**GESTOR DE DEPENDENCIAS:** COMPOSER 

## APP MOVIL

La app móvil se encuentra desarrollada en flutter, en la versión 1.12

Antes de instalar la aplicación debe existir los siguiente recursos

1. Flutter - versión 1.12-hotfix 9 - incluir al PATH
2. SDK de Android - para app Android
3. XCODE - para iOS
4. Cocoapods

### Instalación

1. Ejecutar el siguiente comando:
`flutter pub get`
Para iOS
2. Ejecutar los siguientes datos
	`cd ios/`
	`pod install`
3. abrir el archivo desde la carpeta ios
	`Runner.xcworkspace`

Los demas detalles de explican claramente en la documentacion oficial de Flutter

[FLUTTER DOCS](https://flutter.dev/docs/deployment/ios)