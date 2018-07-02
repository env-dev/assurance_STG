<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Expoter les souscriptions</title>
</head>
<body>
<table>
    <thead>
    <tr>
        <th><strong>Pièce d’identité</strong></th>
        <th><strong>N° pièce d’identité</strong></th>
        <th><strong>Adresse</strong></th>
        <th><strong>Ville</strong></th>
        <th><strong>N° Téléphone</strong></th>
        <th><strong>Adresse email</strong></th>
        <th><strong>Marque appareil</strong></th>
        <th><strong>Modèle appareil</strong></th>
        <th><strong>N° IMEI appareil</strong></th>
        <th><strong>Valeur assurée TTC de l’appareil</strong></th>
        <th><strong>Garanties souscrites</strong></th>
        <th><strong>Date d’effet  AN</strong></th>
        <th><strong>Durée de l’adhésion</strong></th>
        <th><strong>Prime totale  TTC</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($registrations as $registration)
        <tr>
            <td>{{ $registration->client->type_id }}</td>
            <td>{{ $registration->client->num_id }}</td>
            <td>{{ $registration->client->address }}</td>
            <td>{{ $registration->client->city }}</td>
            <td>{{ $registration->client->tel }}</td>
            <td>{{ $registration->client->email }}</td>
            <td>{{ $registration->smartphone->model->brand->name }}</td>
            <td>{{ $registration->smartphone->model->name }}</td>
            <td>{{ $registration->smartphone->imei }}</td>
            <td>{{ $registration->smartphone->model->price_ttc }}</td>
            <td>{{ $registration->guarantee }}</td>
            <td>{{ $registration->data_flow }}</td>
            <td>{{ $registration->data_flow->diffForHumans() }}</td>
            <td>{{ $registration->total_ttc }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>