<nav class="navbar navbar-inverse">
    <div class="container-fluid">
    <div class="navbar-header">
        <img class="navbar-brand" id="logo" src="Public/imagenes/logo.jpg">
    </div>
        <ul class="nav">
          <li class="active"><a href="?controller=pedido&action=ver_pedidos"><span class="oi" data-glyph="book"></span>
              Ver Pedidos
            </a></li>
          <li class="active"><a href="?controller=producto&action=search_prod"><span class="oi" data-glyph="cart"></span>
            Realizar pedido de productos
            </a></li>
          <li class="active">
              <a href="?controller=producto&action=search_prod_bar"><span class="oi" data-glyph="cart"></span>
            Realizar pedido de bebidas
              </a></li>
          <li class="active"><a href="?controller=pedido&action=ver_pedido_autorizado_todos"><span class="oi" data-glyph="check"></span>
              Pedidos autorizados
          </a></li>
          <li class="active"><a href="?controller=pedido&action=ver_pedido_cancelado_todos"><span class="oi" data-glyph="x"></span>
            Pedidos cancelados
          </a></li>
          <li><a href="Views/sesion/cerrar_sesion.php"><span class="oi" data-glyph="account-logout"></span>
            Cerrar sesion
          </a></li>
        </ul>
    </div>
</nav>
