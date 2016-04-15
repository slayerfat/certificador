<div class="pdf-user">
  <div class="details">
    <h1 class="pre">
      Certifican que
      {{ $attendant->sex == 'm' ? 'el' : 'la' }}:
    </h1>

    <h1 class="user-full-name">
      {{ $attendant->title->desc }}
      {{ $attendant->formattedNames() }}
    </h1>
    <h1 class="user-ci">C.I. {{ $attendant->ci }}</h1>
  </div>
</div>
