T1_Practica2_Ferreteria/
├─ public/
│ ├─ index.php 
│ ├─ assets/ # CSS/JS
├─ src/
│ ├─ Core/
│ │ ├─ Database.php # Conexión PDO
│ │ ├─ Auth.php 
│ ├─ Domain/
│ │ ├─ Entity/
│ │ │ ├─ Categoria.php
│ │ │ ├─ Producto.php
│ │ │ ├─ Pedido.php
│ │ │ ├─ LineaPedido.php
│ │ │ ├─ Usuario.php # Cuenta por ferretería (Anexo I)
│ │ ├─ Service/
│ │ │ ├─ CarritoService.php # Pedido provisional en sesión
│ │ │ ├─ PedidoService.php # Validación/envío
│ ├─ Repository/
│ │ ├─ CategoriaRepository.php
│ │ ├─ ProductoRepository.php
│ │ ├─ PedidoRepository.php
│ │ ├─ LineaPedidoRepository.php
│ │ ├─ UsuarioRepository.php
├─ views/
│ ├─ layout/
│ │ ├─ header.php 
│ ├─ auth/
│ │ ├─ login.php
│ │ ├─ logout.php
│ ├─ catalogo/landing.php
│ ├─ catalogo/products.php
│ ├─ orders.php
│ ├─ pedido/confirm.php
│ ├─ pedido/summary.php
│ ├─ maintenaces.php
├─ config/
│ ├─ app.example.env # Variables de entorno (DSN, usuario, pass)
├─ database/
│ ├─ pedidos_v5.sql # Script facilitado
├─ docs/
│ ├─ documentacion-tecnica.pdf # Entrega Anexo IV
├─ composer.json # (Opcional) PSR-4 autoload
├─ README.md # Instrucciones resumidas de despliegue
