funEstadoHttp(int estadoHttp)
{
  bool todoCorrecto = false;
  if(estadoHttp == 200)
  {
    todoCorrecto = true;
  }else{
    todoCorrecto = false;
  }
  return todoCorrecto;
}