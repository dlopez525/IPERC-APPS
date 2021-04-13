import 'package:iperc/vistas/inicio/variables/varInicioIds.dart';
import 'package:iperc/widgets/toast.dart';

funValidarInicio()
{
  bool respuesta = false;
  if(varInicioIdAreaSeleccionado == 0)
  {
    toastError(
      'Lo sentimos, es necesario seleccionar una Área!'
    );
    respuesta = false;
  }else if(varInicioIdZonaSeleccionado == 0)
  {
    toastError(
      'Lo sentimos, es necesario seleccionar una Zona!'
    );
    respuesta = false;
  }else if(varInicioIdPuestoTrabajoSeleccionado == 0)
  {
    toastError(
      'Lo sentimos, es necesario seleccionar un Puesto de trabajo!'
    );
    respuesta = false;
  }else{
    respuesta = true;
  }
  return respuesta;
}