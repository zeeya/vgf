
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
    .width-80{
        width:90% !important;
    }
    .m-auto{
        margin: auto !important;
    }
    .grey{
        color:grey !important;
    }
    .back-grey {
        background: #d4d4d447 !important;
        border: 1px solid #dedede;
    }
    .txt-center{
        text-align:center !important;
    }
    .body{
        border: 1px solid black !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    .f-50{
        font-size: 18px !important;
    }
    .f-70{
        font-size: 2.25rem !important;
        font-weight: bold !important;
    }
    .b-radius{
        border-radius: 15px !important;
    }
    .b-black{
        border: 1px solid grey !important;
    }
    .mar-bot{
        margin-bottom: 20px !important;
    }
    .mar-bot-45{
        margin-bottom: 35px !important;
    }
    .mar-bot-200{
        margin-bottom: 100px !important;

    }
    .mar-top{
        margin-top: 20px !important;
    }
    .w-50{
        width: 50% !important;
        display: inline-block !important;
    }
    .w-50-s{
        width: 50% !important;
        padding-left: 2em;
    }
    .body h2{
        text-transform: uppercase !important;
        font-size: 1.4rem;
    }
    .f-left{
        padding-left: 25px !important;
    }
    .p-left{
        padding-left: 25px !important;

    }
    .f-right{
        float: right !important;
        padding-left: 25px !important;

    }
    .w-70{
        width: 70px !important;
    }
    .body p {
        margin-top: 1rem;
    }
    .body h1,.body h2 {
        margin-top: 1rem;
        font-weight: bold;

    }
    hr.hr-left {
        border-style: none;
        background: grey;
        height: 1px;
        width: calc(100% - 25px);
        text-align: left;
        margin-left: -25px;
    }
    hr.hr-right {
        border-style: none;
        background: grey;
        height: 1px;
        width: calc(24px + 100%);
        text-align: right;
        margin-left: -25px;
    }
    .txt-right{
        text-align: right;
    }
    .pd-right{
        padding-right: 1em;
    }
    .grey-b {
        padding: 0.5em 1em !important;
        display: inline-block !important;
    }
    .w-100{
        width: 100% !important;
    }
    .barcode div{
        margin: auto;
    }
    .transparent{
        color: #eeeff1  !important;
    }
    .bloc-4 p {
        margin: 0;
    }
    .bloc-4 p:last-child {
        margin-bottom: 1rem;
    }
    .bloc-2 p, .bloc-3 p{
        font-size: 22px !important;
    }
    </style>
    <!-- Styles -->
</head>
<body>
<div class="body">
<div class="width-80 m-auto txt-center back-grey  b-radius mar-bot mar-top bloc-2">
     <p><strong>N° KVPS : </strong>{{ $return_request->n_kvps }}</p>
</div>
<div class="width-80 m-auto b-black b-radius txt-center mar-top mar-bot bloc-3">
     <h1 class="f-70">DEMANDE DE RETOUR</h1>
     <div class="mar-top barcode">
        <?= $barcode ?>
     </div>
     <P class="grey"><strong>N° de retour VGF</strong> : {{ $code }}</P>
</div>
<div class="width-80 m-auto  back-grey f-50 b-radius mar-bot-45 bloc-4">
    <table  style="width:100%;">
        <tr>
            <td class="w-50-s" style="">
                <h2>expéditeur</h2>
                <p>{{ $adress_shipping->name }}</p>
                <p>{{ $adress_shipping->phone }}</p>
                <p>{{ $adress_shipping->adress }}</p>
                <p>{{ $adress_shipping->postcode }} {{ $adress_shipping->city }}</p>
            </td>
            <td  class="w-50-s" style="">
                <h2>destinataire</h2>
                <p>Volswagen Group France</p>
                <p>Entreport P.R.A</p>
                <p>avenue de bouns anne</p>
                <p>02600 V ILLERS-COTTEReTS</p>
            </td>
        </tr>
    </table>
</div>

<div class="width-80 m-auto mar-bot-45">
    <table  style="width:100%;">
        <tr>
            <td class="w-50-s" style="">
                <strong>Désignation colis:</strong>
                <hr class="hr-left">
                <strong class="grey">{{ $package_designation->name }}</strong>
            </td>
            <td  class="w-50-s" style="">
                <strong>Type de retour:</strong>
                <hr class="hr-right">
                <strong class="grey">{{ $return_type->name }}</strong>
            </td>
        </tr>
    </table>
</div>
<div class="width-80 m-auto mar-bot-45">
    <table  style="width:100%;">
        <tr>
            <td class="w-50-s" style="">
            </td>
            <td  class="w-50-s" style="">
                <strong class="pd-right">Pois total du retour:</strong><strong class="back-grey b-radius grey-b f-50 grey">{{ $return_request->weight_kg }} Kg</strong>
            </td>
        </tr>
    </table>

</div>
<div class="width-80 m-auto mar-bot-200">
    <table  style="width:100%;">
        <tr>
            <td class="w-50-s" style="">
                <strong class="pd-right">Demande faite le:</strong> <p class="back-grey b-radius grey-b f-50">{{ date('d-m-Y', strtotime($return_request->created_at)) }}</p>
            </td>
            <td  class="w-50-s" style="">
                <strong class="pd-right">VGR recu le:</strong> <p class="back-grey b-radius grey-b  f-50 transparent">{{ date('d-m-Y', strtotime($return_request->created_at)) }}</p>
            </td>
        </tr>
    </table>
</div>

<div class="width-80 m-auto txt-center">
<strong>Ce document est à coller sur le colis.</strong>
 
</div>

</div>

</body>

</html>