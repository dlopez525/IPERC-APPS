import 'package:iperc/vistas/criterios/variables/varCriteriosIds.dart';
import 'package:iperc/vistas/inicio/variables/varInicioIds.dart';
import 'package:iperc/widgets/toast.dart';

funValidarCriterios()
{
  bool respuesta = false;
  if(varInicioIdSubProcesoSeleccionado == 0)
  {
    toastError(
      'Lo sentimos, es necesario seleccionar un Sub-Proceso!'
    );
    respuesta = false;
  }else if(varCriteriosIdActividadConsultaSeleccionado == 0)
  {
    toastError(
      'Lo sentimos, es necesario seleccionar una Actividad en Consulta!'
    );
    respuesta = false;
  }else{
    respuesta = true;
  }

  return respuesta;
}