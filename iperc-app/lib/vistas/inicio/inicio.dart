import 'package:flutter/material.dart';
import 'package:iperc/globales/funciones/funObtenerIdLista.dart';
import 'package:iperc/globales/variables/estilos.dart';
import 'package:iperc/vistas/criterios/index.dart';
import 'package:iperc/vistas/inicio/funciones/funEnviarAuditoria.dart';
import 'package:iperc/vistas/inicio/funciones/funObtenerAreas.dart';
import 'package:iperc/vistas/inicio/funciones/funObtenerPuestosTrabajo.dart';
import 'package:iperc/vistas/inicio/funciones/funObtenerSubProcesos.dart';
import 'package:iperc/vistas/inicio/funciones/funObtenerZonas.dart';
import 'package:iperc/vistas/inicio/funciones/funValidarInicio.dart';
import 'package:iperc/vistas/inicio/variables/varInicioIds.dart';
import 'package:iperc/vistas/inicio/variables/varInicioListas.dart';
import 'package:iperc/widgets/btn.dart';
import 'package:iperc/widgets/btnDesplegable.dart';
import 'package:iperc/widgets/cambiarPagina.dart';
import 'package:iperc/widgets/fondo.dart';
import 'package:iperc/widgets/lineaBottom.dart';
import 'package:iperc/widgets/titulo.dart';
import 'package:iperc/widgets/toast.dart';
import 'package:iperc/widgets/top.dart';
import 'package:modal_progress_hud/modal_progress_hud.dart';

class IndexInicio extends StatefulWidget {
  final int idSede;
  IndexInicio({Key key, this.idSede}) : super(key: key);
  
  @override
  IndexInicioState createState() => IndexInicioState();
}

class IndexInicioState extends State<IndexInicio> {

  String txtPuestoTrabajoSeleccionado = '';
  String txtAreaSeleccionado = '';
  String txtZonaSeleccionado = '';
  String txtSubProcesoSeleccionado = '';

  bool modalAbierto = true;
  
  @override
  void initState()
  {
    super.initState();
    funObtenerDataInicial();
    
  }

  funObtenerDataInicial()
  async{
    bool estadoDataInicial = false;
    setState(() {
      varInicioListaAreas = [];
      varInicioListaNombreAreas = [];
      varInicioListaZonas = [];
      varInicioListaNombreZonas = [];
      varInicioListaSubProcesos = [];
      varInicioListaNombresSubProcesos  = [];
    });
    if(await funObtenerPuestosTrabajo(widget.idSede) == true)
    {
      estadoDataInicial = true;
      setState(() {
        txtPuestoTrabajoSeleccionado = varInicioListaNombrePuestrosTrabajo[0];
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
      // drawer: menuDesplegable(),
      body: ModalProgressHUD(
        inAsyncCall: modalAbierto,
        child: SafeArea(
          child: Stack(
            children: <Widget>[
              fondo(context),
              Positioned(
                child: Container(
                  child: Center(
                    child: ListView(
                      children: <Widget>[
                        titulo('Bienvenido', false, true, (){}, false),
                        Container(
                          margin: EdgeInsets.only(
                            top: 20.0,
                            left: 40.0,
                            right: 40.0
                          ),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: <Widget>[
                              Text(
                                'Selecciona tu Puesto de Trabajo',
                                style: Estilos.parrafoNegrita,
                              ),
                              SizedBox(
                                height: 10.0,
                              ),
                              btnDesplegable(
                                'Seleccione un puesto de trabajo',
                                txtPuestoTrabajoSeleccionado,
                                varInicioListaNombrePuestrosTrabajo,
                                (texto) async{

                                  try{
                                    setState(() {
                                      txtPuestoTrabajoSeleccionado = texto;
                                      modalAbierto = true;
                                    });

                                    varInicioIdPuestoTrabajoSeleccionado = await funObtenerIdLista(varInicioListaPuestosTrabajo, texto);
                                    await funObtenerAreas(varInicioIdPuestoTrabajoSeleccionado, texto);
                                    setState(() {
                                      modalAbierto = false;
                                      txtAreaSeleccionado = varInicioListaNombreAreas[0];
                                    });
                                  }catch(error){
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
                                'Seleccióna tu Área',
                                style: Estilos.parrafoNegrita,
                              ),
                              SizedBox(
                                height: 10.0,
                              ),
                              btnDesplegable(
                                'Seleccione una Área de trabajo',
                                txtAreaSeleccionado,
                                varInicioListaNombreAreas,
                                (texto) async{

                                  try{
                                    setState(() {
                                      txtAreaSeleccionado = texto;
                                      modalAbierto = true;
                                    });

                                    varInicioIdAreaSeleccionado = await funObtenerIdLista(varInicioListaAreas, texto);
                                    await funObtenerZonas(varInicioIdAreaSeleccionado, texto, txtPuestoTrabajoSeleccionado);
                                    setState(() {
                                      modalAbierto = false;
                                      txtZonaSeleccionado = varInicioListaNombreZonas[0];
                                    });
                                  }catch(error){
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
                                'Seleccióna tu Zona',
                                style: Estilos.parrafoNegrita,
                              ),
                              SizedBox(
                                height: 10.0,
                              ),
                              btnDesplegable(
                                'Seleccione su Zona',
                                txtZonaSeleccionado,
                                varInicioListaNombreZonas,
                                (texto)async{
                                  try{
                                    setState(() {
                                      txtZonaSeleccionado = texto;
                                      modalAbierto = true;
                                    });

                                    varInicioIdZonaSeleccionado = await funObtenerIdLista(varInicioListaZonas, texto);
                                    await funObtenerSubProcesos(varInicioIdZonaSeleccionado);

                                    setState(() {
                                      modalAbierto = false;
                                      txtSubProcesoSeleccionado = varInicioListaNombresSubProcesos[0];
                                    });
                                  }catch(error){
                                    setState(() {
                                      modalAbierto = false;
                                    });
                                  }
                                }
                              ),
                              // SizedBox(
                              //   height: 30.0,
                              // ),
                              // Text(
                              //   'Seleccióna un Sub-Proceso',
                              //   style: Estilos.parrafoNegrita,
                              // ),
                              // SizedBox(
                              //   height: 10.0,
                              // ),
                              // btnDesplegable(
                              //   txtSubProcesoSeleccionado,
                              //   varInicioListaNombresSubProcesos,
                              //   (texto) async{
                              //     setState(() {
                              //       txtSubProcesoSeleccionado = texto;
                              //     });
                                  
                              //     varInicioIdSubProcesoSeleccionado = await funObtenerIdLista(varInicioListaSubProcesos, texto);

                              //   }
                              // ),
                              SizedBox(
                                height: 40.0,
                              ),


                              btn(
                                ()async{

                                  if(await funValidarInicio() == true)
                                  {
                                    setState(() {
                                      modalAbierto = true;
                                    });
                                    if(await funEnviarAuditoria() == true)
                                    {
                                      // cambiarPagina(context, IndexCriterios());
                                      cambiarPagina(context, IndexCriterios());
                                    }else
                                    {
                                      // cambiarPagina(context, IndexCriterios());
                                      toastError(
                                        'Lo sentimos, ocurrio un error al momento de enviar la información, porfavor vuelva a seleccionar una Área'
                                      );
                                    }

                                  }else
                                  {
                                    
                                  }
                                  setState(() {
                                    modalAbierto = false;
                                  });
                                },
                                'CONTINUAR'
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