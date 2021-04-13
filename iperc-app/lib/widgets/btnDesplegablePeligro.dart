import 'package:flutter/material.dart';
import 'package:iperc/extras/pulseanimacion/index.dart';
import 'package:iperc/globales/variables/estilos.dart';
import 'package:iperc/vistas/controles/index.dart';
import 'package:iperc/widgets/btn.dart';
import 'package:iperc/widgets/cambiarPagina.dart';

class BtnDesplegablePeligro extends StatefulWidget {
  final String texto;
  final listaData;
  BtnDesplegablePeligro({Key key, this.texto, this.listaData}) : super(key: key);
  
  @override
  BtnDesplegablePeligroState createState() => BtnDesplegablePeligroState();
}

class BtnDesplegablePeligroState extends State<BtnDesplegablePeligro> {

  bool abierto = false;

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: EdgeInsets.only(
        bottom: 10.0
      ),
      child: Column(
        children: <Widget>[
          ButtonTheme(
            buttonColor: 
            abierto == true
            ?Estilos.plomoOscuro
            :Estilos.plomo,
            height: 55.0,
            child: RaisedButton(
              onPressed: (){
                setState(() {
                  abierto = !abierto;
                });
              },
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.only(
                  topLeft: Radius.circular(10),
                  topRight: Radius.circular(10),
                  bottomLeft: 
                  abierto == true
                  ?Radius.circular(0)
                  :Radius.circular(10),
                  bottomRight: 
                  abierto == true
                  ?Radius.circular(0)
                  :Radius.circular(10),
                ),
              ),
              child: Container(
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: <Widget>[
                    Expanded(
                      child: Text(
                        '${widget.texto}',
                        style: Estilos.parrafoNegrita,
                      ),
                    ),
                    abierto == true
                    ?Icon(
                      Icons.keyboard_arrow_up
                    )
                    :Icon(
                      Icons.keyboard_arrow_down
                    )
                  ],
                ),
              ),
            )
          ),

