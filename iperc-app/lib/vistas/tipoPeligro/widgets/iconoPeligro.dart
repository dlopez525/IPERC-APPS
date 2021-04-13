import 'package:flutter/material.dart';
import 'package:iperc/globales/variables/estilos.dart';

Widget iconoPeligro(
  context,
  String icono,
  String texto,
  bool seleccionado,
  accion
)
{
  return GestureDetector(
    onTap: accion,
    child: Card(
      color: Colors.transparent,
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(20.0),
      ),
      elevation:
      seleccionado == true
      ?5.0
      :0.0,
      child: Container(
        // margin: EdgeInsets.only(
        //   right: 10.0,
        //   top: 10.0
        // ),
        width: MediaQuery.of(context).size.width/2.6,
        // height: 180.0,
        padding: EdgeInsets.all(5.0),
        
        decoration: 
        seleccionado == true
        ?BoxDecoration(
          color: Color(0xffF8F8F8),
          border: Border.all(
            width: 3.0,
            color: Color(0xffF8F8F8),
          ),
          borderRadius: BorderRadius.circular(20.0)
        )
        :null,
        child: Center(
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: <Widget>[
              Image.network(
                '$icono'
              ),
              Text(
                '$texto',
                style: Estilos.parrafoTipoPeligro,
                textAlign: TextAlign.center,
              )
            ],
          ),
        ),
      )
    )
  );
}