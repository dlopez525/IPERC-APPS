import 'package:flutter/material.dart';

Widget top(
  context
)
{
  return AppBar(
    leading: SizedBox(),
    backgroundColor: Colors.transparent,
    elevation: 0.0,
    actions: <Widget>[
      IconButton(
        onPressed: (){
          Navigator.of(context).pop();
        },
        icon: Icon(
          Icons.arrow_back,
          color: Colors.black,
        )
      )
    ],
  );
}