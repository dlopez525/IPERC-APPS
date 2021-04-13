import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:iperc/globales/funciones/funArmarListaNombres.dart';
import 'package:iperc/globales/funciones/funEstadoHttp.dart';
import 'package:iperc/globales/variables/varConexion.dart';
import 'package:iperc/vistas/criterios/variables/varCriteriosIds.dart';
import 'package:iperc/vistas/tareas/variables/varTareasListas.dart';

funObtenerTareas(
  
)
async{
  bool respuesta = false;
  
  try{
    var response = await http.post(
      varConexionUrl+"get-tasks",
      headers: {
        "Content-type": "application/json"
      },
      body: jsonEncode({
        "key": "$apikey",
        "activity" : varCriteriosIdActividadConsultaSeleccionado
      })
    );
    print('estado http');
    print(response.statusCode);
    print('respuesta body');
    print(response.body);
    var body = jsonDecode(response.body);
    
    if(funEstadoHttp(response.statusCode) == true)
    {

      varTareasListaTareas = body;
      varTareasListaNombresTareas = await funArmarListaNombres(varTareasListaTareas);
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