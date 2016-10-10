<!DOCTYPE html>
<html>
  <head>
    <title>Template mailing</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta content="width=device-width">
    <style type="text/css">
      /* Fonts and Content */
      body, td { font-family: 'Helvetica Neue', Arial, Helvetica, Geneva, sans-serif; font-size:14px; }
      body { background-color: #2A374E; margin: 0; padding: 0; -webkit-text-size-adjust:none; -ms-text-size-adjust:none; }
      h2{ padding-top:12px; /* ne fonctionnera pas sous Outlook 2007+ */color:#0E7693; font-size:22px; }

      @media only screen and (max-width: 480px) {
        table[class=w275], td[class=w275], img[class=w275] { width:135px !important; }
        table[class=w30], td[class=w30], img[class=w30] { width:10px !important; }
        table[class=w580], td[class=w580], img[class=w580] { width:280px !important; }
        table[class=w640], td[class=w640], img[class=w640] { width:300px !important; }
        img{ height:auto;}
        /*illisible, on passe donc sur 3 lignes */
        table[class=w180], td[class=w180], img[class=w180] {
          width:280px !important;
          display:block;
        }
        td[class=w20]{ display:none; }
      }
    </style>
  </head>

  <body style="margin:0px; padding:0px; -webkit-text-size-adjust:none;">

    @section('content')
    @show

  </body>

</html>
