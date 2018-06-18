<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta http-equiv = "content-type" content = "text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <link rel="stylesheet" type="text/css" href="src/App/Assets/css/semantic.min.css">       
        <title>Composer Autoload e Namespace</title>
    </head>
    <body>
<div class="ui fixed inverted menu">
  <div class="ui container">
    <a href="home" class="header item">
      <img class="logo" src="src/App/Assets/img/logo.png">
      Fisio Evol
    </a>
    <a href="home" class="item">Home</a>
    <div class="ui simple dropdown item">
      Dropdown <i class="dropdown icon"></i>
      <div class="menu">
        <a class="item" href="#">Link Item</a>
        <a class="item" href="#">Link Item</a>
        <div class="divider"></div>
        <div class="header">Header Item</div>
        <div class="item">
          <i class="dropdown icon"></i>
          Sub Menu
          <div class="menu">
            <a class="item" href="#">Link Item</a>
            <a class="item" href="#">Link Item</a>
          </div>
        </div>
        <a class="item" href="#">Link Item</a>
      </div>      
    </div>
    <a href="login" class="item">Login</a>
  </div>
</div>

<div class="ui main text container">
  <h1 class="ui header">Semantic UI Fixed Template</h1>
  <?php $this->loadViewInTemplate($viewName, $viewData);?>
</div>
<div class="ui inverted vertical footer segment">
  <div class="ui center aligned container">
    <div class="ui stackable inverted divided grid">
      <div class="three wide column">
        <h4 class="ui inverted header">Group 1</h4>
        <div class="ui inverted link list">
          <a href="#" class="item">Link One</a>
          <a href="#" class="item">Link Two</a>
          <a href="#" class="item">Link Three</a>
          <a href="#" class="item">Link Four</a>
        </div>
      </div>
      <div class="three wide column">
        <h4 class="ui inverted header">Group 2</h4>
        <div class="ui inverted link list">
          <a href="#" class="item">Link One</a>
          <a href="#" class="item">Link Two</a>
          <a href="#" class="item">Link Three</a>
          <a href="#" class="item">Link Four</a>
        </div>
      </div>
      <div class="three wide column">
        <h4 class="ui inverted header">Group 3</h4>
        <div class="ui inverted link list">
          <a href="#" class="item">Link One</a>
          <a href="#" class="item">Link Two</a>
          <a href="#" class="item">Link Three</a>
          <a href="#" class="item">Link Four</a>
        </div>
      </div>
      <div class="seven wide column">
        <h4 class="ui inverted header">Footer Header</h4>
        <p>Extra space for a call to action inside the footer that could help re-engage users.</p>
      </div>
    </div>
    <div class="ui inverted section divider"></div>
    <img src="src/App/Assets/img/logo.png" class="ui centered mini image">
    <div class="ui horizontal inverted small divided link list">
      <a class="item" href="#">Site Map</a>
      <a class="item" href="#">Contact Us</a>
      <a class="item" href="#">Terms and Conditions</a>
      <a class="item" href="#">Privacy Policy</a>
    </div>
  </div>
</div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="src/App/Assets/js/semantic.min.js">
    </script>
    <script>
        $(document).ready(function () {
            $('.ui.form')
                .form({
                    fields: {
                        email: {
                            identifier: 'email',
                            rules: [
                                {
                                    type: 'empty',
                                    prompt: 'Please enter your e-mail'
                                },
                                {
                                    type: 'email',
                                    prompt: 'Please enter a valid e-mail'
                                }
                            ]
                        },
                        password: {
                            identifier: 'password',
                            rules: [
                                {
                                    type: 'empty',
                                    prompt: 'Please enter your password'
                                },
                                {
                                    type: 'length[6]',
                                    prompt: 'Your password must be at least 6 characters'
                                }
                            ]
                        }
                    }
                })
                ;
        })
            ;
    </script>
    </body>
</html>