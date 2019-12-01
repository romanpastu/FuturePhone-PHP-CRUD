# FuturePhone-PHP-CRUD
Proyecto PHP , realizado para la asignatura Desarrollo Web en Entorno Servidor, para el curso 19/20

La aplicación consiste en un sistema de gestión realizado para una web de telefonía, que nos permitira gestionar a los usuarios de dicha web, y a su vez las tarifas y lineas telefónicas que esten asignadas a dichos usuarios.

De tal forma dispondremos de 3 tipos de usuarios, con distintas funciones.

Roles:
  - Administrador: Este usuario podrá realizar funciones como:
    - Cambiar el Rol de otros usuarios.
    - Gestionar las Tarifas -> Borrar tarifas, Crear Tarifas, Establecer imágenes de portada para las tarifas.
    - Podrá también ver todas las lineas contratadas por los clientes.
  
  - Usuario Común (Cliente): Este usuario podrá realizar funciones como:
    - Crear lineas telefónicas
    - Cambiar las tarifas que tiene contratadas por otras.
    
   - Comercial: Este usuario podrá realizar funciones como:
     - Gestionar todas las tarifas -> Borrar lineas telefónicas , cambiar las tarifas asignadas a distintas lineas telefónicas, crear            lineas nuevas.
     - Podrá ver todas las lineas contratadas por los Clientes.
     
La aplicación también viene equipada con una api que permite realizar las siguientes funciones:
  - Consultar la información de una tarifa concreta.
  - Listar los nombres de todas las tárifas
  - Borrar tarifas (Acción restringida a administradores con api-key)
