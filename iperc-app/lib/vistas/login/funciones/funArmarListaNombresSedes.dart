import 'package:iperc/vistas/login/variables/varLoginListaSedes.dart';

funArmarListaNombresSedes()
async{
  List<String> listaNombreSedes = [];
  for(int cont = 0; cont < listaSedes.length; cont++)
  {
    await listaNombreSedes.add(listaSedes[cont]['name']);
  }
  
  return listaNombreSedes;
}