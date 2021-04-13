import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:iperc/globales/funciones/funArmarListaNombres.dart';
import 'package:iperc/globales/funciones/funEstadoHttp.dart';
import 'package:iperc/globales/variables/varConexion.dart';
import 'package:iperc/vistas/inicio/variables/varInicioListas.dart';
import 'package:iperc/vistas/login/variables/varLoginInt.dart';

funObtenerZonas(
  int idArea,
  String nombreArea,
  String nombreJobPosition
)
async{
  bool respuesta = false;
  print("ID de sucursal");
  print(varLoginIntIdHeadquarter);
  try{
    var response = await http.post(
      varConexionUrl+"get-zones",
      headers: {
        "Content-type": "application/json"
      },
      body: jsonEncode({
        "key": "$apikey",
        // "area" : idArea
        "area" : nombreArea,
        "job_position" : nombreJobPosition,
        "headquarter" : varLoginIntIdHeadquarter
      })
    );
    print('estado http');
    print(response.statusCode);
    print('respuesta body');
    print(response.body);
    var body = jsonDecode(response.body);
    
    if(funEstadoHttp(response.statusCode) == true)
    {

      varInicioListaZonas = body;
      varInicioListaNombreZonas = await funArmarListaNombres(varInicioListaZonas);
      respuesta = true;
    }else{
      respuesta = false;
    }

  }catch(erro){
    respuesta = false;
    print('ERROR CATCH funObtenerZonas');
    print(erro);
  }

  return respuesta;
}