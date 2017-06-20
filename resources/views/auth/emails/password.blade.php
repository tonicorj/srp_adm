<h1>
    SADE - Senha
</h1>
<br>
Clique para cadastrar sua nova senha para acessar o SADE:
<a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>


