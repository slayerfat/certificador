<div id="details">
  <div class="info">
    <p>
      JORNADA
      <br>
      {{ $event->name }}

      <br>
      {{ $event->info }}
    </p>

    <h3>
      Registro del Certificado
    </h3>

    <p>
      Fecha: {{ $event->date }}
      Horas: {{ $event->hours }}
      Libro: _____
      Hoja: _____
    </p>
  </div>

  <h2>
    CONTENIDO:
  </h2>

  {!! $event->content !!}
</div>