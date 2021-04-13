import 'package:iperc/vistas/login/variables/varLoginListaSedes.dart';

funObtenerIdSede(
  String nombreSede
)
async{
  int idSede = 0;
  for(int cont = 0; cont < listaSedes.length; cont++)
  {
    if(nombreSede == listaSedes[cont]['name'])
    {
      idSede = await listaSedes[cont]['id'];
    }
  }

  return idSede;
}