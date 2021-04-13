import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:iperc/globales/funciones/funEstadoHttp.dart';
import 'package:iperc/globales/variables/varConexion.dart';
import 'package:iperc/globales/variables/varUsuario.dart';
import 'package:iperc/vistas/inicio/variables/varInicioIds.dart';
import 'package:iperc/vistas/login/variables/varLoginInt.dart';

funEnviarAuditoria()
async{
  bool respuesta = false;
  
  try{
    var response = await http.post(
      varConexionUrl+"audits",
      headers: {
        "Content-type": "application/json"
      },
      body: jsonEncode({
        "key"         : "$apikey",
        "headquarter" : varLoginIntIdHeadquarter,
        "area"        : varInicioIdAreaSeleccionado,
        "worker"      : varUsuarioIdUsuario,
        "zone"        : varInicioIdZonaSeleccionado
      })
    );
    print("ESTADO HTTP DE AUDITORIAS");
    print(response.statusCode);
    print("BODY DE AUDITORIAS");
    print(response.body);
    var body = jsonDecode(response.body);
    
    if(funEstadoHttp(response.statusCode) == true)
    {
      if(body == true)
      {
        respuesta = true;
      }else
      {
        respuesta = false;  
      }
    }else
    {
      respuesta = false;
    }

  }catch(erro)
  {
    respuesta = false;
    print('ERROR CATCH funEnviarAuditoria');
    print(erro);
  }

  return respuesta;
}