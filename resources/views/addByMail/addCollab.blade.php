<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .mail-content{
            justify-content: center;
            display: block;
            align-items: center;
            text-align: center;
        }
        .block-btn {
            justify-content: center;
            display: flex;
            align-items: center
        }
        .accept-btn {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            padding-left: 0.7rem;
            padding-right: 0.7rem;
            background-color: #5cb85c;
        }
        .accept-btn:hover {
            background-color: #679767;
        }

        .refuse-btn {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            padding-left: 0.7rem;
            padding-right: 0.7rem;
            background-color: #d9534f;
            margin-left: 2rem;
            margin-right: 2rem;
            margin-top: 1rem;
            margin-bottom: 1rem;
        }
        .refuse-btn:hover {
            background-color:#cc6562;
        }
    </style>
</head>
<body>
    <div class="mail-content">
        <h3>Demande de participation au projet gozem</h3>
        <p><b>Titre de la demande : Collaborateur</b></p>
        <P>Acceptez-vous la demande ?</P>
        <div class="block-btn">
            <a href="{{ route('partners.inviteLogin') }}" class="accept-btn"><i class="bi bi-check-lg"></i> Oui</a>
            <a href="{{-- route('partners.inviteLogin') --}}" class="refuse-btn"><i class="bi bi-x-lg"></i> Non</a>
        </div>
    </div>
</body>
</html>