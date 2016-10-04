Haga click aquí para cambiar su clave:
<a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}">
  {{ $link }}
</a>
