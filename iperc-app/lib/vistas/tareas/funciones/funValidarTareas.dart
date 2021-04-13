import 'package:iperc/vistas/tareas/variables/varTareasIds.dart';
import 'package:iperc/widgets/toast.dart';

funValidarTareas()
{
  bool respuesta = false;
  if(varTareasIdTareasSeleccionado == 0)
  {
    toastError(
      'Lo sentimos, es necesario seleccionar una Tarea!'
    );
    respuesta = false;
  }else{
    respuesta = true;
  }

  return respuesta;
}