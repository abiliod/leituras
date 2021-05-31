<!-- Footer Structure -->
<footer class="page-footer #1b5e20 green darken-4">
    <div class="container ">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text"><a href="{{ route('home') }}" class="brand-logo"><img class="logo_institucional" src="{{asset('img/institucional/logo.png')}}"></a></h5>
          <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
        </div>
        <div class="col l4 offset-l2 s12">
          <h5 class="white-text">Links</h5>
          <ul>
            
          <li><a href="{{ route('site.sobre') }}">Sobre</a></li>
          <li><a href="{{ route('site.contato') }}">Contato</a>
            <li><a class="grey-text text-lighten-3" href="#!"></a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
        © 2020 Copyright By Abilio.adm.br
        <a class="grey-text text-lighten-4 right" href="#!"></a>
      </div>
    </div>
  </footer>