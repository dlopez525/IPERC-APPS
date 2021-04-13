import 'dart:math';

import 'package:flutter/material.dart';
import 'package:iperc/globales/variables/estilos.dart';

class PincelAnimacion extends CustomPainter {
  final Animation<double> _animation;
  final String colorAnimacion;
  final String colorAnimacionRgba;

  PincelAnimacion(this._animation, this.colorAnimacion, this.colorAnimacionRgba) : super(repaint: _animation);

  void circle(Canvas canvas, Rect rect, double value) {
    List listaColores = colorAnimacionRgba.split(",");
    double opacity = (1.0 - (value / 4.0)).clamp(0.0, 1.0);
    Color color = new Color.fromRGBO(int.parse('${listaColores[0]}'), int.parse('${listaColores[1]}'), int.parse('${listaColores[2]}'), opacity);
    // Color color = Color(int.parse(colorAnimacion));

    double size = rect.width / 1.6;
    double area = size * size;
    double radius = sqrt(area * value / 12);

    final Paint paint = new Paint()..color = color;
    canvas.drawCircle(rect.center, radius, paint);
  }

  @override
  void paint(Canvas canvas, Size size) {
    Rect rect = new Rect.fromLTRB(0.0, 0.0, size.width, size.height);

    for (int wave = 5; wave >= 0; wave--) {
      circle(canvas, rect, wave + _animation.value);
    }
  }

  @override
  bool shouldRepaint(PincelAnimacion oldDelegate) {
    return true;
  }
}

class RiesgoAnimado extends StatefulWidget {
  final String tituloRiesgo;
  final String colorAnimacion;
  final String colorAnimacionRgba;

  RiesgoAnimado({Key key, this.tituloRiesgo, this.colorAnimacion, this.colorAnimacionRgba}) : super(key: key);
  @override
  RiesgoAnimadoState createState() => new RiesgoAnimadoState();
}

class RiesgoAnimadoState extends State<RiesgoAnimado>
    with SingleTickerProviderStateMixin {
  AnimationController _controller;
  List listaTitulo;
  String colorAnimacion = '0XFF';
  @override
  void initState() {
    super.initState();
    colorAnimacion = colorAnimacion+widget.colorAnimacion;
    _controller = new AnimationController(
      vsync: this,
    );
    _startAnimation();

    listaTitulo = widget.tituloRiesgo.split(' ');
  }

  @override
  void dispose() {
    _controller.dispose();
    super.dispose();
  }

  void _startAnimation() {
    _controller.stop();
    _controller.reset();
    _controller.repeat(
      period: Duration(seconds: 1),
    );
  }

  @override
  Widget build(BuildContext context) {
    return CustomPaint(
      painter: new PincelAnimacion(
        _controller,
        colorAnimacion,
        widget.colorAnimacionRgba
      ),
      child: new Container(
        width: 1.0,
        // height: 200.0,
        child: Center(
          child: Text(
            '${listaTitulo[0]}\n${listaTitulo[1]}',
            style: Estilos.h2Blanco,
            textAlign: TextAlign.center,
          ),
        ),
      ),
    );
  }
}