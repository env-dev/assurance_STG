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
                line-height: 24px;
                
                margin: 0;
                
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
                            <h5 class="subTitle">Mandat de souscription</h5>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table class="shown">
                            <tr>
                                <th>Agence</th>
                                <th>Référence</th>
                                <th>Numero de mandat</th>
                            </tr>
                            <tr>
                                <td>{{ $agency->full_name }}</td>
                                <td>{{ $agency->reference }}</td>
                                <td>{{ $registration->mandat_num }}</td>
                            </tr>
                        </table>
                </td>
				</tr>
				<tr class="information">
					<td colspan="2">
                        <fieldset>
                            <legend>Assuré / Mandant</legend>
                            <label>Nom / Raison sociale: </label>.............<strong> {{ $client->last_name }} </strong>...........................<label>Prénom</label>.................<strong>{{ $client->first_name }}</strong>....................<br>
                            <label>Date de naissance: </label>.................................<strong> {{ $client->birth_date->format('d/m/Y') }} </strong>................................<br>
                            <label>N* CIN/ RC : </label>.......................................<strong> {{ $client->num_id }} </strong>...........................................<br>
                            <label>Adresse :</label>............................................<strong> {{ $client->address }} </strong>.................................................<br>
                            ......................................................................................................................................................................<br>
                            <label>N* Telephone :</label>........................................<strong> {{ $client->tel }} </strong>............................................................<br>
                            <label>E-mail :</label>  ............................................<strong> {{ $client->email }} </strong>.............................................................<br>
                        </fieldset>
                    </td>
				</tr>
				<tr>
                    <td colspan="2">
                        <table class="shown">
                            <tr>
                                <th>Modéle d'appareil</th>
                                <th>Marque</th>
                                <th>N*IMEI</th>
                                <th>Valeur assurée TTC</th>
                                <th>Réf facture d'achat</th>
                            </tr>
                            <tr>
                                <td><strong> {{ $smartphone->model->name }} </strong></td>
                                <td><strong>{{ $smartphone->model->brand->name }}</strong></td>
                                <td><strong>{{ $smartphone->imei }}</strong></td>
                                <td><strong> {{ $smartphone->model->price_ttc }} </strong></td>
                                <td></td>
                            </tr>
                        </table>
                    </td>
				</tr>
				<tr>
					<td colspan="2">
                        <fieldset>
                            <legend>Garanties</legend>
                            <p>Casse accidentelle toutes causes et oxydation</p><span class="checkGuarantee"></span>
                        </fieldset>
                    </td>
				</tr>
				<tr>
                    <td colspan="2">
                        <table class="shown">
                            <tr>
                                <th>Date d'effet</th>
                                <th>Date d'expiration</th>
                                <th>Prime totale TTC</th>
                            </tr>
                            <tr>
                                <td><strong>{{ $registration->data_flow->format('d/m/Y') }}</strong></td>
                                <td><strong>{{ $registration->data_flow->addDays(5)->format('d/m/Y') }}</strong></td>
                                <td><strong> {{ $registration->total_ttc }} </strong></td>
                            </tr>
                        </table>
                    </td>
				</tr>
				<tr>
                    <td colspan="2">
                        <fieldset>
                            <legend>Mandat de souscription et autorisation de prélèvement</legend>
                            <p>
                                Je mandate par la présente, STG, à souscrire pour mon compte l’assurance Appareils Mobiles pour la  valeur déclarée ci-dessus, auprès de RMA par l’intermédiaire de AON Acore. 
                                J’autorise, dès à présent, STG à effectuer le prélèvement automatique de la prime sur ma facture.  Le prélèvement de la  prime vaudra acceptation de mon assurance et le contrat prendra effet à la date demandée par moi-même et indiquée ci-dessus.
                            </p>
                        </fieldset>
                    </td>
				</tr>
				<tr>
                    <td colspan="2">
                        <fieldset>
                            <legend>Autorisation de prélèvement :</legend>
                            <p>
                                J’autorise STG à effectuer à compter du..............le prélèvement automatique de la prime sur ma facture. 
                            </p>
                        </fieldset>
                    </td>
				</tr>
				<tr>
                    <td colspan="2">
                        <fieldset>
                            <legend>Résiliation du contrat d'assurance</legend>
                            <p>
                                J’accepte et reconnais qu’en cas de résiliation de mon contrat avec STG pour quelque motif que ce soit, que le contrat d’assurance qui découle du présent mandat de souscription soit résilié à la même date.
                            </p>
                        </fieldset>
                    </td>
				</tr>
				<tr>
                    <td colspan="2">
                        <fieldset>
                            <legend>Déclaration du mandat :</legend>
                            <p>
                                Les données personnelles demandées par l’assureur ont un caractère obligatoire pour obtenir la souscription du présent contrat et l’exécution de l’ensemble des services qui y sont rattachés. Elles sont utilisées exclusivement à cette fin par les services de l’assureur et les tiers autorisés.
                                La durée de conservation de ces données est limitée à la durée du contrat d’assurance et à la période postérieure pendant laquelle
                                leur conservation est nécessaire pour permettre à l’assureur de respecter ses obligations en fonction des délais de prescription ou
                                en application d’autres dispositions légales. 
                                Par ailleurs, la communication des informations de l’assuré/souscripteur est limitée aux communications obligatoires en fonction des obligations légales et réglementaires qui s’imposent à l’assureur et aux tiers légalement autorisés à obtenir les dites informations.
                                L’assureur garantit notamment le respect de la loi n°09-08 relative à la protection des personnes physiques à l’égard du traitement
                                des données à caractère personnel. Les données sont protégées aussi bien sur support physique qu’électronique, de telle sorte
                                que leur accès soit impossible à des tiers non autorisés.
                                L’assureur s’assure que les personnes habilitées à traiter les données personnelles connaissent leurs obligations légales en matière de protection de ces données et s’y tiennent.
                                Les données à caractère personnel peuvent à tout moment faire l’objet d’un droit d’accès, de modification, de rectification et d’opposition auprès de: RMA – DOSIQ / RSI, 83, avenue de l’Armée Royale - Casablanca – Maroc.
                                De manière expresse, l’assuré/souscripteur autorise l’assureur à utiliser ses coordonnées à des fins de prospections commerciales
                                en vue de proposer d’autres services d’assurance. Il peut s’opposer par courrier à la réception de sollicitations commerciales.
                            </p>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label>Fait à </label>....................................., le ....................................<br>
                    </td>
                </tr>
                <tr>
                    <td><strong>Signature du mandant</strong><br><strong>(Précédé de la mention "Lu et approuvé")</strong><br></td>
                    <td><strong>Signature du mandataire</strong><br><strong>(Cachet et signature)</strong><br></td>
                </tr>
			</table>
		</div>
	</body>
</html>