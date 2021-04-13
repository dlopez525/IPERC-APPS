import 'package:flutter/material.dart';

class Blanco extends StatefulWidget {
  
  Blanco({Key key}) : super(key: key);
  
  @override
  BlancoState createState() => BlancoState();
}

class BlancoState extends State<Blanco> {

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: SafeArea(
        child: Text(''),
      ),
    );
  }
}