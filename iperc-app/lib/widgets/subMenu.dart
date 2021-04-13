
import 'package:flutter/material.dart';
import 'package:iperc/globales/funciones/funAbrirOCerrarSubMenu.dart';
import 'package:iperc/globales/variables/varGlobalesTamanoSubMenu.dart';

Widget subMenu(
  context,
  accionCerrarMenu
)
{
  return AnimatedContainer(
    duration: Duration(
      milliseconds: 500
    ),
    width: MediaQuery.of(context).size.width,
    height: varGlobalTamanoSubMenu,
    padding: EdgeInsets.only(
      top: 10.0,
      left: 20.0,
      right: 20.0
    ),
    child: Align(
      alignment: Alignment.topRight,
      child: Card(
        elevation: 5.0,
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(20.0),
        ),
        child: Container(
          width: MediaQuery.of(context).size.width,
          padding: EdgeInsets.all(10.0),
          decoration: BoxDecoration(
            color: Colors.white,
            borderRadius: BorderRadius.circular(20.0),
          ),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: <Widget>[
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: <Widget>[
                  Text(
                    'Recuento'
                  ),
                  IconButton(
                    onPressed: accionCerrarMenu,
                    icon: Icon(
                      Icons.remove_circle_outline
                    )
                  )
                ],
              ),
              Text(
                'De Selecciones'
              ),
              SizedBox(
                height: 30.0,
              ),
              Padding(
                padding: EdgeInsets.only(
                  bottom: 10.0
                ),
                child: Text(
                  'Actividad'
                ),
              ),
              Padding(
                padding: EdgeInsets.only(
                  bottom: 10.0
                ),
                child: Text(
                  'Tarea'
                ),
              ),
              Padding(
                padding: EdgeInsets.only(
                  bottom: 10.0
                ),
                child: Text(
                  'Tipo de Peligro'
                ),
              ),
              Padding(
                padding: EdgeInsets.only(
                  bottom: 10.0
                ),
                child: Text(
                  'Fecha de Actualización'
                ),
              ),
            ],
          ),
        ),
      )
    )
  );
}