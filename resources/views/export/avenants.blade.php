<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
        <th><strong>N° IMEI appareil</strong></th>
        <th><strong>Extensions ajoutées</strong></th>
        <th><strong>Date d’effet  de l'avenant</strong></th>
        <th><strong>Surprime TTC</strong></th>
    </tr>
    </thead>
    <tbody>
    @foreach($avenants as $avenant)
        <tr>
            <td>{{ $avenant->registration->client->type_id }}</td>
            <td>{{ $avenant->registration->client->num_id }}</td>
            <td>{{ $avenant->registration->client->address }}</td>
            <td>{{ $avenant->registration->client->city }}</td>
            <td>{{ $avenant->registration->client->tel }}</td>
            <td>{{ $avenant->registration->client->email }}</td>
            <td>{{ $avenant->registration->smartphone->imei }}</td>
            <td>{{ ($avenant->extenion_added == 110) ? 'F2' : 'F3' }}</td>
            <td>{{ $avenant->effective_date->diffForHumans() }}</td>
            <td>{{ $avenant->add_premium }}</td>
        </tr>
    @endforeach
    <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Total surprime TTC</td>
            <td>{{ $total_surprime }}</td>
        </tr>
    </tbody>
</table>
</body>
</html>