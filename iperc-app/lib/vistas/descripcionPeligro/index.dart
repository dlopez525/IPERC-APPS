import 'package:flutter/material.dart';
import 'package:iperc/globales/variables/estilos.dart';
import 'package:iperc/vistas/descripcionPeligro/variables/varDescripcionPeligroListas.dart';
import 'package:iperc/widgets/btnDesplegablePeligro.dart';
import 'package:iperc/widgets/fondo.dart';
import 'package:iperc/widgets/menuDesplegable.dart';
import 'package:iperc/widgets/top.dart';

class IndexDescripcionPeligro extends StatefulWidget {
  
  IndexDescripcionPeligro({Key key}) : super(key: key);
  
  @override
  IndexDescripcionPeligroState createState() => IndexDescripcionPeligroState();
}

class IndexDescripcionPeligroState extends State<IndexDescripcionPeligro> {

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: top(context),
      drawer: menuDesplegable(),
      body: SafeArea(
        child: Stack(
          children: <Widget>[
            fondo(context),
            Positioned(
              child: Container(
                padding: EdgeInsets.only(
                  top: 20.0,
                  left: 20.0,
                  right: 20.0
                ),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: <Widget>[
                    Row(
                      mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      children: <Widget>[
                        Text(
                          'IPERC',
                          textAlign: TextAlign.start,
                          style: Estilos.h2
                        ),
                        varDescripcionPeligroLista.length > 0
                        ?varDescripcionPeligroLista[0]['last_update'] != null
                          ?Text(
                            'Actualizado: ${varDescripcionPeligroLista[0]['last_update']}',
                            style: Estilos.parrafoRojo,
                          )
                          :SizedBox()
                        :SizedBox()
                      ],
                    ),
                  ],
                )
              )
            ),

            Positioned(
              child: Container(
                margin: EdgeInsets.only(
                  top: 90.0,
                  left: 20.0,
                  right: 20.0
                ),
                child: ListView(
                  children: <Widget>[
                    Text(
                      'Descripción del Peligro',
                      style: Estilos.parrafoNegrita,
                    ),
                    SizedBox(
                      height: 10.0,
                    ),

                    for(int cont = 0; cont < varDescripcionPeligroLista.length; cont++)
                    BtnDesplegablePeligro(
                      texto     : '${varDescripcionPeligroLista[cont]['danger_description']}',
                      listaData : varDescripcionPeligroLista[cont],
                    ),


                    // BtnDesplegablePeligro(
                    //   texto: '1.7 Condiciones climáticas',
                    // ),
                  ],
                )
              )
            )
          ],
        )
      ),
      // floatingActionButton: FloatingActionButton(
      //   onPressed: (){
      //     print(varTareasIdTareasSeleccionado);
      //     print(varTiposPeligrosIdTipoPeligroSeleccionado);
      //   },
      // ),
    );
  }
}