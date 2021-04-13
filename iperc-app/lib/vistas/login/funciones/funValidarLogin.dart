import 'package:iperc/widgets/toast.dart';

funValidarLogin(
  int idSede,
  String codigoSap
)
{
  bool respuesta = false;
  if(idSede == 0 || idSede == null)
  {
    toastError(
      'Lo sentimos, es necesario seleccionar una sede!'
    );
    respuesta = false;
  }else if(codigoSap == null || codigoSap == '')
  {
    toastError(
      'Lo sentimos, es necesario su codigo SAP!'
    );
    respuesta = false;
  }else{
    respuesta = true;
  }

  return respuesta;
}