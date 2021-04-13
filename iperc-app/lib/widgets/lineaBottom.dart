import 'package:flutter/material.dart';

Widget lineaBottom(
  context,
  bool conFix,
  bool conLogo,
  bool raya
)
{
  return 
  conFix == true
  ?Positioned(
    bottom: 0.0,
    child: Column(
      crossAxisAlignment: CrossAxisAlignment.end,
      children: <Widget>[
        conLogo== true
        ?Container(
          width: MediaQuery.of(context).size.width,
          height: 115.0,
          decoration: BoxDecoration(
            color: Colors.transparent,
            image: DecorationImage(
              image: AssetImage(
                'assets/img/logo.jpg',
              )
            )
          ),
        )
        :SizedBox(),
        Container(
          margin: EdgeInsets.only(
            bottom: 25
          ),
          width: MediaQuery.of(context).size.width,
          height: 60.0,
          decoration: BoxDecoration(
            color: Colors.white,
            image: DecorationImage(
              image: AssetImage(
                'assets/img/fotterLinea.jpg',
              ),
              fit: BoxFit.fill
            )
          ),
        ),
      ],
    )
  )
  :Container(
    margin: EdgeInsets.only(
      top: 30.0,
      bottom: 25.0
    ),
    width: MediaQuery.of(context).size.width,
    color: Colors.transparent,
    child: Column(
      crossAxisAlignment: CrossAxisAlignment.end,
      children: <Widget>[
        conLogo == true
        ?Container(
          height: 115.0,
          decoration: BoxDecoration(
            color: Colors.transparent,
            image: DecorationImage(
              image: AssetImage(
                // 'assets/img/logo.jpg',
                'assets/img/logo.png',
              )
            )
          ),
        )
        :SizedBox(),
        raya == true
        ?Container(
          width: MediaQuery.of(context).size.width,
          height: 60.0,
          decoration: BoxDecoration(
            color: Colors.white,
            image: DecorationImage(
              image: AssetImage(
                'assets/img/fotterLinea.jpg',
              ),
              fit: BoxFit.fill
            )
          ),
        )
        :SizedBox()
      ],
    )
  );
}