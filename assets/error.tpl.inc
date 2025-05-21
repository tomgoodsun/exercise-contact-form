<div class="col-12">
  <h1>Contact Form - Error</h1>
  <form class="done">
    <div class="alert alert-danger" role="alert">
      Error occurred.
    </div>
    <pre><?php
      echo $tplVars['errorMessage'] . '<br />';
      printf('Error Class: %s<br />', $tplVars['errorClass']);
      printf('Error Code: %s<br />', $tplVars['errorCode']);
      printf('%s on line %s<br />', $tplVars['errorFile'], $tplVars['errorLine']);
      printf('Stacktrace:<br />%s<br />', $tplVars['errorTrace']);
    ?></pre>
    <div class="buttons">
      <a href="" class="btn btn-primary">Back</a>
    </div>
  </form>
</div>

