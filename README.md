


```text
T1_Practica2_Ferreteria/
├─ public/
│ ├─ index.php 
│ ├─ assets/ # CSS/JS
├─ src/
│ ├─ Core/
│ │ ├─ Database.php # Conexión PDO
│ │ ├─ Auth.php 
│ ├─ Entity/
│ │ ├─ Categoria.php
│ │ ├─ Product.php
│ │ ├─ Order.php
│ │ ├─ Orderline.php
│ │ ├─ User.php # Cuenta por ferretería (Anexo I)
│ ├─ Repository/
│ │ ├─ Categories.php
│ │ ├─ Orderlines.php
│ │ ├─ Orders.php
│ │ ├─ Products.php
│ │ ├─ Users.php
│ ├─ vendor/
├─ views/
│ ├─ auth/
│ │ ├─ login.php
│ │ ├─ logout.php
│ ├─ catalog/
│ | ├─ landing.php
│ | ├─ products.php
│ | ├─ suministros.php
│ ├─ confirm.php
│ ├─ orders.php
│ ├─ noDisponible.php
│ ├─ summary.php
│ ├─ maintenaces.php
├─ composer.json # (Opcional) PSR-4 autoload
├─ .env
├─ README.md # Instrucciones resumidas de despliegue
```
