import 'dart:convert';

import 'package:http/http.dart' as http;
import 'package:iperc/globales/variables/varConexion.dart';
import 'package:iperc/vistas/login/funciones/funArmarListaNombresSedes.dart';
import 'package:iperc/vistas/login/variables/varLoginListaSedes.dart';

funObtenerSedes(
  
)
async{
  bool respuesta = false;
  
  try{
    var response = await http.post(
      varConexionUrl+"get-headquarters",
      headers: {
        "Content-type": "application/json"
      },
      body: jsonEncode({
        "key": "$apikey"
      })
    );
    print('estado http');
    print(response.statusCode);
    print('respuesta body');
    print(response.body);
    var body = jsonDecode(response.body);
    
    if(response.statusCode == 200)
    {
      listaSedes = body['data'];
      listaNombresSedes = await funArmarListaNombresSedes();
      respuesta = true;
    }else{
      respuesta = false;
    }

  }catch(erro){
    respuesta = false;
    print('ERROR CATCH funObtenerSedes');
    print(erro);
  }

  return respuesta;
}