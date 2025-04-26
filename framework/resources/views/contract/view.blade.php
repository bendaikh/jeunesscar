  
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <title>Contrat de Location - Jeunesse Car</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.3;
            color: #000;
            margin: 0;
            padding: 20px;
        }
        .container {
            margin: 0 auto;
            border: 1px solid #fff;
            display: flex;
            flex-direction: column;
        }

        
        .header,
        .main-content,
        .blue-footer {
          padding: 1rem;
          border-bottom: 1px solid #ccc;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

         .note {
            text-align: center;
            margin-top: 10px;
            font-weight: bold;

        }
        .gauge {
            width: 50px;
            height: auto;
        }
        .logo-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .logo {
            max-width: 250px;
        }
        .logo-text {
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 5px;
        }
        .title-container {
            text-align: center;
            margin-bottom: 10px;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
        }
        .subtitle {
            font-size: 14px;
            margin: 5px 0;
        }
        .damage-diagram {
            border: 1px solid #000;
            padding: 5px;
            width: 200px;
        }
        .damage-title {
            text-align: center;
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .damage-items {
            display: flex;
            flex-direction: column;
        }
        .damage-item {
            display: flex;
            align-items: center;
            margin-bottom: 3px;
        }
        .damage-icon {
            width: 15px;
            margin-right: 5px;
        }
        .car-diagram {
            width: 100%;
            height: auto;
        }
        .main-content {
            border: 2px solid #4a7ebb;
            margin-bottom: 10px;
        }
        .section-row {
            display: flex;
            width: 100%;
        }
        .section {
            border: 1px solid #4a7ebb;
            padding: 5px;
        }
        .section-title {
            background-color: #e6eef7;
            color: #000;
            text-align: center;
            font-weight: bold;
            padding: 5px;
            border-bottom: 1px solid #4a7ebb;
        }
        .section-content {
            padding: 5px;
        }
        .client-section, .vehicle-section {
            width: 50%;
        }
        .field-row {
            display: flex;
            margin-bottom: 5px;
        }
        .field-label {
            font-weight: bold;
            margin-right: 5px;
            min-width: 100px;
        }
        .field-value {
            flex: 1;
            border-bottom: 1px dotted #000;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #4a7ebb;
            padding: 5px;
            text-align: center;
        }
        .table th {
            background-color: #e6eef7;
        }
        .checkbox-group {
            display: flex;
            gap: 10px;
            margin-top: 5px;
        }
        .checkbox-item {
            display: flex;
            align-items: center;
        }
        .checkbox {
            width: 12px;
            height: 12px;
            border: 1px solid #000;
            margin-right: 5px;
        }
        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .signature-box {
            width: 45%;
            text-align: center;
        }
        .signature-line {
            border-top: 1px solid #000;
            margin-top: 30px;
            padding-top: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 10px;
            font-style: italic;
        }
        .company-stamp {
            color: #4a7ebb;
            font-weight: bold;
            font-style: italic;
            text-align: center;
            margin-top: 10px;
        }

         .page-break {
            page-break-before: always;
        }
        .terms-title {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 15px;
            margin-top: 15px;
        }
        .terms-content {
            text-align: justify;
            font-size: 11px;
        }
        .article-title {
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 5px;
        }
        .terms-signature-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .terms-signature-table td {
            border: 1px solid #000;
            padding: 10px;
            width: 50%;
            vertical-align: bottom;
            text-align: center;
        }

        
        .thanks-note {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }
       
        .blue-footer {
            background-color: #0000CC;
            color: white;
            text-align: center;
            padding: 10px 15px;
            margin-top: 15px;
            margin-bottom: 15px;
            font-size: 11px;
            line-height: 1.4;
            position: relative;
        }

        .address-line {
            margin-bottom: 3px;
        }

        .registration-line {
            font-size: 10px;
        }

        .floating-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #4a7ebb;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            transition: all 0.3s;
        }
        .floating-button:hover {
            background-color: #3a6ea5;
            transform: scale(1.1);
        }
        .floating-button svg {
            width: 24px;
            height: 24px;
        }
    </style>
</head>


<body>
    <div class="container">
        <!-- Header with Logo -->
        <div class="header">
            <div class="logo-container">
                <img src="{{ asset('images/jeunesse-car-logo.png') }}" alt="Jeunesse Car" class="logo">
                <div class="logo-text">Location de voitures</div>
            </div>
            
            <div class="title-container">
                <h1 class="title">CONTRAT DE LOCATION</h1>
                <p class="subtitle">Contrat N°: <strong>{{ $contract->number ?? 'N00000395' }}</strong></p>
                <p class="subtitle">N° Dossier: <strong>{{ $contract->dossier_number ?? '' }}</strong></p>
            </div>
            
            <div class="damage-diagram">
                <div class="damage-title">DOMMAGES IDENTIFIÉS ET ACCEPTÉS</div>
                <div class="damage-items">
                    <div class="damage-item">
                        <div class="damage-icon">///</div>
                        <span>Éraflure</span>
                    </div>
                    <div class="damage-item">
                        <div class="damage-icon">X</div>
                        <span>Bosse</span>
                    </div>
                    <div class="damage-item">
                        <div class="damage-icon">O</div>
                        <span>Marque</span>
                    </div>
                </div>
                <div style="display: flex; justify-content: space-between; margin-top: 5px;margin-bottom: 15px;">
                    <div>Nombre</div>
                    <div>Paraphe Client</div>
                </div>
                {{-- <img src="{{ asset('images/car-diagram.png') }}" alt="Car Diagram" class="car-diagram">
                <div style="display: flex; justify-content: space-between; margin-top: 5px;">
                    <div>AV</div>
                    <div>AR</div>
                </div>
                <img src="{{ asset('images/fuel-gauge.png') }}" alt="Fuel Gauge" class="gauge"> --}}
            </div>
            </div>

             <!-- Main Content -->
        <div class="main-content">
            <div class="section-row">
                <!-- Client Section -->
                <div class="section client-section">
                    <div class="section-title">CLIENT :</div>
                    <div class="section-content">
                        <div class="field-row">
                            <div class="field-label">Nom :</div>
                            <div class="field-value">{{ $client->last_name ?? '' }}</div>
                        </div>
                        <div class="field-row">
                            <div class="field-label">Prénom :</div>
                            <div class="field-value">{{ $client->first_name ?? '' }}</div>
                        </div>
                        <div class="field-row">
                            <div class="field-label">Adresse :</div>
                            <div class="field-value">{{ $client->address ?? '' }}</div>
                        </div>
                        <div class="field-row">
                            <div class="field-label">C.I.N N° :</div>
                            <div class="field-value">{{ $client->id_number ?? '' }}</div>
                        </div>
                        <div class="field-row">
                            <div class="field-label">valable Jusqu'au</div>
                            <div class="field-value">{{ $client->id_expiry_date ?? '' }}</div>
                        </div>
                        <div class="field-row">
                            <div class="field-label">N° de Permis :</div>
                            <div class="field-value">{{ $client->license_number ?? '' }}</div>
                        </div>
                        <div class="field-row">
                            <div class="field-label">Délivré le :</div>
                            <div class="field-value">{{ $client->license_issue_date ?? '' }}</div>
                        </div>
                        <div class="field-row">
                            <div class="field-label">N° de Passeport</div>
                            <div class="field-value">{{ $client->passport_number ?? '' }}</div>
                        </div>
                        <div class="field-row">
                            <div class="field-label">Délivré le :</div>
                            <div class="field-value">{{ $client->passport_issue_date ?? '' }}</div>
                        </div>
                        <div class="field-row">
                            <div class="field-label">Tél :</div>
                            <div class="field-value">{{ $client->phone ?? '' }}</div>
                        </div>
                        <div class="field-row">
                            <div class="field-label">GSM :</div>
                            <div class="field-value">{{ $client->mobile ?? '' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Vehicle Section -->
                <div class="section vehicle-section">
                    <div class="section-title">VOITURE :</div>
                    <div class="section-content">
                        <div class="field-row">
                            <div class="field-label">Marque :</div>
                            <div class="field-value">{{ $vehicle->brand ?? '' }}</div>
                            <div class="field-label" style="margin-left: 10px;">Km Départ:</div>
                            <div class="field-value">{{ $vehicle->start_km ?? '' }}</div>
                        </div>
                        <div class="field-row">
                            <div class="field-label">Matricule</div>
                            <div class="field-value">{{ $vehicle->plate_number ?? '' }}</div>
                            <div class="field-label" style="margin-left: 10px;">Carburant :</div>
                            <div class="field-value">{{ $vehicle->fuel_type ?? '' }}</div>
                        </div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Départ</th>
                                    <th>Retour</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Date :</td>
                                    <td>{{ $rental->start_date ?? '' }}</td>
                                    <td>{{ $rental->end_date ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Heure :</td>
                                    <td>{{ $rental->start_time ?? '' }}</td>
                                    <td>{{ $rental->end_time ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Lieu :</td>
                                    <td>{{ $rental->start_location ?? '' }}</td>
                                    <td>{{ $rental->end_location ?? '' }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="field-row" style="margin-top: 10px;">
                            <div class="field-label">Durée de location :</div>
                            <div class="field-value">{{ $rental->duration ?? '' }} (J)</div>
                        </div>
                        <div class="field-row">
                            <div class="field-label">à :</div>
                            <div class="field-value">{{ $rental->daily_rate ?? '' }}</div>
                            <div class="field-label" style="margin-left: 10px;">x</div>
                            <div class="field-value">{{ $rental->duration ?? '' }}</div>
                            <div class="field-label" style="margin-left: 10px;">jours =</div>
                            <div class="field-value">{{ $rental->total_amount ?? '' }} DH</div>
                        </div>
                        <div class="field-row">
                            <div class="field-label">Reste :</div>
                            <div class="field-value">{{ $rental->remaining_amount ?? '' }}</div>
                            <div class="field-label" style="margin-left: 10px;">Avance</div>
                            <div class="field-value">{{ $rental->advance_payment ?? '' }}</div>
                        </div>

                        <div style="margin-top: 10px;">
                            <div class="field-label">REMARQUES :</div>
                            <div class="field-value" style="height: 20px;">{{ $rental->remarks ?? '' }}</div>
                        </div>

                        <div style="margin-top: 10px; font-weight: bold; text-align: center;">
                            FRANCHISE {{ $rental->franchise ?? '' }} DH
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-row">
                <!-- Other Drivers Section -->
                <div class="section client-section">
                    <div class="section-title">AUTRES CONDUCTEURS :</div>
                    <div class="section-content">
                        <div class="field-row">
                            <div class="field-label">Nom :</div>
                            <div class="field-value">{{ $additional_driver->last_name ?? '' }}</div>
                        </div>
                        <div class="field-row">
                            <div class="field-label">Prénom :</div>
                            <div class="field-value">{{ $additional_driver->first_name ?? '' }}</div>
                        </div>
                        <div class="field-row">
                            <div class="field-label">Adresse :</div>
                            <div class="field-value">{{ $additional_driver->address ?? '' }}</div>
                        </div>
                        <div class="field-row">
                            <div class="field-label">C.I.N / Passeport</div>
                            <div class="field-value">{{ $additional_driver->id_number ?? '' }}</div>
                        </div>
                        <div class="field-row">
                            <div class="field-label">valable Jusqu'au</div>
                            <div class="field-value">{{ $additional_driver->id_expiry_date ?? '' }}</div>
                        </div>
                        <div class="field-row">
                            <div class="field-label">N° de Permis :</div>
                            <div class="field-value">{{ $additional_driver->license_number ?? '' }}</div>
                        </div>
                        <div class="field-row">
                            <div class="field-label">Délivré le</div>
                            <div class="field-value">{{ $additional_driver->license_issue_date ?? '' }}</div>
                        </div>
                        <div class="field-row">
                            <div class="field-label">GSM :</div>
                            <div class="field-value">{{ $additional_driver->mobile ?? '' }}</div>
                        </div>

                        <div style="margin-top: 10px; font-style: italic; font-weight: bold; text-align: center; border-top: 1px solid #4a7ebb; padding-top: 5px;">
                            NB : Ce contrat n'est pas considéré comme facture
                        </div>

                        <div style="margin-top: 10px;">
                            <p>J'ai lu et accepté les conditions stipulées ci-contre au verso de ce contrat.</p>
                            <p>Le client est seul responsable des violations de la loi sur la circulation routière.</p>
                        </div>

                        <div class="signature-section">
                            <div class="signature-box">
                                <div class="signature-line">Signature client</div>
                            </div>
                            <div class="signature-box">
                                <div class="signature-line">Signature 2ème Conducteur</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vehicle Change Section -->
                <div class="section vehicle-section">
                    <div class="section-title">CHANGEMENT DE VÉHICULE :</div>
                    <div class="section-content">
                        <div class="field-row">
                            <div class="field-label">Marque :</div>
                            <div class="field-value">{{ $vehicle_change->brand ?? '' }}</div>
                            <div class="field-label" style="margin-left: 10px;">Type :</div>
                            <div class="field-value">{{ $vehicle_change->type ?? '' }}</div>
                        </div>
                        <div class="field-row">
                            <div class="field-label">Matricule</div>
                            <div class="field-value">{{ $vehicle_change->plate_number ?? '' }}</div>
                            <div class="field-label" style="margin-left: 10px;">Carburant :</div>
                            <div class="field-value">{{ $vehicle_change->fuel_type ?? '' }}</div>
                        </div>

                        <table class="table" style="margin-top: 10px;">
                            <thead>
                                <tr>
                                  <th></th>
                                    <th>Agence Départ</th>
                                    <th>Agence Retour</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Date :</td>

                                    <td>{{ $vehicle_change->start_date ?? '' }}</td>
                                    <td> {{ $vehicle_change->end_date ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Heure :</td>
                                    <td>{{ $vehicle_change->start_time ?? '' }}</td>
                                    <td> {{ $vehicle_change->end_time ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td>Lieu :</td>
                                    <td>{{ $vehicle_change->start_location ?? '' }}</td>
                                    <td>{{ $vehicle_change->end_location ?? '' }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <div style="margin-top: 10px;">
                            <div class="field-label">Mode de règlement :</div>
                            <div class="checkbox-group">
                                <div class="checkbox-item">
                                    <div class="checkbox" style="{{ $payment_method == 'cash' ? 'background-color: #000;' : '' }}"></div>
                                    <span>Espèces</span>
                                </div>
                                <div class="checkbox-item">
                                    <div class="checkbox" style="{{ $payment_method == 'check' ? 'background-color: #000;' : '' }}"></div>
                                    <span>Chèque</span>
                                </div>
                                <div class="checkbox-item">
                                    <div class="checkbox" style="{{ $payment_method == 'other' ? 'background-color: #000;' : '' }}"></div>
                                    <span>Autres</span>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 20px;">
                            <div class="field-label">Visa de la direction :</div>
                            <!-- <div class="company-stamp">
                                Jeunesse Car<br>
                                LOCATION DE VOITURES<br>
                                Tél : 05 37 36 94 57/06 78 85 97 53<br>
                                Av. Med Imm. Benhaddou N° 466<br>
                                Bureau N°5 - Kénitra
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Note -->
        <div class="note">
            En cas de dépassement du kilométrage mentionné, vous allez payer 1.5 dhs pour chaque kilomètre additionnel.
        </div>

         <!-- Blue Footer Banner -->
        <div class="blue-footer">
            <div class="address-line">Av Med V Imm Benhaddou N° 466 Bureau N°5 Kénitra - Tél: 05 30 19 24 11 - GSM: 06 13 96 94 57</div>
            <div class="registration-line">RC : 45059 - Patente: 20168908 - IF: 1876955 - CNSS: 4844917 - ICE: 00169597000027</div>
        </div>
</div>

   <!-- Terms and Conditions Page -->
    <div class="page-break"></div>
    <div class="container">
        <div class="terms-title">CONDITIONS GENERALES DE LOCATION</div>
        
        <div class="terms-content">
            <p>
                Le loueur loue au locataire pour une durée déterminée, le véhicule décrit au recto 5/Toutes amendes, taris, dépenses et impôt sur toutes infractions à la
                du présent contrat aux termes et conditions stipulés ci-après. Le locataire accepte législation relative à la circulation ou stationnement ou autre, commises
                par sa signature les dits termes et conditions. Le locataire a la garde du véhicule par le locataire ou autre utilisateur du véhicule.
                pendant toute la durée de la location depuis la prise de possession du véhicule 
                jusqu'à sa restitution au loueur. 6/Tous frais encourus par le loueur, y compris les honoraires d'avocat, en
                vue d'obtenir du locataire les paiements dus en vertu du présent contrat; il
                est précisé qu'en cas de retard dans les règlement de ces paiements le
                loueur pourra de plein droit réclamer au locataire une indemnité égale à
                20% des sommes restant dues à titre de clause pénale.
            </p>
            <p>
                7/Les paiements sont effectués d'avance et en totalité au moment de la
                livraison du véhicule par Jeunesse Car.
            </p>
            
            <div class="article-title">ARTICLE PREMIER : LIVRAISON ET RESTITUTION</div>
            <p>
                1/Le locataire reconnait que le véhicule est en état de marche et en bon état
                général avec tous ses accessoires et documents.
            </p>
            <p>
                2/Le locataire s'engage à restituer au loueur le véhicule avec tous ses accessoires
                et documents dans un état identique à celui dans lequel il a été livré, au lieu et
                date indiqués au recto du présent contrat. La location prend fin lorsque le loueur
                ou toute personne habileté par lui constale la dite restitution.
            </p>
            <p>
                3/Sauf prolongation expressément autorisée par le loueur, la non-restitution du
                véhicule à la date prévue pourra être considérée comme un abus de confiance,
                exposant le locataire à des poursuites judiciaires. Dans ce cas, le loueur pourra
                faire reprendre le véhicule par contrainte, par un agent du bureau des
                notifications et exécution judiciaires près du tribunal de première instance de
                Kénitra, avec clés, carte grise, vignette, sure ordonnance rendue sur requête
                par Monsieur le Président du tribunal de premier instance de Kénitra.
            </p>
            
            <div class="article-title">ARTICLE2 : UTILISATION DU VEHICULE</div>
            <p>
                1/Le contrat de location est personnel et n'est en aucun cas cessible.
            </p>
            <p>
                2/Les conducteurs du véhicule doivent répondre aux conditions d'âge et de
                permis de conduire stipulées sur les tarifs en vigueur au moment de la location.
            </p>
            <p>
                3/le locataire s'engage à n'utiliser le véhicule que sur des routes propres a la
                circulation automobile.
            </p>
            <p>
                4/Le locataire s'engage à ne pas propulser ou tirer tout véhicule quelconque ou
                remorque, à n'apporter aucune modification au véhicule, à utiliser à chaque arrêt
                les systèmes de fermetures et de protection et à conserver les clés et les papiers
                du véhicule sur lui.
            </p>
            <p>
                5/En cas de détérioration de pneumatique (s) pour une cause autre que l'usure
                normale, le locataire s'engage à le (s) réparer ou à le (s) remplacer
                immédiatement par un pneu (s) de même dimensions et caractéristiques
            </p>
            
            <div class="article-title">ARTICLE 3 : PRIX ET PAIEMENT DE LA LOCATION</div>
            <p>
                Le locataire s'engage à payer ou rembourser au loueur, sur sa demande la
                somme représentant :
            </p>
            <p>
                1/Les frais de temps et de kilométrage calculés aux taux indiqués au recto
                du présent contrat ou sur le tarif en vigueur. Le nombre de kilométrage
                parcouru sera celui indiqué par le compteur installé par le fabriquant du
                véhicule.
            </p>
            <p>
                2/Tous frais de carburant, de suppression de franchise, assurances personnes
                transportées, accidents, et tous autres frais prévus au recto du présent contrat ou
                dans le tarif en vigueur.
            </p>
            <p>
                3/Les frais encourus par le loueur pour assurer la réparation des dommages au
                véhicule et ne résultant pas d'une usure normale. Sauf négligence du locataire et à
                condition que les clauses des conditions générales aient été respectées, la
                responsabilité maximale du locataire est définie à l'article 4 alinéa 3 du présent
                contrat.
            </p>
            
            <div class="article-title">ARTICLE 4 : ASSURANCES</div>
            <p>
                Le client est assuré suivant les conditions générales des polices
                d'assurance contractées par la société Jeunesse Car qu'il déclare bien
                connaître:
            </p>
            <p>
                A/ Les accidents causés aux tiers sans limitation.
            </p>
            <p>
                B/ L'assurance du véhicule contre le vol, l'incendie et responsabilité civil
                ne sont pas compris dans cette garantie, les accessoires, vêtement et tout
                objet oublié à l'intérieur de la voiture ou du coffre.
            </p>
            <p>
                C/ Les dégâts causés à la voiture étant entendu que le client supporte la
                franchise mentionnée au recto du contrat de la valeur réelle de la voiture
                Ajoutant les montant de jours de mobilisation de la voiture (montant =
                prise de jour de la location) en cas d'accident grave le client supporte le
                réforme de la voiture jusqu'au le PV sortira de Bureau de police le client
                doit déclarer à la société Jeunesse Car dans les plus brefs délais, tout
                accident, vol ou incendie, sa déclaration devra mentionner les
                circonstances exactes, notament le lieu de l'accident, la date, l'heure, les
                témoins (avec appui de constat d'un agent de police ou d'un gendarme).
            </p>
            <p>
                D/ Le client peut accepter ou refuser l'assurance personnes transportées
                aux conditions des tarifs en vigueur. En aucun cas le nombre des
                personnes transportées dans la voiture ne devra excéder celui indiqué sur
                la police d'assurance du véhicule sous peine de voir la seule responsabilité
                du client engagé.
            </p>
            
            <table class="terms-signature-table">
                <tr style="height: 30px;" 
                >
                  <td>Signature et cachet</td>
                  <td>Signature du client</td>
                </tr>

                <tr style="height: 80px;" >
                    <td style="vertical-align: bottom; text-align: center;">
                        {{-- <img src="{{ asset('images/jeunesse-car-stamp.png') }}" alt="Jeunesse Car Stamp" style="max-width: 150px; margin-bottom: 10px;"> --}}
                    </td>
                    <td></td>
                </tr>
            </table>
            
            <div class="thanks-note">
                Nous vous remercions d'avance pour votre compréhension
            </div>
        </div>
    </div>

    <a href="{{ route('contract.generatePDF') }}" class="floating-button" title="تحويل إلى PDF">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
        </svg>
    </a>
</body>
</html>