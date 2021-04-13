import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:iperc/globales/funciones/funEstadoHttp.dart';
import 'package:iperc/globales/variables/varConexion.dart';
import 'package:iperc/vistas/descripcionPeligro/variables/varDescripcionPeligroListas.dart';
import 'package:iperc/vistas/tareas/variables/varTareasIds.dart';
import 'package:iperc/vistas/tipoPeligro/variables/varTiposPeligrosIds.dart';

funDescripcionPeligroObtenerIperc()
async{
  bool respuesta = false;
  
  try{
    var response = await http.post(
      varConexionUrl+"get-iperc",
      headers: {
        "Content-type": "application/json"
      },
      body: jsonEncode({
        "key": "$apikey",
        "task" : varTareasIdTareasSeleccionado,
        "danger" : varTiposPeligrosIdTipoPeligroSeleccionado
      })
    );
    print(varTareasIdTareasSeleccionado);
    print(varTiposPeligrosIdTipoPeligroSeleccionado);
    print('estado http');
    print(response.statusCode);
    print('respuesta body');
    print(response.body);
    var body = jsonDecode(response.body);
    
    if(funEstadoHttp(response.statusCode) == true)
    {

      varDescripcionPeligroLista = body;
      respuesta = true;
    }else{
      respuesta = false;
    }

  }catch(erro){
    respuesta = false;
    print('ERROR CATCH funObtenerTareas');
    print(erro);
  }

  return respuesta;
}