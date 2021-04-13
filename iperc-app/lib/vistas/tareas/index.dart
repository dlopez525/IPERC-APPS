import 'package:flutter/material.dart';
import 'package:iperc/globales/funciones/funAbrirOCerrarSubMenu.dart';
import 'package:iperc/globales/funciones/funObtenerIdLista.dart';
import 'package:iperc/globales/variables/estilos.dart';
import 'package:iperc/vistas/tareas/funciones/funObtenerTareas.dart';
import 'package:iperc/vistas/tareas/funciones/funValidarTareas.dart';
import 'package:iperc/vistas/tareas/variables/varTareasIds.dart';
import 'package:iperc/vistas/tareas/variables/varTareasListas.dart';
import 'package:iperc/vistas/tipoPeligro/index.dart';
import 'package:iperc/widgets/btn.dart';
import 'package:iperc/widgets/btnDesplegable.dart';
import 'package:iperc/widgets/cambiarPagina.dart';
import 'package:iperc/widgets/fondo.dart';
import 'package:iperc/widgets/lineaBottom.dart';
import 'package:iperc/widgets/menuDesplegable.dart';
import 'package:iperc/widgets/subMenu.dart';
import 'package:iperc/widgets/titulo.dart';
import 'package:iperc/widgets/top.dart';
import 'package:modal_progress_hud/modal_progress_hud.dart';

class IndexTareas extends StatefulWidget {
  
  IndexTareas({Key key}) : super(key: key);
  
  @override
  IndexTareasState createState() => IndexTareasState();
}

class IndexTareasState extends State<IndexTareas> {

  bool modalAbierto = true;
  String txtTareaSeleccionado = 'One';

  @override
  void initState()
  {
    super.initState();
    funObtenerDataInicial();
  }

  funObtenerDataInicial()
  async{
    bool estadoDataInicial = false;
    if(await funObtenerTareas() == true)
    {
      estadoDataInicial = true;
      setState(() {
        txtTareaSeleccionado = varTareasListaNombresTareas[0];
        modalAbierto = false;
      });
    }else{
      funObtenerDataInicial();
      estadoDataInicial = false;
    }
    return estadoDataInicial;
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      appBar: top(context),
      drawer: menuDesplegable(),
      body: ModalProgressHUD(
        inAsyncCall: modalAbierto,
        child: SafeArea(
          child: Stack(
            children: <Widget>[
              titulo(
                'Tareas', 
                false,
                false,
                (){
                  setState(() {
                    funAbrirOCerrarSubMenu();
                  });
                },
                true
              ),
              fondo(context),
              Positioned(
                child: Container(
                  margin: EdgeInsets.only(
                    top: 70.0,
                  ),
                  child: Center(
                    child: ListView(
                      children: <Widget>[
                        Container(
                          margin: EdgeInsets.only(
                            left: 40.0,
                            right: 40.0
                          ),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: <Widget>[
                              Text(
                                'Selecciona una Tarea',
                                style: Estilos.parrafoNegrita,
                              ),
                              SizedBox(
                                height: 10.0,
                              ),
                              btnDesplegable(
                                'Seleccione una Tarea',
                                txtTareaSeleccionado,
                                varTareasListaNombresTareas,
                                (texto) async{
                                  setState(() {
                                    txtTareaSeleccionado = texto;
                                  });

                                  varTareasIdTareasSeleccionado = await funObtenerIdLista(varTareasListaTareas, texto);
                                }
                              ),
                              SizedBox(
                                height: 10.0,
                              ),
                              Text(
                                'Estas son las tareas que están relacionadas a la actividad seleccionada, elije una para consultar sus peligros, riesgos y medidas de controles.',
                                textAlign: TextAlign.center,
                                style: TextStyle( 
                                  fontFamily: 'nunito',
                                  fontSize: 13,
                                  letterSpacing: 0.0,
                                  wordSpacing: 0.0
                                ),
                              ),
                            
                              SizedBox(
                                height: 40.0,
                              ),


                              btn(
                                (){
                                  if(funValidarTareas() == true)
                                  {
                                    cambiarPagina(context, IndexTipoPeligro());
                                  }else{

                                  }
                                },
                                'Continuar'
                              ),
                              SizedBox(
                                height: 50.0,
                              ),
                            ],
                          ),
                        ),

                        lineaBottom(context, false, true, false),
                      ],
                    ),
                  )
                )
              ),

              subMenu(
                context,
                (){
                  setState(() {
                    funAbrirOCerrarSubMenu();
                  });
                }
              ),
            ],
          )
        ),
      )
    );
  }
} 