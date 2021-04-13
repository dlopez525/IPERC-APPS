import 'package:flutter/material.dart';
import 'package:flutter_flexible_toast/flutter_flexible_toast.dart';
import 'package:iperc/globales/variables/estilos.dart';

void toastError(
  String texto
) {
  FlutterFlexibleToast.showToast(
    timeInSeconds: 4,
    message: "$texto",
    toastLength: Toast.LENGTH_SHORT,
    backgroundColor: Estilos.rojoCocaCola,
    icon: ICON.ERROR,
    fontSize: 16,
    textColor: Colors.white
  );
}

void toastAceptado(
  String texto
) {
  FlutterFlexibleToast.showToast(
    timeInSeconds: 4,
    message: "$texto",
    toastLength: Toast.LENGTH_SHORT,
    backgroundColor: Colors.green,
    icon: ICON.SUCCESS,
    fontSize: 16,
    textColor: Colors.white
  );
}