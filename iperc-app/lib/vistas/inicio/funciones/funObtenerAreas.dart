import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:iperc/globales/funciones/funArmarListaNombres.dart';
import 'package:iperc/globales/funciones/funEstadoHttp.dart';
import 'package:iperc/globales/variables/varConexion.dart';
import 'package:iperc/vistas/inicio/variables/varInicioListas.dart';
import 'package:iperc/vistas/login/variables/varLoginInt.dart';

funObtenerAreas(
  int idJobPosition,
  String nombreJobPosition
)
async{
  bool respuesta = false;
  
  try{
    print(varConexionUrl);
    print(apikey);
    print(idJobPosition);
    var response = await http.post(
      varConexionUrl+"get-areas",
      headers: {
        "Content-type": "application/json"
      },
      body: jsonEncode({
        "key": "$apikey",
        // "job_position" : idJobPosition
        "job_position" : nombreJobPosition,
        "headquarter"  : varLoginIntIdHeadquarter
      })
    );
    print('job_position: $idJobPosition');
    print('estado http');
    print(response.statusCode);
    print('respuesta body');
    print(response.body);
    var body = jsonDecode(response.body);
    
    if(funEstadoHttp(response.statusCode) == true)
    {

      varInicioListaAreas = body;
      varInicioListaNombreAreas = await funArmarListaNombres(varInicioListaAreas);
      respuesta = true;
    }else{
      respuesta = false;
    }

  }catch(erro){
    respuesta = false;
    print('ERROR CATCH funObtenerAreas');
    print(erro);
  }

  return respuesta;
}