import 'package:flutter/material.dart';
import 'package:iperc/globales/variables/estilos.dart';
import 'package:iperc/vistas/login/index.dart';
import 'package:iperc/widgets/cambiarPagina.dart';

class Preload extends StatefulWidget {
  
  Preload({Key key}) : super(key: key);
  
  @override
  PreloadState createState() => PreloadState();
}

class PreloadState extends State<Preload> {

  @override
  void initState()
  {
    super.initState();
    Future.delayed(
      Duration(
        seconds: 3
      ),
      (){
        cambiarPagina(context, IndexLogin());
      }
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Estilos.rojoCocaCola,
      body: SafeArea(
        child: Stack(
          children: <Widget>[
            Align(
              alignment: Alignment.center,
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.center,
                mainAxisAlignment: MainAxisAlignment.center,
                children: <Widget>[
                  Text(
                    'IPERC',
                    style: Estilos.h1Blanco,
                  ),
                  Text(
                    'Versión 1.0',
                    style: Estilos.parrafoBlanco,
                  )
                ],
              ),
            ),
            Align(
              alignment: Alignment.bottomCenter,
              child: Container(
                width: 150.0,
                height: 100.0,
                decoration: BoxDecoration(
                  image: DecorationImage(
                    image: AssetImage(
                      'assets/img/logoblanco.png'
                    ),
                    fit: BoxFit.fill
                  )
                ),
              ),
            )
          ],
        )
      ),
    );
  }
}