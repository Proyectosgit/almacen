<?php

		if(isset($_SESSION["id_sesion"])){
			if(($_SESSION["id_sesion"]=="administrador" || $_SESSION["id_sesion"]=="gerente" || $_SESSION["id_sesion"]=="barra")){
				if($_SESSION["visible"]=="true"){
?>
<script>
	function cancela_pedido(){

		javascript:window.history.back();

	}
</script>
<script>
	function foor(){
		alert("Pedido Realizado");
		return true;
	}
</script>
<script language="JavaScript">
<!--
  javascript:window.history.forward(1);
//-->
</script>
<script src="Public/jquery/jquery-3.3.1.min.js"></script>
<section>
<div class="container">
	<div class="table-responsive">
		<table class="table">
			<thead class="thead-dark small">
				<tr>
					<th>Descripción</th>
					<th>Pedido</th>
					<!-- <th>Codigo <br>Familia</th> -->
					<!-- <th>Empaque</th> -->
					<th>Total</th>
					<th>Stock <br>Minimo</th>
					<th>Stock <br>Maximo</th>
					<th>Existencia</th><!--inventaria1-->
					<!-- <th>Costo <br>promedio</th> -->
					<!-- <th>Impuesto</th> -->
					<!-- <td>Estatus</td> -->
					<th>Precio <br> Unitario</th>
					<th>Unidad</th>
					<th>Equivale</th>
					<th>Codigo <br>Ingrediente</th>
					<!-- <td colspan=2 >Acciones</td> -->
				</tr>
			</thead>
			<tbody>
				<?php
				$costo_total=0;
				$total_prod=0;
				foreach ($productos as $producto) {
					$pedido=$producto->stockmax - $producto->inventa1;
					$costo_producto=$producto->ultcosto*$pedido;
					if($producto->inventa1 >=0 && $producto->inventa1 < $producto->stockmax){
						?>
						<tr>
							<td class="small"><?php echo $producto->descrip;?></td>
							<td bgcolor="#3ADF00"><?php echo $pedido;?></td>
							<!-- <td><input class="cantidad" type="number" name="<?php //echo $producto->codingre;?>" value="<?php //echo $pedido;?>" required></td> --> <!--Permite modificar la cantidad pedida-->
							<td><?php echo $costo_producto;?></td>
							<?php $costo_total=$costo_total+$costo_producto;
										$total_prod=$total_prod+1;
							?>
							<!-- <td><?php //echo $producto->familia;?></td> -->
							<!-- <td><?php //echo $producto->empaque;?></td> -->
							<td class="stock_mix"><?php echo $producto->stockmin;?></td>
							<td class="stock_max"><?php echo $producto->stockmax;?></td>
							<td class="existencia"><?php echo $producto->inventa1;?></td>
							<td class="precio_unitario"><?php echo $producto->ultcosto;?></td>
							<!-- <td><?php //echo $producto->costoprome;?></td> -->
							<!-- <td><?php //echo $producto->impuesto;?></td> -->
							<!-- <td><?php //echo $producto->status;?></td> -->
							<!-- <td><a href="Controllers/producto_controller.php?action=update&codingre=<?php// echo $producto->codingre ?>">Actualizar</a> </td> -->
							<!-- <td><a href="Controllers/producto_controller.php?action=delete&codingre=<?php// echo $producto->codingre ?>">Eliminar</a> </td> -->
							<td><?php echo $producto->unidad;?></td>
							<td><?php echo $producto->equivale;?></td>
							<td><?php echo $producto->codingre; ?></td>
						</tr>
					<?php  }//end if
				}//end switch
				//require_once("../librerias/js/verifica_cambio_pedido.js");
	//Recupera los datos modificados en la vista
	//$modificados = "<script>datos</script>";
	 				?>
	 						<tr>
								<td colspan="10" id="costo_total">Total de Compra = <?php echo $costo_total?></td>
							</tr>
			</tbody>
		</table>
	</div>
</div>
</section>

<?php if($total_prod>0){
?>
		<form action="Controllers/producto_controller.php" method="post" id="pedido_form">
		<input type="hidden" name="action" value="pedido">
		<input type="hidden" name="familia" value="<?php echo $producto->familia;?>" >
		<input type="hidden" name="costo_total" value="<?php echo $costo_total;?>" id="costo_total_mod">
		<input type="hidden" name="total_prod" value="<?php echo $total_prod;?>">
		<input type="hidden" name="modificados" value="" id="array_modifica">
		<input type="hidden" name="observacion" value="--">
		<center>
			<!-- <input type="submit" value="Pedido" class="btn btn-success" onclick="return foor();"> -->
			<button type="submit" class="btn btn-success" onclick="return foor();">
				Pedido &nbsp; <span class="oi" data-glyph="cart"></span>
			</button>
			<button type="reset" class="btn btn-danger" onclick="cancela_pedido();" >
				Cancelar &nbsp; <span class="oi" data-glyph="x"></span>
			</button>
		</center>
	</form>
	<?php
	}else{
			echo "<h1 align='center'>No hay productos a pedir<h1>
			<div align='center'>
			<a href='javascript:window.history.back();' class='btn btn-primary'>&laquo; Volver atrás</a>
			<!-- <a href='../?controller=pedido&action=ver_pedido_cancelado_todos' class='btn btn-primary'>Regresar</a> -->
			</div>";
	}

}else{//end if visible
		echo "<h1 align='center'>Pagina expirada, has cancelado tu pedido o ya se realizo<h1>
			<div align='center'>
			<a href='javascript:window.history.back();' class='btn btn-primary'>&laquo; Volver atrás</a>
			</div>";
}
	?>
	<!-- <script src="Public/librerias/verifica_cambio_pedido.js"></script> --> <!--Sirve para validar las entradas -->
	<?php
		}else{
			//Inclur una pagina para redireccionar a index
			header('Location: Views/sesion/no_sesion.php');
		}
	}
	?>
