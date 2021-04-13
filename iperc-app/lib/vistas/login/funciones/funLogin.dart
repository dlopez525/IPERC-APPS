import 'dart:convert';

import 'package:http/http.dart' as http;
import 'package:iperc/globales/variables/varConexion.dart';
import 'package:iperc/globales/variables/varUsuario.dart';
import 'package:iperc/vistas/login/variables/varLoginInt.dart';

funLogin(
  int idSede,
  String codigosap
)
async{
  bool respuesta = false;
  try{
    var response = await http.post(
      varConexionUrl+'login',
      headers: {
        "Content-type": "application/json"
      },
      body: jsonEncode({
        'key' : apikey,
        'headquarter' : idSede,
        'sap' : '$codigosap'
      })
    );

    print('estado http');
    print(response.statusCode);
    print('respuesta body');
    print(response.body);
    var body = jsonDecode(response.body);
    
    if(body != false)
    {
      varUsuarioIdUsuario     = body['id'];
      varUsuarioNombreUsuario = body['name'];
      varLoginIntIdHeadquarter = idSede;
      respuesta = true;
    }else{
      respuesta = false;
    }

  }catch(erro){
    respuesta = false;
    print('ERROR CATCH');
    print(erro);
  }

  return respuesta;
}