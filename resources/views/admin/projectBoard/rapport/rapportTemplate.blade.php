<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport-PDF</title>
    <style>
        .table td {
            text-align: justify;
        }

    </style>
</head>
<body>
    <div style="width: 95%; margin: 0 auto;">
        <div style="width: 10%; float:left; margin-right: 20px;">
            <img src="{{ asset('assets/logos/goproject-03.png') }}" width="100%" alt="">
        </div>
    </div>
    <div style="width: 100%; text-align: center;">
        <h1>Rapport</h1>
    </div>
    <table>
        <tbody>
            <tr>
                <td data-column="Title" width="20%">Titre:</td>
                <td data-column="Title"width="50%">{{ $rapports->title }}</td>
            </tr>
            <tr>
                <td data-column="Clee" width="20%">Clée:</td>
                <td data-column="Clee" width="50%">{{ $rapports->key }}</td>
            </tr>
            <tr>
                <td data-column="Date debut" width="20%">Date de début:</td>
                <td data-column="Date debut" width="50%">{{ \Carbon\Carbon::parse($rapports->date_debut)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td data-column="Date fin" width="20%">Date de fin:</td>
                <td data-column="Date fin" width="50%">{{ \Carbon\Carbon::parse($rapports->date_fin)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td data-column="Montant" width="20%">Montant du budget:</td>
                <td data-column="Montant" width="50%">{{ $rapports->budget }}</td>
            </tr>
            <tr>
                <td data-column="Stade" width="20%">Stade du projet:</td>
                <td data-column="Stade" width="50%">{{ $rapports->stade }}</td>
            </tr>
            <tr>
                <td data-column="Resume" width="100%" colspan="2">Résumé:</td>
            </tr>
            <tr>
                <td data-column="Resume" width="100%" colspan="2" style="text-align: justify;">{{ $rapports->resume }}</td>
            </tr>
        </tbody>
    </table> 
</body>
</html>