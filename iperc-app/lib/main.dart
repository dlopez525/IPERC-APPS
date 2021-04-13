import 'package:flutter/material.dart';
import 'package:iperc/vistas/login/index.dart';
import 'package:iperc/vistas/preload.dart';

void main() => runApp(MyApp());
const PrimaryColor = const Color(0xFFFFFFFF);

class MyApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Iperc',
      theme: ThemeData(
        primaryColor: PrimaryColor
      ),
      // home: IndexLogin(),
      home: Preload(),
      debugShowCheckedModeBanner: false,
    );
  }
}