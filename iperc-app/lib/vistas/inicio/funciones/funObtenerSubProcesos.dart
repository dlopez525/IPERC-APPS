import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:iperc/globales/funciones/funArmarListaNombres.dart';
import 'package:iperc/globales/funciones/funEstadoHttp.dart';
import 'package:iperc/globales/variables/varConexion.dart';
import 'package:iperc/vistas/inicio/variables/varInicioListas.dart';

funObtenerSubProcesos(
  int idZona
)
async{
  bool respuesta = false;
  
  try{
    var response = await http.post(
      varConexionUrl+"get-sub-processes",
      headers: {
        "Content-type": "application/json"
      },
      body: jsonEncode({
        "key": "$apikey",
        "zone" : idZona
      })
    );
    print('estado http');
    print(response.statusCode);
    print('respuesta body');
    print(response.body);
    var body = jsonDecode(response.body);
    
    if(funEstadoHttp(response.statusCode) == true)
    {

      varInicioListaSubProcesos = body;
      varInicioListaNombresSubProcesos = await funArmarListaNombres(varInicioListaSubProcesos);
      respuesta = true;
    }else{
      respuesta = false;
    }

  }catch(erro){
    respuesta = false;
    print('ERROR CATCH funObtenerSubProcesos');
    print(erro);
  }

  return respuesta;
}