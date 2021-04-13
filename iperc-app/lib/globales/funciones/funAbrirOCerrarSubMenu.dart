import 'package:iperc/globales/variables/varGlobalesTamanoSubMenu.dart';

funAbrirOCerrarSubMenu()
{
  if(varGlobalTamanoSubMenu == 0.0 )
  {
    varGlobalTamanoSubMenu = 300.0;
  }else{
    varGlobalTamanoSubMenu = 0.0;
  }
}