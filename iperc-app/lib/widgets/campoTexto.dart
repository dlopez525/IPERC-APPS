import 'package:flutter/material.dart';

Widget campoTexto(context, bool seleccionado, accionSeleccionar, accionChange)
{
  return GestureDetector(
    onTap: accionSeleccionar,
    child: Container(
      margin: EdgeInsets.only(
        top: 10.0
      ),
      width: MediaQuery.of(context).size.width,
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(20.0),
        border: 
        seleccionado == true
        ?Border.all(
          color: Colors.red,
          width: 1.0
        )
        :Border.all(
          color: Colors.grey,
          width: 1.0
        )
      ),
      child: TextField(
        onTap: accionSeleccionar,  
        onChanged: accionChange,
        decoration: new InputDecoration(
        border: InputBorder.none,
        focusedBorder: InputBorder.none,
        enabledBorder: InputBorder.none,
        errorBorder: InputBorder.none,
        disabledBorder: InputBorder.none,
        contentPadding:
            EdgeInsets.only(left: 15, bottom: 11, top: 11, right: 15),
      ),
      ),
    )
  );
}

Widget campoTextoNumerico(context, bool seleccionado, accionSeleccionar, accionChange)
{
  return GestureDetector(
    onTap: accionSeleccionar,
    child: Container(
      margin: EdgeInsets.only(
        top: 10.0
      ),
      width: MediaQuery.of(context).size.width,
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(20.0),
        border: 
        seleccionado == true
        ?Border.all(
          color: Colors.red,
          width: 1.0
        )
        :Border.all(
          color: Colors.grey,
          width: 1.0
        )
      ),
      child: TextField(
        keyboardType: TextInputType.number,
        onTap: accionSeleccionar,  
        onChanged: accionChange,
        decoration: new InputDecoration(
        border: InputBorder.none,
        focusedBorder: InputBorder.none,
        enabledBorder: InputBorder.none,
        errorBorder: InputBorder.none,
        disabledBorder: InputBorder.none,
        contentPadding:
            EdgeInsets.only(left: 15, bottom: 11, top: 11, right: 15),
      ),
      ),
    )
  );
}