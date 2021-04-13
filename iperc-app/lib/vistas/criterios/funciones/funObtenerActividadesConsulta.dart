import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:iperc/globales/funciones/funArmarListaNombres.dart';
import 'package:iperc/globales/funciones/funEstadoHttp.dart';
import 'package:iperc/globales/variables/varConexion.dart';
import 'package:iperc/vistas/criterios/variables/varCriteriosIds.dart';
import 'package:iperc/vistas/criterios/variables/varCriteriosListas.dart';
import 'package:iperc/vistas/inicio/variables/varInicioIds.dart';

funObtenerActividadesConsulta(
  
)
async{
  bool respuesta = false;
  
  try{
    var response = await http.post(
      varConexionUrl+"get-activities",
      headers: {
        "Content-type": "application/json"
      },
      body: jsonEncode({
        "key": "$apikey",
        "sub_process" : varInicioIdSubProcesoSeleccionado
      })
    );
    print('estado http');
    print(response.statusCode);
    print('respuesta body');
    print(response.body);
    var body = jsonDecode(response.body);
    
    if(funEstadoHttp(response.statusCode) == true)
    {

      varCriteriosListaActividadesConsulta = body;
      varCriteriosListaNombresActividadesConsulta = await funArmarListaNombres(varCriteriosListaActividadesConsulta);
      respuesta = true;
    }else{
      respuesta = false;
    }

  }catch(erro){
    respuesta = false;
    print('ERROR CATCH funObtenerActividadesConsulta');
    print(erro);
  }

  return respuesta;
}