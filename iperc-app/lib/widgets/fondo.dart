import 'package:flutter/material.dart';

Widget fondo(context)
{
  return Opacity(
    opacity: 0.1,
    child: Container(
      width: MediaQuery.of(context).size.width,
      height: MediaQuery.of(context).size.height,
      decoration: BoxDecoration(
        image: DecorationImage(
          image: AssetImage(
            'assets/img/fondo.png'
          ),
          fit: BoxFit.cover
        ),
      ),
    )
  );
}