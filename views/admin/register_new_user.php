  <div id="login-page" class="row center center-align">
    <form id="formValidate" name="register" action="#">
      <div class="login-form center" style="margin-left:40%">
        <div class="row">
          <div class="input-field col s12 center">
            <h4>Registrar Nuevo Usuario</h4>
            <p class="center">Join to our community now !</p>
          </div>
        </div>
        <div class="row margin input-field">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input id="username" name="username" type="text" autocomplete="off">
            <label for="username" class="center-align">Username</label>
          </div>
        </div>
        <div class="row margin input-field">
          <div class="input-field col s12">
            <i class="mdi-communication-email prefix"></i>
            <input id="email" name="email" type="email" autocomplete="off">
            <label for="email" class="center-align">Email</label>
          </div>
        </div>
        <div class="row margin input-field">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password" name="password" type="password" autocomplete="off">
            <label for="password">Password</label>
          </div>
        </div>
        <div class="row margin input-field">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="passwordagain" name="password-again" type="password" autocomplete="off">
            <label for="password-again">Password again</label>
          </div>
        </div>
        <div class="row margin">
          <div class="col s12">
            <i class="mdi-hardware-security prefix"></i>
            <label for="crole">Rol</label> 
            <select class="browser-default" id="role" name="role">
              <option value="" disabled selected>Elegir Rol</option>
              <option value="0">Usuario</option>
              <option value="1">Administrador</option>
            </select>
          </div>
        </div> 
        <div class="row">
          <div class="input-field col s12">
            <a class="btn waves-effect waves-light" name="register" id="register-user">Submit
              <i class="mdi-content-send right"></i>
            </a>      
          </div>
        </div>
      </div>
    </form>
  </div>
  
  <script>
$( document ).ready(function() {
  $( "#register-user" ).on('click', function() {
    var username = $('#username').val();
    var password = $('#password').val();
    var passwordagain = $('#passwordagain').val();
    var email = $('#email').val();
    var role = $('#role').val();

    jQuery.ajax({
      method: "POST",
      url: "ajax/register.php",
      data: {
        'register' : true,
        'user_name': username,
        'user_password_new': password,
        'user_email': email,
        'user_password_repeat': passwordagain,
        'user_role': role
      },
      error: function(response) {
        alert("response");
      },
      success: function(response)
      {
        var resp = jQuery.parseJSON(response);
        $.each(resp, function( index, value ) {
          Materialize.toast(value, 1500);
          if(index === "perfect"){
            $('#formValidate').trigger("reset");
            //$('#register-user').addClass('green');
          }
        });
      }
    });//ajax

  });
});
  </script>