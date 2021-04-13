import 'package:flutter/material.dart';

Widget menuDesplegable()
{
  return Drawer(
    child: ListView(
      padding: EdgeInsets.zero,
      children: <Widget>[
        ListTile(
          title: Text('Item 1'),
          onTap: () {
            
          },
        ),
        ListTile(
          title: Text('Item 2'),
          onTap: () {
            
          },
        ),
      ],
    ),
  );
}