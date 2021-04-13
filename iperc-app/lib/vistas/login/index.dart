import 'package:flutter/material.dart';
import 'package:iperc/globales/variables/estilos.dart';
import 'package:iperc/vistas/inicio/index.dart';
import 'package:iperc/vistas/inicio/inicio.dart';
import 'package:iperc/vistas/login/funciones/funLogin.dart';
import 'package:iperc/vistas/login/funciones/funObtenerIdSede.dart';
import 'package:iperc/vistas/login/funciones/funObtenerSedes.dart';
import 'package:iperc/vistas/login/funciones/funValidarLogin.dart';
import 'package:iperc/vistas/login/variables/varLoginListaSedes.dart';
import 'package:iperc/widgets/btn.dart';
import 'package:iperc/widgets/btnDesplegable.dart';
import 'package:iperc/widgets/cambiarPagina.dart';
import 'package:iperc/widgets/campoTexto.dart';
import 'package:iperc/widgets/fondo.dart';
import 'package:iperc/widgets/lineaBottom.dart';
import 'package:iperc/widgets/titulo.dart';
import 'package:iperc/widgets/toast.dart';
import 'package:modal_progress_hud/modal_progress_hud.dart';

class IndexLogin extends StatefulWidget {
  
  IndexLogin({Key key}) : super(key: key);
  
  @override
  IndexLoginState createState() => IndexLoginState();
}

class IndexLoginState extends State<IndexLogin> {

  bool modalAbierto = true;
  bool seleccionarCodigo = false;
  String txtSedeSeleccionado = 'one';
  int idSedeSeleccionado = 0;
  String codigoSap = '';

  @override
  void initState()
  {
    super.initState();
    funObtenerDataInicial();
  }

  funObtenerDataInicial()
  async{
    bool estadoDataInicial = false;
    if(await funObtenerSedes() == true)
    {
      estadoDataInicial = true;
      setState(() {
        txtSedeSeleccionado = listaNombresSedes[0];
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
      body: ModalProgressHUD(
        inAsyncCall: modalAbierto,
        child: SafeArea(
          child: Stack(
            children: <Widget>[
              // lineaBottom(context, true, true),

              titulo('Inicio', false, false, (){}, true),
              fondo(context),
              Positioned(
                child: Container(
                  margin: EdgeInsets.only(
                    top: 140.0,
                  ),
                  child: Center(
                    child: ListView(
                      children: <Widget>[
                        Container(
                          margin: EdgeInsets.only(
                            left: 40.0,
                            right: 40.0,
                            bottom: 30.0
                          ),
                          child: Column(
                            mainAxisAlignment: MainAxisAlignment.start,
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: <Widget>[
                              Text(
                                'Sede',
                                style: Estilos.parrafoNegrita,
                              ),
                              Padding(
                                padding: EdgeInsets.only(
                                  top: 10.0
                                ),
                                child: btnDesplegable(
                                  'Selecciona su Sede',
                                  txtSedeSeleccionado,
                                  listaNombresSedes,
                                  (texto)async{
                                    idSedeSeleccionado = await funObtenerIdSede(texto);
                                    setState(() {
                                      txtSedeSeleccionado = texto;
                                    });

                                    
                                  }
                                ),
                              ),
                              SizedBox(
                                height: 30.0,
                              ),
                              Text(
                                'Código SAP',
                                style: Estilos.parrafoNegrita,
                              ),

                              campoTextoNumerico(
                                context,
                                seleccionarCodigo,
                                (){
                                  setState(() {
                                    seleccionarCodigo = true;
                                  });
                                },
                                (texto){
                                  codigoSap = texto;
                                }
                              ),

                              SizedBox(
                                height: 40.0,
                              ),

                              btn(
                                ()async{
                                  if( await funValidarLogin(idSedeSeleccionado, '$codigoSap' ) == true)
                                  {
                                    setState(() {
                                      modalAbierto = true;
                                    });
                                    if(await funLogin(
                                      idSedeSeleccionado,
                                      codigoSap
                                    ) == true)
                                    {
                                      cambiarPagina(context, IndexInicio(idSede: idSedeSeleccionado,));
                                    }else{
                                      toastError(
                                        'El codigo SAP es incorrecto!'
                                      );
                                    }
                                  }else{

                                  }
                                  setState(() {
                                    modalAbierto = false;
                                  });
                                },
                                'ENTRAR'
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