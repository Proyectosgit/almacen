  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
          <img  class="navbar-brand" id="logo" src="Public/imagenes/logo.jpg">
      </div>
      <ul class="nav">
        <!-- <li><a href="?controller=pedido&action=index"><span class="oi" data-glyph="key"></span> --><!--Esta linea dirige a todos los pedidos-->
        <li><a href="?controller=pedido&action=index"><span class="oi" data-glyph="key"></span>
        Pedidos</a></li>
        <!-- <li><a href="?controller=relacion&action=register">Ingresar relacion_pedido_producto</a></li> -->
        <!-- <li><a href="?controller=relacion&action=index">Productos por pedidos</a></li> -->
        <li><a href="?controller=producto&action=search_prod"><span class="oi" data-glyph="cart"></span>
        Realizar pedido Cocina</a></li>
        <li><a href="?controller=producto&action=search_prod_bar"><span class="oi" data-glyph="cart"></span>
        Realizar pedido Barra</a></li>
        <!-- <li><a href="?controller=pedido&action=recibir_pedidos">Almacenista</a></li> -->
        <li><a href="?controller=pedido&action=orderDate"><span class="oi" data-glyph="book"></span>
        Consultar pedidos</a></li>
        <li><a href="?controller=producto&action=button_download_db"><span class="oi" data-glyph="cloud-download"></span>
        Descargar Base de Datos</a></li>
        <li class="active"><a href="?controller=usuario&action=register"><span class="oi" data-glyph="person"></span>
        Alta Usuario</a></li>
        <li><a href="?controller=usuario&action=index"><span class="oi" data-glyph="people"></span>
        Ver Usuarios</a></li>
        <!-- <li><a href="?controller=producto&action=register">Ingresar Producto</a></li> -->
        <li><a href="?controller=producto&action=index"><span class="oi" data-glyph="eye"></span>
        Ver Producto</a></li>
        <li><a href="?controller=producto&action=carga_db_productos"><span class="oi" data-glyph="eye"></span>
        carga db</a></li>
        <!-- <li><a href="?controller=familia&action=register"><span class="oi" data-glyph="task"></span> -->
        <!-- Alta Familia</a></li> -->
        <!-- <li><a href="?controller=familia&action=index"><span class="oi" data-glyph="eye"></span> -->
        <!-- Ver Familia</a></li> -->
        <!-- <li><a href="?controller=pedido&action=register">Ingresar pedido</a></li> -->
        <li><a href="?controller=pedido&action=ver_pedidos_rango"><span class="oi" data-glyph="magnifying-glass"></span>
        Buscar Pedidos</a></li>
        <li><a href="../?controller=usuario&action=cerrar"><span class="oi" data-glyph="account-logout"></span>
        Cerrar sesion</a></li>
      </ul>
    </div>
  </nav>
