@if(!Auth::user()->personalDetails)
  <div class="alert alert-warning">
    <p>
      Estimado usuario, Ud. no posee datos personales asociados a su perfil,
      para poder utilizar esta aplicación a plenitud,
      es recomendable que actualice sus datos desde
      {{ link_to_route('users.show', 'su perfil.', Auth::user()->name) }}
    </p>

    <p>
      No podrá ingresar a los Eventos hasta que haya actualizado su información personal.
    </p>
  </div>
@endif