<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<title>La facture d'achat</title>
		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, .15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}
			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}
			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}
			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}
			.invoice-box table tr.top div p {
				padding-bottom: 20px;
                display: inline-block;
                margin: 0;
			}
			.invoice-box table tr.top div p.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}
			.invoice-box table tr.information div p {
				padding-bottom: 40px;
                display: inline-block;
                margin: 0;
			}
            .align-right {
                float: right;
            }
			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}
			.invoice-box table tr.details {
				border: 1px solid gray;
			}
			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}
			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}
			.invoice-box table tr.item.last td {
				border-bottom: none;
			}
			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}
			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}
				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}
			/** RTL **/
			.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}
			.rtl table {
				text-align: right;
			}
			.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>
	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="4">
						<div>
							<div>
								<p class="title" colspan="2">
									<img src="{{ public_path() . '/images/logo.png' }}" style="width:100%; max-width:200px;">
								</p>
								<p colspan="2" class="align-right">
									Mandat #: {{ $registration->mandat_num }}<br> 
									Créé: {{ $registration->data_flow }}
								</p>
							</div>
						</div>
					</td>
				</tr>
				<tr class="information">
					<td colspan="4">
						<div>
							<div>
								<p colspan="2">
											Agence STG maroc
									<br> Angle Place Moulay Abdelaziz
									<br> Zalaka, N°5, Résidence Annasser
									<br> N°22 et 28، Tangier 90000
								</p>
								<p colspan="2" class="align-right">
										Agence STG maroc
									<br> Test
									<br> test@example.com
								</p>
							</div>
						</div>
					</td>
				</tr>
				<tr class="heading">
					<td colspan="4">
						Informations client
					</td>
				</tr>
				<tr class="details">
					<td>
						Nom:
					</td>
					<td>
						<strong> {{ $client->last_name }} {{ $client->first_name }} </strong>
					</td>
					<td>
						Tel:
					</td>
					<td>
						<strong> {{ $client->tel }} </strong>
					</td>
				</tr>
				<tr class="details">
					<td>
					email:
					</td>
					<td>
						<strong> {{ $client->email }} </strong>
					</td>
					<td>
					Ville:
					</td>
					<td>
						<strong> {{ $client->city }} </strong>
					</td>
				</tr>
				<tr class="details">
					<td>
					adresse:
					</td>
					<td>
						<strong> {{ $client->address }} </strong>
					</td>
					<td>
					nature:
					</td>
					<td>
						<strong> {{ $client->nature }} </strong>
					</td>
				</tr>
				<tr class="details">
					<td>
					Date de naissance:
					</td>
					<td>
						<strong> {{ $client->birth_date }} </strong>
					</td>
					<td>
					Piéce d'identité:
					</td>
					<td>
						<strong> {{ $client->type_id }} </strong>
					</td>
				</tr>
				<tr class="details">
					<td>
					Num {{ $client->type_id }}:
					</td>
					<td>
						<strong> {{ $client->num_id }} </strong>
					</td>
				</tr>
				<tr class="heading">
					<td colspan="4">
						Informations sur l'inscription
					</td>
				</tr>
				<tr class="item">
					<td colspan="2">
						Nom du smartphone
					</td>
					<td colspan="2">
						<strong> {{ $smartphone->model->brand->name }} {{ $smartphone->model->name }} </strong>
					</td>
				</tr>
				<tr class="item">
					<td colspan="2">
						Prix du smartphone
					</td>
					<td colspan="2">
						<strong> {{ $smartphone->model->price_ttc }} </strong>
					</td>
				</tr>
				<tr class="item last">
					<td colspan="2">
						La guarantie
					</td>
					<td colspan="2">
					<strong>
					@if( $registration->guarantee == '110' )
						F2
					@elseif($registration->guarantee == '111' )
						F3
					@else
						F1
					@endif
					</strong>
					</td>
				</tr>
				<tr class="total">
					<td></td>
					<td>
						Total: <strong> {{ $registration->total_ttc }} </strong>
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>