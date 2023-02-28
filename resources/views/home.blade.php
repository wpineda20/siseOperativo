@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-body p-5">
        <h5 class="card-title fw-bold text-center">Bienvenid@ al Sistema Informático de Seguimiento y Evaluación SISE
            {{date("Y")}}</h5>
        <h6 class="card-subtitle mb-2 text-muted text-center">Dirección General de Planificación y Desarrollo
            Institucional Ministerio de Cultura de El Salvador</h6>
        <hr>
        <h5 class="card-title fw-bold">¿Qué es el seguimiento?</h5>
        <p class="card-text">El seguimiento consiste en el análisis y recopilación sistemáticos de información a medida
            que avanza un proyecto. Su objetivo es mejorar la eficacia y efectividad de un proyecto y organización. Se
            basa en metas establecidas y actividades planificadas durante las distintas fases del trabajo de
            planificación. Ayuda a que se siga una línea de trabajo, y además, permite a la administración conocer
            cuando algo no está funcionando. Si se lleva a cabo adecuadamente, es una herramienta de incalculable valor
            para una buena administración y proporciona la base para la evaluación. Te permite determinar si los
            recursos disponibles son suficientes y están bien administrados, si tu capacidad de trabajo es suficiente y
            adecuada, y si estás haciendo lo que habías planificado</p>
        <h5 class="card-title fw-bold">¿Qué es la evaluación?</h5>
        <p class="card-text">La evaluación consiste en la comparación de los impactos reales del proyecto con los planes
            estratégicos acordados. Está enfocada hacia lo que habías establecido hacer, lo que has conseguido y cómo lo
            has conseguido. Puede ser formativa: tiene lugar durante la vida de un proyecto u organización con la
            intención de mejorar la estrategia o el modo de funcionar del proyecto y organización. También puede ser
            conclusiva: obteniendo aprendizaje a partir de un proyecto completado o una organización que ya no está en
            funcionamiento. Una vez alguien describió esto como la diferencia entre un reconocimiento médico y una
            autopsia.</p>
        {{-- <a href="#" class="btn btn-primary">Go somewhere</a> --}}
    </div>
</div>
@endsection