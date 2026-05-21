================================================================================
📋 LISTA DE TAREAS PENDIENTES - INFOVENDER
================================================================================

🚨 URGENTE (Alta Prioridad)
--------------------------------------------------------------------------------
[ ] Simplificación del Registro de Miembros & Duración de Suscripción
    * Descripción: Reducir y simplificar la información solicitada al registrarse.
    * Datos a registrar obligatorios:
      - Nombre
      - Correo electrónico
      - Teléfono / WhatsApp
      - Fecha de suscripción
    * Ajuste de Negocio: Que la suscripción por defecto sea de 1 mes.
    
    * Base de Datos (SQL):
      Ejecutar las siguientes sentencias para agregar el campo de teléfono:
      ```sql
      ALTER TABLE `members`
      ADD `num_phone` VARCHAR(14) NULL DEFAULT NULL AFTER `email`;

      ALTER TABLE `members` ADD UNIQUE (`num_phone`);
      ```

⚠️ MEDIO (Prioridad Media)
--------------------------------------------------------------------------------
*(Sin tareas asignadas actualmente)*

🕒 PARA LUEGO (Mejoras Futuras)
--------------------------------------------------------------------------------
[ ] Mostrar días restantes de expiración
    * Mostrar al usuario de forma clara en su perfil/dashboard cuántos días le quedan antes de que expire su suscripción.

[ ] Acceso libre al catálogo principal
    * Permitir que el catálogo principal de cursos sea de libre acceso (público).
    * Restringir el acceso a los cursos en sí: cuando el usuario intente ingresar a un curso específico, debe solicitarle iniciar sesión (estar logueado).

📅 DICIEMBRE (Nuevo Módulo: "Revendedores")
--------------------------------------------------------------------------------
Apartado especial para colocar productos para revender (Spotify, Amazon, Netflix, etc.).
Cada producto tendrá su descripción, precio y un enlace de compra que redirige a un chat de WhatsApp con un mensaje predeterminado.

🗄️ BACKEND (Base de Datos y Controladores)
[ ] Crear tabla en la base de datos para almacenar los productos de revendedores.
[ ] Crear el CRUD (Creación, Edición y Eliminación) en el backend para la administración.
[ ] Crear controlador para la vista general de productos en el front-end.
[ ] Crear controlador para la vista de detalle de un producto individual.

👑 PANEL DE ADMINISTRACIÓN (Admin)
[ ] Crear el apartado/interfaz en el panel de administración para gestionar los productos de revendedores (interfaz del CRUD).

🎨 FRONT-END (Vistas y Diseño)
[ ] Diseñar y crear la vista general de productos de revendedores en el front-end.
[ ] Diseñar y crear la vista de detalle para un producto individual.
[ ] Implementar el botón de compra de WhatsApp con redirección y mensaje predeterminado dinámico.
================================================================================