
import 'package:flutter/material.dart';

class Estilos {
  Estilos._();

  static const Color negro = Color(0xFF262624);
  static const Color rojoCocaCola = Color(0xFFCA293E);
  static const Color plomo = Color(0xFFF5F5F5);
  static const Color naranja = Color(0xFFF1C40F);
  static const Color naranjaClaro = Color(0XFFF4E29C);
  
  static const Color plomoOscuro = Color(0xFFDBDBDB);
  static const Color darkText = Color(0xFF253840);
  static const Color darkerText = Color(0xFF17262A);
  static const Color lightText = Color(0xFF4A6572);

  static const String tipoLetraPrincipal = 'nunito';

  static const TextStyle parrafoRojo = TextStyle( 
    fontFamily: tipoLetraPrincipal,
    fontWeight: FontWeight.w200,
    fontSize: 15,
    color: Estilos.rojoCocaCola
  );

  static const TextStyle h2 = TextStyle( 
    fontFamily: tipoLetraPrincipal,
    fontWeight: FontWeight.w800,
    fontSize: 23,
  );
  
  static const TextStyle h1Blanco = TextStyle( 
    fontFamily: tipoLetraPrincipal,
    fontWeight: FontWeight.w800,
    fontSize: 35,
    color: Colors.white
  );

  static const TextStyle h2Blanco = TextStyle( 
    fontFamily: tipoLetraPrincipal,
    fontWeight: FontWeight.w800,
    fontSize: 25,
    color: Colors.white
  );

  static const TextStyle parrafo = TextStyle( 
    fontFamily: tipoLetraPrincipal,
    fontSize: 15,
  );

  static const TextStyle parrafoTipoPeligro = TextStyle( 
    fontFamily: tipoLetraPrincipal,
    fontSize: 13,
  );

  static const TextStyle parrafoBlanco = TextStyle( 
    fontFamily: tipoLetraPrincipal,
    fontSize: 15,
    color: Colors.white
  );

  static const TextStyle parrafoNegrita = TextStyle( 
    fontFamily: tipoLetraPrincipal,
    fontWeight: FontWeight.w700,
    fontSize: 15,
  );

  static const TextTheme textTheme = TextTheme(
    display1: display1,
    headline: headline,
    title: title,
    subtitle: subtitle,
    body2: body2,
    body1: body1,
    caption: caption,
  );

  static const TextStyle display1 = TextStyle( // h4 -> display1
    fontFamily: tipoLetraPrincipal,
    fontWeight: FontWeight.bold,
    fontSize: 36,
    letterSpacing: 0.4,
    height: 0.9,
    color: darkerText,
  );

  static const TextStyle headline = TextStyle( // h5 -> headline
    fontFamily: tipoLetraPrincipal,
    fontWeight: FontWeight.bold,
    fontSize: 24,
    letterSpacing: 0.27,
    color: darkerText,
  );

  static const TextStyle title = TextStyle( // h6 -> title
    fontFamily: tipoLetraPrincipal,
    fontWeight: FontWeight.bold,
    fontSize: 16,
    letterSpacing: 0.18,
    color: darkerText,
  );

  static const TextStyle subtitle = TextStyle( // subtitle2 -> subtitle
    fontFamily: tipoLetraPrincipal,
    fontWeight: FontWeight.w400,
    fontSize: 14,
    letterSpacing: -0.04,
    color: darkText,
  );

  static const TextStyle body2 = TextStyle( // body1 -> body2
    fontFamily: tipoLetraPrincipal,
    fontWeight: FontWeight.w400,
    fontSize: 14,
    letterSpacing: 0.2,
    color: darkText,
  );

  static const TextStyle body1 = TextStyle( // body2 -> body1
    fontFamily: tipoLetraPrincipal,
    fontWeight: FontWeight.w400,
    fontSize: 16,
    letterSpacing: -0.05,
    color: darkText,
  );

  static const TextStyle caption = TextStyle( // Caption -> caption
    fontFamily: tipoLetraPrincipal,
    fontWeight: FontWeight.w400,
    fontSize: 12,
    letterSpacing: 0.2,
    color: lightText, // was lightText
  );
}