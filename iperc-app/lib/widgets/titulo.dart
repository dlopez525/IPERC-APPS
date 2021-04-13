import 'package:flutter/material.dart';
import 'package:iperc/globales/variables/estilos.dart';
import 'package:iperc/globales/variables/varUsuario.dart';

Widget titulo(
  String titulo,
  bool booleanFiltro,
  bool mostrarNombre,
  accionFiltro,
  bool conFix
)
{
  return 
  conFix == true
  ?Positioned(
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
                '$titulo',
                textAlign: TextAlign.start,
                style: Estilos.h2
              ),
              booleanFiltro == true
              ?IconButton(
                onPressed: accionFiltro,
                icon: Icon(
                  Icons.list,
                  size: 30.0,
                )
              )
              :SizedBox()
            ],
          ),
          mostrarNombre == true
          ?Text(
            'Roberto Rojas',
            style: Estilos.parrafo,
            textAlign: TextAlign.start,
          )
          :SizedBox()
        ],
      )
    )
  )
  :Container(
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
              '$titulo',
              textAlign: TextAlign.start,
              style: Estilos.h2
            ),
            booleanFiltro == true
            ?IconButton(
              onPressed: accionFiltro,
              icon: Icon(
                Icons.list,
                size: 30.0,
              )
            )
            :SizedBox()
          ],
        ),
        mostrarNombre == true
        ?Text(
          // '$varUsuarioNombreUsuario',
          'Colaborador',
          style: Estilos.parrafo,
          textAlign: TextAlign.start,
        )
        :SizedBox()
      ],
    )
  );
}