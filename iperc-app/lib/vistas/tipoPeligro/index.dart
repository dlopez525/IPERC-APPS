import 'package:flutter/material.dart';
import 'package:iperc/globales/funciones/funAbrirOCerrarSubMenu.dart';
import 'package:iperc/vistas/descripcionPeligro/funciones/funDescripcionPeligroObtenerIperc.dart';
import 'package:iperc/vistas/descripcionPeligro/index.dart';
import 'package:iperc/vistas/tipoPeligro/funciones/funObtenerTiposPeligro.dart';
import 'package:iperc/vistas/tipoPeligro/variables/varTiposPeligrosIds.dart';
import 'package:iperc/vistas/tipoPeligro/variables/varTiposPeligrosListas.dart';
import 'package:iperc/vistas/tipoPeligro/widgets/iconoPeligro.dart';
import 'package:iperc/widgets/cambiarPagina.dart';
import 'package:iperc/widgets/fondo.dart';
import 'package:iperc/widgets/lineaBottom.dart';
import 'package:iperc/widgets/menuDesplegable.dart';
import 'package:iperc/widgets/subMenu.dart';
import 'package:iperc/widgets/titulo.dart';
import 'package:iperc/widgets/top.dart';
import 'package:modal_progress_hud/modal_progress_hud.dart';

class IndexTipoPeligro extends StatefulWidget {
  
  IndexTipoPeligro({Key key}) : super(key: key);
  
  @override
  IndexTipoPeligroState createState() => IndexTipoPeligroState();
}

class IndexTipoPeligroState extends State<IndexTipoPeligro> {

  
  List listaTiposPeligro = [
    {
      "icono" : "",
      "texto" : "Peligros Fisicos",
      "seleccionado" : false
    },
    {
      "icono" : "",
      "texto" : "Peligros Otros",
      "seleccionado" : false
    },
    {
      "icono" : "",
      "texto" : "Peligros Arriba",
      "seleccionado" : false
    },
    {
      "icono" : "",
      "texto" : "Peligros Abajo",
      "seleccionado" : false
    },
    {
      "icono" : "",
      "texto" : "Peligros Cortos",
      "seleccionado" : false
    },
    {
      "icono" : "",
      "texto" : "Peligros Electricos",
      "seleccionado" : false
    },
  ];

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
    if(await funObtenerTiposPeligro() == true)
    {
      estadoDataInicial = true;
      setState(() {
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
      body: SafeArea(
        child: ModalProgressHUD(
          inAsyncCall: modalAbierto,
          child: Stack(
            children: <Widget>[
              titulo(
                'Tipos de Peligro', 
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
                  child: ListView(
                    children: <Widget>[
                      Container(
                        child: Center(
                          child: Column(
                            children: <Widget>[

                              Wrap(
                                children: <Widget>[
                                  
                                  for( int cont = 0; cont < varTiposPeligrosListaTiposPeligro.length; cont++)

                                  iconoPeligro(
                                    context,
                                    varTiposPeligrosListaTiposPeligro[cont]['image'],
                                    varTiposPeligrosListaTiposPeligro[cont]['name'],
                                    varTiposPeligrosListaTiposPeligro[cont]['seleccionado'],
                                    () async{
                                      setState(() {
                                        modalAbierto = true;
                                        varTiposPeligrosIdTipoPeligroSeleccionado = varTiposPeligrosListaTiposPeligro[cont]['id'];
                                      });
                                      for( int conta = 0; conta < varTiposPeligrosListaTiposPeligro.length; conta++)
                                      {
                                        if(cont == conta)
                                        {
                                          setState(() {
                                            varTiposPeligrosListaTiposPeligro[cont]['seleccionado'] = true;
                                          });
                                        }else{
                                          varTiposPeligrosListaTiposPeligro[conta]['seleccionado'] = false;
                                        }
                                      }
                                      await Future.delayed(
                                        Duration(seconds: 1),
                                        () async{

                                          await funDescripcionPeligroObtenerIperc();
                                          cambiarPagina(
                                            context, 
                                            IndexDescripcionPeligro()
                                          );
                                        }
                                      );
                                      setState(() {
                                        modalAbierto = false;
                                      });
                                    }
                                  )
                                ],
                              ),
                            
                            
                              // SizedBox(
                              //   height: 40.0,
                              // ),
                              // btn(
                              //   (){
                              //     // cambiarPagina(context, MyApp());
                              //   },
                              //   'Continuar'
                              // ),
                              lineaBottom(context, false, false, false),
                            ],
                          ),
                        )
                      )
                    ],
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
        )
      ),
    );
  }
} 