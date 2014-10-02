<footer>
            <p style="color: white;">&copy; 2013 Black Mirror Media</p>

            @if (isset($check_user))
            @if($check_user->hasPermission(array('_superadmin', '_user-editor','_group-editor', '_permissions-editor','_profile-editor')))
            {{ HTML::link('/admin/login', 'Admin') }}
            @endif
            @endif

        </footer> <!-- end footer div -->
    </div>
  {{-- Js files --}}
  {{ HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') }}
  {{ HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/password_strength/strength.js') }}

  <script>
    $(document).ready(function() {
      //------------------------------------
      // password checking
      //------------------------------------
      var password1 		= $('#password1'); //id of first password field
      var password2		= $('#password2'); //id of second password field
      var passwordsInfo 	= $('#pass-info'); //id of indicator element

      passwordStrengthCheck(password1,password2,passwordsInfo);
    });
  </script>
</body>
</html>

