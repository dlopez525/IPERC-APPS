import 'package:flutter/material.dart';
import 'package:iperc/globales/funciones/funObtenerIdLista.dart';
import 'package:iperc/globales/variables/estilos.dart';
import 'package:iperc/vistas/criterios/funciones/funObtenerActividadesConsulta.dart';
import 'package:iperc/vistas/criterios/funciones/funObtenerPuestosTrabajo.dart';
import 'package:iperc/vistas/criterios/funciones/funValidarCriterios.dart';
import 'package:iperc/vistas/criterios/variables/varCriteriosIds.dart';
import 'package:iperc/vistas/criterios/variables/varCriteriosListas.dart';
import 'package:iperc/vistas/inicio/variables/varInicioIds.dart';
import 'package:iperc/vistas/inicio/variables/varInicioListas.dart';
import 'package:iperc/vistas/tareas/index.dart';
import 'package:iperc/widgets/btn.dart';
import 'package:iperc/widgets/btnDesplegable.dart';
import 'package:iperc/widgets/cambiarPagina.dart';
import 'package:iperc/widgets/fondo.dart';
import 'package:iperc/widgets/lineaBottom.dart';
import 'package:iperc/widgets/menuDesplegable.dart';
import 'package:iperc/widgets/titulo.dart';
import 'package:iperc/widgets/top.dart';
import 'package:modal_progress_hud/modal_progress_hud.dart';

class IndexCriterios extends StatefulWidget {
  
  IndexCriterios({Key key}) : super(key: key);
  
  @override
  IndexCriteriosState createState() => IndexCriteriosState();
}

class IndexCriteriosState extends State<IndexCriterios> {

  bool modalAbierto = true;
  String txtSubProcesoSeleccionado = '';
  String txtPuestoTrabajoSeleccionado = 'One';
  String txtActividadConsultaSeleccionado = '';

  @override
  void initState()
  {
    super.initState();
    funObtenerDataInicial();
  }

  funObtenerDataInicial()
  async{
    bool estadoDataInicial = true;
    setState(() {
      modalAbierto = false;
      txtSubProcesoSeleccionado = varInicioListaNombresSubProcesos[0];
    });
    
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
              titulo('Criterios', false, false, (){}, true),
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
                                'Seleccióna un Sub-Proceso',
                                style: Estilos.parrafoNegrita,
                              ),
                              SizedBox(
                                height: 10.0,
                              ),
                              btnDesplegable(
                                'Seleccione su Sub-Proceso',
                                txtSubProcesoSeleccionado,
                                varInicioListaNombresSubProcesos,
                                (texto) async{
                                  try{
                                    setState(() {
                                      modalAbierto = true;
                                      txtSubProcesoSeleccionado = texto;
                                    });
                                    varInicioIdSubProcesoSeleccionado = await funObtenerIdLista(varInicioListaSubProcesos, texto);
                                    await funObtenerActividadesConsulta();
                                    setState(() {
                                      modalAbierto = false;
                                      txtActividadConsultaSeleccionado = varCriteriosListaNombresActividadesConsulta[0];
                                    });
                                  }catch(erro){
                                    setState(() {
                                      modalAbierto = false;
                                    });
                                  }
                                }
                              ),
                              SizedBox(
                                height: 30.0,
                              ),
                              
                              Text(
                                'Selecciona la Actividad en Consulta',
                                style: Estilos.parrafoNegrita,
                              ),
                              SizedBox(
                                height: 10.0,
                              ),
                              btnDesplegable(
                                'Seleccione la actividad en consulta',
                                txtActividadConsultaSeleccionado,
                                varCriteriosListaNombresActividadesConsulta,
                                (texto) async{
                                  setState(() {
                                    txtActividadConsultaSeleccionado = texto;
                                  });

                                  varCriteriosIdActividadConsultaSeleccionado = await funObtenerIdLista(varCriteriosListaActividadesConsulta, texto);
                                }
                              ),

                              SizedBox(
                                height: 40.0,
                              ),

                              btn(
                                () async{
                                  if(await funValidarCriterios() == true)
                                  {
                                    cambiarPagina(context, IndexTareas());
                                  }else{

                                  }
                                },
                                'CONTINUAR'
                              ),

                              SizedBox(
                                height: 40.0,
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
            ],
          )
        ),
      )
    );
  }
} 