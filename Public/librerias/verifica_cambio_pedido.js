$(document).ready(function(){

  //var cantidad=0;
  var id_producto=0;
  var datos="";
  var stock_max;
  var stock_min;
  var existencia;
  var cantidad_aux;
  var exp;
  //console.log(datos);

  //Coloca en verde todos los input
  $(".cantidad").each(function(){
    $(this).parents("tr").find(".cantidad").css("background-color","#b8ff54");
    //Ajusta tamaño de input
    $(this).parents("tr").find(".cantidad").css("width",($(this).parents("tr").find(".cantidad").val().length+1)+"em");
  })

  $(".cantidad").change(function(){
    cantidad = $(this).parents("tr").find(".cantidad").val();

    id_producto = $(this).parents("tr").find(".cantidad").attr("name");
    stock_min = $(this).parents("tr").find(".cantidad").attr("min");
    stock_min = $(this).parents("tr").find(".stock_min").html();
    stock_max = $(this).parents("tr").find(".stock_max").html();
    existencia = $(this).parents("tr").find(".existencia").html();
    cantidad_aux=stock_max-existencia;

    if(cantidad.match(/^[0-9]+/) && !($(this).parents("tr").find(".cantidad").val().length == 0)){
      //Ajusta tamaño de input
      //$(this).parents("tr").find(".cantidad").css("width",($(this).parents("tr").find(".cantidad").val().length+1)+"em");


      //Calcula el precio por producto, dependiendo la cantidad
      var precio_unitario=$(this).parents("tr").find(".precio_unitario").html();
      var costo_producto=precio_unitario*cantidad;
      $(this).parents("tr").find(".costo_producto").html(costo_producto);

      //Ingresa el id y cantidas de productos a un string y si esta reempraza la cantidad
      console.log(id_producto);
      exp = new RegExp(id_producto+":[0-9]+","g");
      console.log("Expresion"+exp);
      if (datos.match(exp)) {
        console.log("Resultado: "+datos.match(exp));
        rem=datos.match(exp)
        datos=datos.replace(rem[0],id_producto+":"+cantidad);
      }
      else {
        datos=datos+id_producto+":"+cantidad+" ";
      }
      console.log(datos);
      console.log(typeof(datos));

      //calcula la suma total de los productos
      var totalDeuda=0;
      $(".costo_producto").each(function(){
        totalDeuda+=parseFloat($(this).html()||0);
      });
      $("#costo_total").html("Total de Compra = " + totalDeuda);

      //Pone los datos modificados en un value de un relacion_pedido_producto
      $("#array_modifica").val(datos);
      $("#costo_total_mod").val(totalDeuda);

      if(cantidad > cantidad_aux){
        alert("Estas solicitando más de lo sugerido = " + cantidad_aux);
      }else if(cantidad < cantidad_aux){
        alert("Estas solicitando menos de lo sugerido = " + cantidad_aux);
      }


    }else{
      $(this).parents("tr").find(".cantidad").css("background-color", "#fdaf9c" );
      alert("Ingresa una cantidad valida");

      $(this).parents("tr").find(".cantidad").val(cantidad_aux);
      $(this).parents("tr").find(".cantidad").css("background-color","#b8ff54");
    }
  });
});
