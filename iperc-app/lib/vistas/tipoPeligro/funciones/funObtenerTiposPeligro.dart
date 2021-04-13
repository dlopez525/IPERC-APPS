import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:iperc/globales/funciones/funEstadoHttp.dart';
import 'package:iperc/globales/variables/varConexion.dart';
import 'package:iperc/vistas/tareas/variables/varTareasIds.dart';
import 'package:iperc/vistas/tipoPeligro/variables/varTiposPeligrosListas.dart';

funObtenerTiposPeligro(
  
)
async{
  bool respuesta = false;
  
  try{
    var response = await http.post(
      varConexionUrl+"get-task-danger",
      headers: {
        "Content-type": "application/json"
      },
      body: jsonEncode({
        "key": "$apikey",
        "task" : varTareasIdTareasSeleccionado
      })
    );
    print('estado http');
    print(response.statusCode);
    print('respuesta body');
    print(response.body);
    var body = jsonDecode(response.body);
    
    if(funEstadoHttp(response.statusCode) == true)
    {

      varTiposPeligrosListaTiposPeligro = body;
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