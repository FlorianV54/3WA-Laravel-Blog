@extends('layout')

@section('js')
  @parent

  {{-- Script pour le piament via l'API Stripe --}}
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  <script type="text/javascript">
  // Jquery
  $(function(){

    // connection à notre Compte "Stripe" par la clef primaire Publique (Test Publishable Key)
    Stripe.setPublishableKey('pk_test_DDewCzPbnWLp5s2AO6WKjHxE');

    $form =  $('#payment-form');
    // submit : quand je soumet mon formulaire
    $form.submit(function(event) {

      // Disable the submit button to prevent repeated clicks:
      $(this).find('#send').attr('disabled');

      // Request a token from Stripe:
      Stripe.card.createToken({
        number: $('.card-number').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      },
      function (status, response) {
        if (response.error) { // Ah une erreur !
          // On affiche les erreurs
          $form.find('.payment-errors').text(response.error.message);
          $form.find('button').prop('disabled', false); // On réactive le bouton
        } else { // Le token a bien été créé
          var token = response.id; // On récupère le token
          // On crée un champs cachée qui contiendra notre token
          $form.append($('<input type="hidden" name="stripeToken" />').val(token));
          $form.get(0).submit(); // On soumet le formulaire
        }
      });
      // Prevent the form from being submitted:
      return false; // pour "bloquer" le formulaire et envoyer les données à "Stripe"
    });
  });
  </script>
@endsection



@section('content')

<section class="invoice">
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa fa-shopping-cart text-green"></i> Paiement
        <small class="pull-right"><i class="fa fa-clock-o"></i> {{ Carbon\Carbon::now()->format('d/m/Y H:i') }}</small>
      </h2>
    </div>
  </div>
  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
      De
      <address>
        <strong>John Doe</strong><br>
      </address>
    </div>
    <div class="col-sm-4 invoice-col">
      A
      <address>
        <strong><?php $prenomNom = Auth::user()->prenom ." ".Auth::user()->nom ?>{{ $prenomNom }}</strong><br>
        {{ Auth::user()->code_postal }} {{ Auth::user()->ville }}<br>
        Tél: {{ Auth::user()->telephone }}<br>
        Email: {{ Auth::user()->email }}
      </address>
    </div>
    <div class="col-sm-4 invoice-col">
      <b>Invoice #007612</b><br>
      <br>
      <b>Order ID:</b> 4F3S8J<br>
      <b>Payment Due:</b> {{ Carbon\Carbon::now()->format('d/m/Y H:i') }}<br>
      <b>Account:</b> {{ Auth::user()->id }}
    </div>
  </div>

  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12 table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Quantité</th>
            <th>Image</th>
            <th>Article</th>
            <th>#</th>
            <th>Description</th>
            <th>Prix</th>
          </tr>
        </thead>
        <tbody>
          @foreach(\App\Article::all()->where('favoris', 1) as $articles)
          <tr>
            <td>1</td>
            <td><img src="{{ $articles->image }}" class="img-responsive" width="50" height="50" /></td>
            <td>{{ $articles->titre }}</td>
            <td>{{ $articles->id }}</td>
            <td>{{ mb_strimwidth(strip_tags($articles->description),0,300,"...") }}</td>
            <td>{{ $articles->prix }}€</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <div class="row">
    <!-- accepted payments column -->
    <div class="col-xs-6">

      {{-- Message flash de success --}}
      @if (Session::has('success'))
        <div class="alert alert-success">
          <p>{{ Session::get('success') }}</p>
        </div>
      @endif

      <p class="lead">Méthode de paiement:</p>
      <img src="/img/credit/visa.png" alt="Visa">
      <img src="/img/credit/mastercard.png" alt="Mastercard">
      <img src="/img/credit/american-express.png" alt="American Express">
      <img src="/img/credit/paypal2.png" alt="Paypal">
      <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
        Veuillez saisir vos informations de carte bancaire ci-dessous
      </p>
      <form id="payment-form" role="form" method="post" enctype="multipart/form-data">
        {{-- csrf_field() => Sécuriser le formulaire avec un Token unique --}}
        {{ csrf_field() }}

        <span class="text-danger payment-errors"></span>

        <div class="">
          <div class="row">
            <div class="col-xs-6">
              <div class="form-group">
                <label for="exampleInputName">N° carte bancaire</label>
                <input required type="text" class="form-control cb placeholderCB card-number" placeholder="" data-stripe="number">
              </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group">
                <label for="exampleInputName">Cryptogramme Visuel</label>
                <input type="text" class="form-control card-cvc crypto" required placeholder="3 derniers chiffres au dos de votre CB" data-stripe="cvc">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-6">
              <div class="form-group">
                <label for="exampleInputName">Mois d'expiration</label>
                <input type="text" class="form-control card-expiry-month" required placeholder="mm" data-stripe="exp_month">
              </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group">
                <label for="exampleInputName">Année d'expiration</label>
                <input type="text" class="form-control card-expiry-year" required placeholder="AAAA" data-stripe="exp_year">
              </div>
            </div>
          </div>
        </div>
        <button type="submit" id="send" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Paiement</button>
      </form>

    </div>
    <div class="col-xs-6">
      <p class="lead"><?php $date = Carbon\Carbon::Now()->addWeeks(2)->diffForHumans() ?>
      Montant du : {{ $date }}</p>
      <div class="table-responsive">
        <table class="table">
          <tbody>
            <tr>
              <th style="width:50%">Sous-total :</th>
              <td>{{ $somme }}€</td>
            </tr>
            <tr>
              <th>TVA (20%)</th>
              <td>{{ round(($somme  * 0.20), 2) }}€</td>
            </tr>
            <tr>
              <th>Total :</th>
              <td>{{ round(($somme + $somme * 0.20), 2) }}€</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  {{-- <div class="row no-print">
    <div class="col-xs-12">
      <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
        <i class="fa fa-download"></i> Export PDF
      </button>
    </div>
  </div> --}}
</section>

@endsection
