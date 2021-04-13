<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MATRIZ</title>
</head>
<body>
    <table>
        <tr>
            <td height="15"></td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="15" colspan=7 rowspan=4 align="center" ></td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center; line-height: 15;" height="15" colspan=21 align="center" valign=middle ><b><font color="#000000">FORMATO</font></b></td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="15" colspan=3 align="center" ><b><font color="#000000">CÓDIGO</font></b></td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="15" colspan=4 align="center" valign=middle ><font color="#000000">APE-CHU-SI-SR-F-004</font></td>
            {{-- <td valign=center ></td> --}}
        </tr>
        <tr>
            <td height="15"></td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align: center; line-height: 15;" height="15" colspan=21 rowspan=3 align="center" valign=middle ><strong><font size=3 color="#000000">MATRIZ DE IDENTIFICACIÓN DE PELIGROS, EVALUACIÓN DE RIESGOS Y CONTROLES (IPERC)</font></strong></td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="15" colspan=3 align="center" ><b><font color="#000000">EDICIÓN</font></b></td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="15" colspan=4 align="center" valign=middle  sdval="3" sdnum="1033;"><font color="#000000">3</font></td>
            {{-- <td valign=center ></td> --}}
        </tr>
        <tr>
            <td height="15"></td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="15" colspan=3 align="center" ><b><font color="#000000">FECHA</font></b></td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="15" colspan=4 align="center" valign=middle  sdval="44008" sdnum="1033;1033;M/D/YYYY"><font color="#000000">6/26/2020</font></td>
            {{-- <td valign=center ></td> --}}
        </tr>
        <tr>
            <td height="15"></td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="15" colspan=3 align="center" ><b><font color="#000000">PÁGINA</font></b></td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="15" colspan=4 align="center" valign=middle  sdval="1" sdnum="1033;"><font color="#000000">1</font></td>
            {{-- <td height="15" valign=center ></td> --}}
        </tr>
        <tr>
            <td height="15"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td height="22"> RESPONSABLE:</td>
            <td></td>
            <td>{{ $file->responsable }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>FECHA DE CREACION</td>
            <td></td>
            <td>{{ date('d-m-Y', strtotime($file->creation_date)) }}</td>
            <td></td>
            <td></td>
            <td>LIDER DE EQUIPO:</td>
            <td>{{ $file->leader }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td height="22"><b><font face="Arial Narrow" color="#000000">ULTIMA ACTUALIZACIÓN:</font></b></td>
            <td></td>
            <td>{{ date('d-m-Y', strtotime($file->last_update)) }}</td>
            <td></td>
            <td></td>
            <td>EQUIPO:</td>
            <td>{{ $file->team }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td height="30"></td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #FFFF99;"  rowspan=2 align="center" valign=middle>Sede</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #FFFF99;"  colspan=2 align="center" valign=middle>Proceso</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #FFFF99;"  rowspan=2 align="center" valign=middle>Sub Proceso</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #FFFF99;"  rowspan=2 align="center" valign=middle>Puesto de Trabajo</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #FFFF99;"  rowspan=2 align="center" valign=middle>Actividad</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #FFFF99;"  rowspan=2 align="center" valign=middle>Tarea</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #FFFF99;"  rowspan=2 align="center" valign=bottom>Rutinario</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #FFFF99;"  rowspan=2 align="center" valign=bottom>No Rutinario</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #FFFF99;"  rowspan=2 align="center" valign=bottom>Emergencia</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #FFFF99;"  rowspan=2 align="center" valign=middle>Tipo de Peligro</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #FFFF99;"  rowspan=2 align="center" valign=middle>Descripci&oacute;n del Peligro</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #FFFF99;"  rowspan=2 align="center" valign=middle>Descripci&oacute;n del Evento Peligroso</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #FFFF99;"  rowspan=2 align="center" valign=middle>Mayor Da&ntilde;o L&oacute;gico Posible<br>(CONSECUENCIA)</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #FFFF99;"  colspan=3 align="center" valign=middle>CONTROLES EXISTENTES</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #A9D18E;" colspan=5 align="center" valign=middle>EVALUACION DEL RIESGO</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;  background: #A9D18E;" rowspan=2 align="center" valign=middle>ACCIONES A APLICAR</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;  background: #A9D18E;" rowspan=2 align="center" valign=middle>Efectividad de los Controles</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;  background: #A9D18E;" colspan=5 align="center" valign=middle>Cuando las medidas de control no son efectivas o cuando el riesgo es notablemente mayor</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #C9C9C9;" colspan=5 align="center" valign=middle>EVALUACION DEL RIESGO</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #C9C9C9;" rowspan=2 align="center" valign=middle bgcolor="#C9C9C9">&iquest;Significativo?<br>SI/NO</td>
            <td></td>
        </tr>
        <tr>
            <td height="81"></td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #FFFF99;" align="center" valign=middle>Area</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #FFFF99;" align="center" valign=middle>Zona</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #FFFF99;" align="center" valign=middle>Controles de ingenier&iacute;a</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #FFFF99;" align="center" valign=middle>Controles administrativos</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #FFFF99;" align="center" valign=middle>EPP</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;  background: #A9D18E;" align="center" valign=bottom>Consecuencia</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;  background: #A9D18E;" align="center" valign=bottom>Exposici&oacute;n</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;  background: #A9D18E;" align="center" valign=bottom>Probabilidad</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;  background: #A9D18E;" align="center" valign=bottom>Grado de Peligrosidad</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;  background: #A9D18E;" align="center" valign=middle>Clasificaci&oacute;n del Riesgo</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;  background: #A9D18E;" align="center" valign=middle>Eliminaci&oacute;n</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;  background: #A9D18E;" align="center" valign=middle>Sustituci&oacute;n</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;  background: #A9D18E;" align="center" valign=middle>Controles de ingenier&iacute;a</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;  background: #A9D18E;" align="center" valign=middle>Controles administrativos</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;  background: #A9D18E;" align="center" valign=middle>EPP</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #C9C9C9;" align="center" valign=bottom>Consecuencia</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #C9C9C9;" align="center" valign=bottom>Exposici&oacute;n</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #C9C9C9;" align="center" valign=bottom>Probabilidad</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #C9C9C9;" align="center" valign=bottom>Grado de Peligrosidad</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; background: #C9C9C9;" align="center" valign=bottom>Clasificaci&oacute;n del Riesgo</td>
            <td></td>
        </tr>
        @foreach ($ipercs as $iperc)
            <tr>
                <td height="20"></td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">{{ $iperc->task->activity->subProcess->zone->area->jobPosition->headquarter->name }}</td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">{{ $iperc->task->activity->subProcess->zone->area->name }}</td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">{{ $iperc->task->activity->subProcess->zone->name }}</td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">{{ $iperc->task->activity->subProcess->name }}</td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">{{ $iperc->task->activity->subProcess->zone->area->jobPosition->name }}</td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">{{ $iperc->task->activity->name }}</td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">{{ $iperc->task->name }}</td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">{{ $iperc->type_job == 1 ? 'X' : '' }}</td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">{{ $iperc->type_job == 2 ? 'X' : '' }}</td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">{{ $iperc->type_job == 3 ? 'X' : '' }}</td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">{{ $iperc->danger->name }}</td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">{{ $iperc->dangerDescription->name }}</td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">{{ $iperc->dangerDescription->event }}</td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">{{ $iperc->consequence->name }}</td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">{{ $iperc->engineering_controls }}</td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">{{ $iperc->administrative_controls }}</td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">{{ $iperc->epps }}</td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">{{ $iperc->consequence_evaluation }}</td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">{{ $iperc->exhibition_evaluation }}</td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">{{ $iperc->probability_evaluation }}</td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">{{ $iperc->total_evaluation }}</td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">{{ $iperc->risk->name }}</td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"></td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"></td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"></td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"></td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"></td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"></td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"></td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"></td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"></td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"></td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"></td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"></td>
                <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"></td>
                <td></td>
            </tr>
        @endforeach
        <tr>
            <td height="20"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td height="20"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan=12 ></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=13>ELABORADO POR:</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=11>REVISADO POR:</td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=11>APROBADO POR:</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=13></td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=11></td>
            <td style="border: 1px solid #000000;border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" colspan=11></td>
            <td></td>
        </tr>
    </table>
</body>
</html>