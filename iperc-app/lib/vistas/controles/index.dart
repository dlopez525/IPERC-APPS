import 'package:flutter/material.dart';
import 'package:iperc/globales/variables/estilos.dart';
import 'package:iperc/vistas/inicio/index.dart';
import 'package:iperc/vistas/login/index.dart';
import 'package:iperc/widgets/btn.dart';
import 'package:iperc/widgets/cambiarPagina.dart';
import 'package:iperc/widgets/fondo.dart';
import 'package:iperc/widgets/lineaBottom.dart';
import 'package:iperc/widgets/menuDesplegable.dart';
import 'package:iperc/widgets/titulo.dart';
import 'package:iperc/widgets/top.dart';

class IndexControles extends StatefulWidget {
  final String controlesIngenieria;
  final String controlesAdministrativos;
  final String epp;
  IndexControles({Key key, this.controlesIngenieria, this.controlesAdministrativos, this.epp}) : super(key: key);
  
  @override
  IndexControlesState createState() => IndexControlesState();
}

class IndexControlesState extends State<IndexControles> {

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: top(context),
      drawer: menuDesplegable(),
      backgroundColor: Colors.white,
      body: SafeArea(
        child: Stack(
          children: <Widget>[
            fondo(context),
            Positioned(
              child: Container(
                child: ListView(
                  children: <Widget>[
                    titulo('CONTROLES', false, false, (){}, false),
                    Container(
                      margin: EdgeInsets.only(
                        top: 20.0,
                        left: 20.0,
                        right: 20.0
                      ),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: <Widget>[
                          Text(
                            'Controles Ingenieria',
                            style: Estilos.parrafoNegrita,
                          ),
                          cajonTexto(
                            '${widget.controlesIngenieria}'
                            ''
                          ),
                          Text(
                            'Controles Administrativos',
                            style: Estilos.parrafoNegrita,
                          ),
                          cajonTexto(
                            '${widget.controlesAdministrativos}'
                            ''
                          ),
                          Text(
                            'EPP',
                            style: Estilos.parrafoNegrita,
                          ),
                          cajonTexto(
                            '${widget.epp}'
                            // ''
                          ),
                          btn(
                            (){
                              cambiarPagina(context, IndexLogin());
                            },
                            'NUEVA CONSULTA'
                          ),
                        ],
                      ),
                    ),
                    lineaBottom(context, false, false, false),
                  ],
                ),
              )
            )
          ],
        ),
      ),
    );
  }

  Widget cajonTexto(
    String texto
  )
  {
    if(texto == "null")
    {
      texto = '';
    }else{
      texto = texto.replaceAll("*", "-");
    }
    return Container(
      width: MediaQuery.of(context).size.width,
      margin: EdgeInsets.only(
        left: 10.0,
        top: 10.0,
        bottom: 10.0
      ),
      padding: EdgeInsets.all(15.0),
      height: 
      texto.length > 60
      ?null
      :150.0,
      decoration: BoxDecoration(
        color: Estilos.plomo,
        borderRadius: BorderRadius.circular(10)
      ),
      child: Column(
        mainAxisAlignment: MainAxisAlignment.start,
        crossAxisAlignment: CrossAxisAlignment.start,
        children: <Widget>[
          Text(
            '$texto',
            textAlign: TextAlign.start,
            style: Estilos.parrafoTipoPeligro,
          )
        ],
      ),
    );
  }
}