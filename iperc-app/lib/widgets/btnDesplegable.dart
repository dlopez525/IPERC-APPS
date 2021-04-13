import 'package:flutter/material.dart';
import 'package:iperc/extras/searchable_dropdown/searchable_dropdown.dart';
import 'package:iperc/globales/variables/estilos.dart';

Widget btnDesplegable(
  String txtHint,
  String textoSeleccionado,
  List<String> lista,
  accion
)
{
  return Container(
    decoration: BoxDecoration(
      borderRadius: BorderRadius.circular(20.0),
      border: Border.all(
        color: Colors.red,
        width: 1.0
      )
    ),
    // padding: EdgeInsets.only(
    //   left: 10.0,
    //   right: 10.0
    // ),
    child: SearchableDropdown.single(
      items: lista.map((String value) {
        return new DropdownMenuItem<String>(
          value: value,
          child: 
          value.length >= 50
          ?value.length >= 70
            ?value.length >= 100
              ?Text(
                value,
                style: TextStyle(
                  fontSize: 9.0
                ),
              )
              :Text(
                value,
                style: TextStyle(
                  fontSize: 10.0
                ),
              )
            :Text(
              value,
              style: TextStyle(
                fontSize: 12.0
              ),
            )
          :Text(
            value
          )
        );
      }).toList(),
      // value: textoSeleccionado,
      hint: txtHint,
      searchHint: txtHint,
      underline: Container(
        height: 0.0,
        color: Colors.transparent,
      ),
      onChanged: accion,
      displayClearIcon: false,
      doneButton: null,
      closeButton: "Salir",
      
      displayItem: (item, selected) {
        return (Row(children: [
          selected
              ? Icon(
                  Icons.radio_button_checked,
                  color: Colors.grey,
                )
              : Icon(
                  Icons.radio_button_unchecked,
                  color: Colors.grey,
                ),
          SizedBox(width: 7),
          Expanded(
            child: item,
          ),
        ]));
      },
      isExpanded: true,
    ),
  );
}

Widget btnDesplegablePlomo(
  String textoSeleccionado,
  List<String> lista,
  accion
)
{
  return Container(
    decoration: BoxDecoration(
      color: Estilos.plomo,
      borderRadius: BorderRadius.circular(10.0),
    ),
    // padding: EdgeInsets.only(
    //   left: 10.0,
    //   right: 10.0
    // ),
    child: SearchableDropdown.single(
      
      items: lista.map((String value) {
        return new DropdownMenuItem<String>(
          value: value,
          child: Text(value),
        );
      }).toList(),
      // value: textoSeleccionado,
      hint: "Selecciona uno",
      searchHint: "Seleccionar uno",
      underline: Container(
        height: 0.0,
        color: Colors.black
      ),
      onChanged: accion,
      displayClearIcon: false,
      doneButton: "Seleccionar",
      closeButton: "Salir",
      menuBackgroundColor: Colors.red,
      displayItem: (item, selected) {
        return (
          Container(
            color: Colors.red,
            child: Row(children: [
              selected
                  ? Icon(
                      Icons.radio_button_checked,
                      color: Colors.grey,
                    )
                  : Icon(
                      Icons.radio_button_unchecked,
                      color: Colors.grey,
                    ),
              SizedBox(width: 7),
              Expanded(
                child: item,
              ),
            ]),
          )
        );
      },
      isExpanded: true,
    ),
  );
}