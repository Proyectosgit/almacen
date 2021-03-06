$(document).ready(function(){

  var id_producto=0;  var datos="";     var stock_max;
  var stock_min;      var existencia;   var cantidad_aux;
  var exp;            var redondeo="";  var cantidad;

  $(".cantidad").each(function(){
      $(this).parents("tr").find(".cantidad").css("background-color","#b8ff54");
      // $(this).parents("tr").find(".cantidad").css("width",($(this).parents("tr").find(".cantidad").val().length+1)+"em");
      $(this).parents("tr").find(".cantidad").css("width","70px");
      cantidad = $(this).parents("tr").find(".cantidad").val();
    })

  $(".cantidad").change(function(){

    cantidad    =   $(this).parents("tr").find(".cantidad").val();
    id_producto =   $(this).parents("tr").find(".cantidad").attr("name");
    stock_min   =   $(this).parents("tr").find(".cantidad").attr("min");
    stock_max   =   $(this).parents("tr").find(".stock_max").html();
    existencia  =   $(this).parents("tr").find(".existencia").html();
    redondeo    =   $(this).parents("tr").find(".redondeo").val();

    console.log(typeof(cantidad));
    console.log(cantidad);
    cantidad = cantidad.replace(',','.');

    if(redondeo == "" || redondeo == 0){
        cantidad = parseFloat(cantidad);
        cantidad = cantidad.toFixed(2);
        cantidad = cantidad.toLocaleString();
    }else if(redondeo == 1){
        cantidad = Math.ceil(cantidad);
        cantidad = cantidad.toFixed(2);
        cantidad = cantidad.toLocaleString();
    }

    $(this).parents("tr").find(".cantidad").val(cantidad);
    // console.log(cantidad);
    existencia = Math.abs(existencia);
    cantidad_aux = stock_max-existencia;
    console.log("---cantidad_aux-----");
    console.log(cantidad_aux);
    console.log("---fin cantidad_aux-----");

    if(cantidad.match(/^[0-9]+.?[0-9]*/) && !($(this).parents("tr").find(".cantidad").val().length == 0)){
      // $(this).parents("tr").find(".cantidad").css("width",($(this).parents("tr").find(".cantidad").val().length+1)+"em");
      $(this).parents("tr").find(".cantidad").css("width","70px");

      //Calcula el precio por producto, dependiendo la cantidad
      var precio_unitario=$(this).parents("tr").find(".precio_unitario").html();

      var costo_producto=precio_unitario*cantidad;
      // console.log(costo_producto);
      costo_producto=costo_producto.toFixed(2);
      $(this).parents("tr").find(".costo_producto").html(costo_producto.toLocaleString());

      //Ingresa el id y cantidas de productos a un string y si esta reempraza la cantidad
      // console.log(id_producto);
      exp = new RegExp(id_producto+":[0-9]+.?[0-9]*(?= )","g");
      // console.log("Expresion"+exp);
      if (datos.match(exp)) {
        rem=datos.match(exp)
        datos=datos.replace(rem[0],id_producto+":"+cantidad);
      }
      else {
        datos=datos+id_producto+":"+cantidad+" ";
      }

      //calcula la suma total de los productos
      var totalDeuda=0;
      $(".costo_producto").each(function(){
        totalDeuda+=parseFloat($(this).html().replace(",","")||0);
      });


      $("#costo_total").html("Total de Compra = " + totalDeuda.toLocaleString());
      //Pone los datos modificados en un value de un relacion_pedido_producto
      $("#array_modifica").val(datos);
      $("#costo_total_mod").val(totalDeuda);

      if(cantidad > cantidad_aux){
        alert("Estas solicitando más de lo sugerido = " + cantidad_aux);
      }else if(cantidad < cantidad_aux){
        alert("Estas solicitando menos de lo sugerido = " + cantidad_aux);
      }
      console.log("----Lista de datos si es numero---------");
      console.log(datos);
      console.log("----End de datos si es numero---------");

    }else{

        if( cantidad_aux < 0 ){
            cantidad_aux = 0;
        }

        $(this).parents("tr").find(".cantidad").css("background-color", "#fdaf9c" );
        alert("Ingresa una cantidad valida");

        $(this).parents("tr").find(".cantidad").val(cantidad_aux);
        $(this).parents("tr").find(".cantidad").css("background-color","#b8ff54");


        // start guarda datos
        exp = new RegExp(id_producto+":[0-9]+.?[0-9]*(?= )","g");
        if (datos.match(exp)) {
            rem=datos.match(exp)
            datos=datos.replace(rem[0],id_producto+":"+cantidad_aux);
        }else {
            datos=datos+id_producto+":"+cantidad_aux+" ";
        }
        console.log("----Lista de datos si no es numero---------");
        console.log(datos);
        console.log("----End de datos si no es numero---------");
        //End guarda datos.
    }
  });
});