          AnimatedContainer(
            duration: Duration(
              milliseconds: 500
            ),
            // height: 
            // abierto == true
            // ?MediaQuery.of(context).size.height
            // :0,
            child: 
            abierto == true
            ?Column(
              children: <Widget>[

                // Text('${widget.listaData['dangers_descriptions']}'),
                // cajonDesplegable(
                //   'DESCRIPCIÓN DEL EVENTO PELIGROSO',
                //   '${widget.listaData['event']}'
                // ),
                for(int contDangersDescriptions = 0; contDangersDescriptions < widget.listaData['dangers_descriptions'].length; contDangersDescriptions++)
                cajonDesplegableContenido(
                  contDangersDescriptions,
                  widget.listaData['dangers_descriptions'].length
                )
                


              ],
            )
            :SizedBox()
          )
          


        ],
      )
    );
  }

  Widget cajonDesplegable(
    String titulo,
    String descripcion
  )
  {
    return Container(
      width: MediaQuery.of(context).size.width,
      margin: EdgeInsets.only(
        top: 5.0,
        left: 10.0,
        right: 10.0
      ),
      padding: EdgeInsets.all(10.0),
      decoration: BoxDecoration(
        color: Estilos.plomo,
        borderRadius: BorderRadius.circular(10.0)
      ),
      child: Column(
        children: <Widget>[
          Text(
            '$titulo',
            style: Estilos.parrafoNegrita,
          ),
          Padding(
            padding: EdgeInsets.only(
              top: 10.0
            ),
            child: Text(
              '$descripcion',
              textAlign: TextAlign.center,
              style: Estilos.parrafo,
            )
          )
        ],
      ),
    );
  }

  Widget cajonDesplegableRiesgo(
    int contDangersDescriptions,
    String tituloRiesgo,
    String color,
    String colorRgba
  )
  {
    return Container(
      width: MediaQuery.of(context).size.width,
      margin: EdgeInsets.only(
        top: 5.0,
        left: 10.0,
        right: 10.0
      ),
      padding: EdgeInsets.all(10.0),
      decoration: BoxDecoration(
        color: Estilos.plomo,
        borderRadius: BorderRadius.circular(10.0)
      ),
      child: Column(
        children: <Widget>[
          Container(
            width: MediaQuery.of(context).size.width,
            height: 200.0,
            child: RiesgoAnimado(
              tituloRiesgo: tituloRiesgo,
              colorAnimacion: color,
              colorAnimacionRgba: colorRgba,
            ),
          ),
        
          // Container(
          //   width: MediaQuery.of(context).size.width,
          //   height: 200.0,
          //   padding: EdgeInsets.all(5.0),
          //   decoration: BoxDecoration(
          //     shape: BoxShape.circle,
          //     color: Colors.white,
          //     border: Border.all(
          //       color: Estilos.naranja,
          //       width: 1.0
          //     )
          //   ),
          //   child: Container(
          //     width: MediaQuery.of(context).size.width,
          //     height: 180.0,
          //     padding: EdgeInsets.all(10.0),
          //     decoration: BoxDecoration(
          //       color: Estilos.naranjaClaro,
          //       shape: BoxShape.circle,
          //     ),
          //     child: Container(
          //       width: MediaQuery.of(context).size.width,
          //       height: 150.0,
          //       decoration: BoxDecoration(
          //         color: Estilos.naranja,
          //         shape: BoxShape.circle
          //       ),
          //       child: Center(
          //         child: Text(
          //           'Riesgo\nNotable',
          //           style: Estilos.h2Blanco,
          //           textAlign: TextAlign.center,
          //         ),
          //       ),
          //     ),
          //   ),
          // ),
          
          Padding(
            padding: EdgeInsets.only(
              top: 10.0
            ),
            child: btn(
              (){
                cambiarPagina(
                  context, 
                  IndexControles(
                    controlesIngenieria : widget.listaData['dangers_descriptions'][contDangersDescriptions]['engineering_controls'],
                    controlesAdministrativos: widget.listaData['dangers_descriptions'][contDangersDescriptions]['administrative_controls'],
                    epp: widget.listaData['dangers_descriptions'][contDangersDescriptions]['epps'],
                  )
                );
              },
              'VER CONTROLES'
            )
          )
        ],
      ),
    );
  }

  Widget cajonDesplegableContenido(
    int contDangersDescriptions,
    int logintudDangersDescriptions
  )
  {

    return Container(
      child: Column(
        children: <Widget>[
          logintudDangersDescriptions > 1
          ?Container(
            width: MediaQuery.of(context).size.width,
            margin: EdgeInsets.only(
              top: 5.0,
              left: 10.0,
              right: 10.0
            ),
            padding: EdgeInsets.all(10.0),
            decoration: BoxDecoration(
              color: Estilos.plomo,
              borderRadius: BorderRadius.circular(10.0)
            ),
            child: ButtonTheme(
              buttonColor: 
              logintudDangersDescriptions > 1
              ?widget.listaData['dangers_descriptions'][contDangersDescriptions]['abierto'] == true
                ?Estilos.plomoOscuro
                :Estilos.plomo
              :Estilos.plomo,
              height: 55.0,
              child: RaisedButton(
                hoverColor: Colors.transparent,
                onPressed: (){
                  setState(() {
                    if(widget.listaData['dangers_descriptions'][contDangersDescriptions]['abierto'] == true){
                      widget.listaData['dangers_descriptions'][contDangersDescriptions]['abierto'] = false;
                    }else{
                      widget.listaData['dangers_descriptions'][contDangersDescriptions]['abierto'] = true;
                    }
                  });
                },
                shape: RoundedRectangleBorder(
                  borderRadius: BorderRadius.only(
                    topLeft: Radius.circular(10),
                    topRight: Radius.circular(10),
                    bottomLeft: 
                    logintudDangersDescriptions > 1
                      ?widget.listaData['dangers_descriptions'][contDangersDescriptions]['abierto'] == true
                        ?Radius.circular(0)
                        :Radius.circular(10)
                      :Radius.circular(0),
                    bottomRight: 
                    logintudDangersDescriptions > 1
                    ?widget.listaData['dangers_descriptions'][contDangersDescriptions]['abierto'] == true
                      ?Radius.circular(0)
                      :Radius.circular(10)
                    :Radius.circular(0)
                  ),
                ),
                child: Container(
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: <Widget>[
                      Expanded(
                        child: Column(
                          children: <Widget>[
                            Text(
                              'DESCRIPCIÓN DEL EVENTO PELIGROSO',
                              style: Estilos.parrafoNegrita,
                            ),
                            Padding(
                              padding: EdgeInsets.only(
                                top: 10.0
                              ),
                              child: Text(
                                '${widget.listaData['dangers_descriptions'][contDangersDescriptions]['event']}',
                                textAlign: TextAlign.center,
                                style: Estilos.parrafo,
                              )
                            )
                          ],
                        )
                      ),
                      logintudDangersDescriptions > 1
                        ?widget.listaData['dangers_descriptions'][contDangersDescriptions]['abierto'] == true
                          ?Icon(
                            Icons.keyboard_arrow_up
                          )
                          :Icon(
                            Icons.keyboard_arrow_down
                          )
                        :SizedBox()
                    ],
                  ),
                ),
              )
            ),
          )
          :cajonDesplegable(
            'DESCRIPCIÓN DEL EVENTO PELIGROSO',
            '${widget.listaData['dangers_descriptions'][contDangersDescriptions]['event']}',
          ),

          logintudDangersDescriptions > 1
          ?widget.listaData['dangers_descriptions'][contDangersDescriptions]['abierto'] == true
            ?Container(
              child: Column(
                children: <Widget>[
                  cajonDesplegable(
                    'MAYOR DAÑO LÓGICO POSIBLE (CONSECUENCIA)',
                    '${widget.listaData['dangers_descriptions'][contDangersDescriptions]['consequence']}'
                  ),
                  cajonDesplegableRiesgo(
                    contDangersDescriptions,
                    '${widget.listaData['dangers_descriptions'][contDangersDescriptions]['risk']}',
                    '${widget.listaData['dangers_descriptions'][contDangersDescriptions]['risk_color']}',
                    '${widget.listaData['dangers_descriptions'][contDangersDescriptions]['risk_color_rgba']}'
                  )
                ],
              ),
            )
            :SizedBox()
          :Container(
            child: Column(
              children: <Widget>[
                cajonDesplegable(
                  'MAYOR DAÑO LÓGICO POSIBLE (CONSECUENCIA)',
                  '${widget.listaData['dangers_descriptions'][contDangersDescriptions]['consequence']}'
                ),
                cajonDesplegableRiesgo(
                  contDangersDescriptions,
                  '${widget.listaData['dangers_descriptions'][contDangersDescriptions]['risk']}',
                  '${widget.listaData['dangers_descriptions'][contDangersDescriptions]['risk_color']}',
                  '${widget.listaData['dangers_descriptions'][contDangersDescriptions]['risk_color_rgba']}'
                )
              ],
            ),
          )

          // cajonDesplegable(
          //   'DESCRIPCIÓN DEL EVENTO PELIGROSO',
          //   '${widget.listaData['dangers_descriptions'][contDangersDescriptions]['event']}'
          // ),
          // cajonDesplegable(
          //   'MAYOR DAÑO LÓGICO POSIBLE (CONSECUENCIA)',
          //   '${widget.listaData['consequence']}'
          // ),
          // cajonDesplegableRiesgo(
          //   '${widget.listaData['risk']}',
          //   '${widget.listaData['risk_color']}',
          //   '${widget.listaData['risk_color_rgba']}'
          // )
        ],
      ),
    );
  }
}