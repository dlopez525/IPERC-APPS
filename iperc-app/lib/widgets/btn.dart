import 'package:flutter/material.dart';
import 'package:iperc/globales/variables/estilos.dart';

Widget btn(
  accion,
  String texto
)
{
  return Container(
    decoration: BoxDecoration(
      boxShadow: [
        BoxShadow(
          color: Colors.grey.withOpacity(0.5),
          spreadRadius: 1,
          blurRadius: 10,
          offset: Offset(3, 6), // changes position of shadow
        ),
      ],
    ),
    child: RaisedButton(
      onPressed: accion,
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(10.0),
        side: BorderSide(
          color: Estilos.rojoCocaCola
        ),
      ),
      color: Estilos.rojoCocaCola,
      child: Center(
        child: Text(
          '$texto',
          style: Estilos.parrafoBlanco
        ),
      ),
    ),
  );
}