<footer class="site-footer">
  <div class="container">
      <div class="row">
          <div class="col-sm-12 col-md-6">
              <h6>À Propos</h6>
              <p class="text-justify">Aurora est votre destination ultime pour les sacs à main tendance. Nous proposons une large gamme de sacs à main élégants et de haute qualité fabriqués à partir de matériaux premium. Notre mission est de fournir aux clients la meilleure expérience d'achat et les dernières tendances de la mode en matière de sacs à main.</p>
          </div>

          <div class="col-xs-6 col-md-3">
              <h6>Catégories</h6>
              <ul class="footer-links">
                <li><a  href="{{ route('collection.produits', ['collection' => '1']) }}">Collection 1</a></li>
                <li><a  href="{{ route('collection.produits', ['collection' => '2']) }}">Collection 2</a></li>
                <li><a  href="{{ route('collection.produits', ['collection' => '4']) }}">Collection 4</a></li>
              </ul>
          </div>

          <div class="col-xs-6 col-md-3">
              <h6>Liens Rapides</h6>
              <ul class="footer-links">
                  <li><a href="#">À Propos de Nous</a></li>
                  <li><a href="#">Contactez-nous</a></li>
                  <li><a href="{{ route('privacy_policy') }}">Règles de confidentialité</a></li>
        <li><a href="{{ route('terms_of_use') }}">Conditions d'utilisation</a></li>
              </ul>
          </div>
      </div>
      <hr>
  </div>
  <div class="container">
      <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
              <p class="copyright-text">Droits d'auteur &copy; 2024 Tous droits réservés par 
                  <a href="#">Aurora</a>.
              </p>
          </div>

          <div class="col-md-4 col-sm-6 col-xs-12">
              <ul class="social-icons">
                  <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                  <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                  <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                  <li><a class="pinterest" href="#"><i class="fa fa-pinterest"></i></a></li>
              </ul>
          </div>
      </div>
  </div>
</footer>
