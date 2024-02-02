we have received reset password request click below link to reset password  <br>

<div>
  


<a href="{{ route('resetPasswordForm', ['email' => $maildata['receiver'], 'token' => $maildata['token']]) }}">Click me</a>

</div>