<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<title>La facture d'achat</title>
		<style>
            body {
                margin: 0;
            }
			.invoice-box {
				margin: 0;
				padding: 30px 30px 80px 30px;
				border: 1px solid #eee;
				font-size: 13.5px;
				line-height: 17px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}
			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}
			.invoice-box table th {
                color: #eee !important;
				background-color: rgb(79, 129, 189);;
			}
			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}
			.invoice-box table tr.top div p {
				padding-bottom: 20px;
			}
			.invoice-box table tr.top div p.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}
			.invoice-box table tr.information div p {
				padding-bottom: 40px;
			}
            .information_client {
                line-height: 2.5em;
            }
            .information_client_date {
                line-height: 10em;
            }
            .separator {
                line-height: 5.5em;
            }
            .information_seller {
                line-height: 5.5em;
            }   
            .information_seller_date {
                line-height: 12.5em;
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
            .title .topTitle {
                font-size: 20px;
                font-weight: bold;
                line-height: 2.5em;
                margin-bottom: 90px;
                
                text-align: center;
            }

            .title .subTitle {
                font-size: 17px;
                font-weight: bold;

                margin: 0;

                text-align: center;

                color: rgb(196, 142, 44);
            }
            table.shown {
                border-collapse: collapse; 
                border-spacing: 0;
            }
            table.shown th {
                color: rgb(79, 129, 189);
                text-align: center;
                border: 2px solid rgb(79, 129, 189);
            }
            table.shown td {
                text-align: center;
                border: 2px solid rgb(79, 129, 189);
            }
            fieldset {
                border: 2px solid rgb(79, 129, 189);
            }
		</style>
	</head>
	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
                        <div class="title">
                            <h4 class="topTitle">Assurances Appareils Mobiles</h4>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong>Partie 1: (à renseigner par le Client) |</strong>
                        <p>
                            A l’achat de ce Smartphone, vous bénéficiez d’une couverture contre la ‘’Casse d’écran’’ pour une durée de douze (12) mois à partir de la date d’achat.
                        </p>
                        <p>
                            Cette couverture vous permet d’assurer la protection de votre Smartphone contre toute destruction ou détérioration totale ou partielle extérieurement visible et nuisant au bon fonctionnement de votre Smartphone, constituant la cause exclusive de la casse accidentelle
                        </p>
                        <p>
                            Pour pouvoir bénéficier de la garantie ‘’Casse d’écran’’, merci de renseigner les champs suivants :
                        </p>
                </td>
				</tr>
				<tr class="information_client">
					<td colspan="2">
                        <label>Nom / Raison sociale: </label><strong> {{ $client->last_name }} </strong><label>Prénom: </label><strong>{{ $client->first_name }}</strong><br>
                        <label>N* CIN/ RC : </label><strong> {{ $client->num_id }} </strong><br>
                        <label>Date d’achat du Smartphone :</label><strong> {{ $client->email }} </strong><br>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="information_client_date">
                        <label>Fait à </label>, le {{ Carbon\Carbon::now()->format('Y/m/d') }}<br>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><strong style="line-height: 8.5em">Signature du Client</strong><br></td>
                </tr>
                <tr class="separator">
                    <td colspan="2">
                            --------------------    ---------------------   ---------------------    ---------------------   ---------------------  ---------------------   ---------------------  -------------
                    </td>
                </tr>
				<tr class="information_seller">
                    <td colspan="2">
                        <p>
                            <strong>Partie 2 (à renseigner par le Vendeur)</strong>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table class="shown">
                            <tr>
                                <th>Date de vente</th>
                                <th>Modéle Smartphone</th>
                                <th>Réf de la facture d’achat</th>
                                <th>N°IMEI</th>
                                <th>Prix de vente</th>
                            </tr>
                            @foreach($smartphones as $smartphone)
                                <tr>
                                    @if($pdf_Registration)
                                        <td><strong> {{ $pdf_Registration->data_flow->format('Y/m/d') }} </strong></td>
                                    @else
                                        <td><strong>-------------</strong></td>
                                    @endif
                                    <td><strong> {{ $smartphone->model->name }} </strong></td>
                                    <td><strong>  </strong></td>
                                    <td><strong>{{ $smartphone->imei }}</strong></td>
                                    <td><strong> {{ $smartphone->model->price_ttc }} </strong></td>
                                </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
                <tr class="information_client_date">
                    <td>
                        <label>Fait à </label>, le {{ Carbon\Carbon::now()->format('Y/m/d') }}<br>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><strong>Signature du Vendeur</strong><br></td>
                </tr>
			</table>
		</div>
	</body>
</html>