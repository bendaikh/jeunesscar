<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Contrat de Location</title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'DejaVu Sans', Arial, sans-serif;
        }

        
        body {
            font-size: 10px;
            line-height: 1.4;
            color: #333;
            width: 100%;
            max-width: 100%;
            margin: 5mm auto;
            padding-right:5mm ;
            padding-left: 5mm;
            background-color: #fff;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            padding-right: 10mm;
        }
        
        .header-table {
            margin-bottom: 15px;
            border-bottom: 2px solid #4a7ebb;
        }
        
        .main-table {
            border: 2px solid #4a7ebb;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .main-table td {
            border: 1px solid #4a7ebb;
            padding: 8px;
            vertical-align: top;
        }
        
        .section-title {
            background-color: #4a7ebb;
            color: white;
            font-weight: bold;
            text-align: center;
            padding: 8px;
            font-size: 11px;
            letter-spacing: 0.5px;
        }
        
        .field-row {
            margin-bottom: 8px;
            display: flex;
            align-items: baseline;
            flex-wrap: wrap;
        }
        
        .field-label {
            font-weight: bold;
            min-width: 80px;
            color: #2a5885;
        }
        
        .field-value {
            border-bottom: 1px dotted #666;
            min-width: 120px;
            flex-grow: 1;
            padding: 0 5px 2px;
            margin-left: 5px;
        }
        
        .footer {
            background-color: #2a5885;
            color: white;
            text-align: center;
            padding: 0px;
            margin-top: 0px;
            font-size: 9px;
            border-radius: 0px;
        }
        
        .page-break {
             page-break-before: always;
             padding-right: -10px;
           /* padding-top: 5mm; */
           padding-right: 10px;
        }
        
        .damage-box {
            border: 1px solid #4a7ebb;
            padding: 4px;
            width: 180px;
            background-color: #f8f9fa;
            border-radius: 4px;
        }
        
        .inner-table {
            width: 100%;
            margin: 12px 0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .inner-table th, .inner-table td {
            border: 1px solid #4a7ebb;
            padding: 6px;
            text-align: center;
        }
        
        .inner-table th {
            background-color: #e6eef7;
            font-weight: bold;
        }
        
        .checkbox-group {
            display: flex !important;
            align-content: flex-end;
            gap: 15px;
            margin-top: 8px;
        }
        
        .checkbox-item {
            display: flex;
            align-items: center;
        }
        
        .checkbox {
            width: 14px;
            height: 14px;
            border: 2px solid #4a7ebb;
            margin-right: 5px;
            border-radius: 2px;
        }
        
        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        
        .signature-box {
            width: 100px;
            height: 100px;
            text-align: center;
        }
        
        .signature-line {
            border-top: 1px solid #4a7ebb;
            padding-top: 6px;
            margin-top: 6px;
            font-weight: bold;
        }
        
        .terms-title {
            text-align: center;
            font-size: 11pt;
            /* margin: 20px 0; */
            color: #2a5885;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .terms-content {
            padding-right: 25px;
            text-align: justify;
            font-size: 7pt;
            line-height: 1.4;
        }
        
        .article-title {
            font-weight: bold;
            margin: 5px 0 4px 0;
            color: #2a5885;
            border-bottom: 1px solid #e6eef7;
            padding-bottom: 2px;
        }
        
        .terms-signature {
        width: 100%;
        border-collapse: separate;
        border-spacing: 30px 15px;
        margin-top: 10px;
    }
    .terms-signature td {
        vertical-align: top;
        text-align: center;
    }
    .signature-container {
        position: relative;
        width: 320px;
        height: 150px;
        border: 2px dashed #4CAF50;
        border-radius: 12px;
        background-color: #f9f9f9;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin: auto;
    }
    .signature-container img.logo {
        position: absolute;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        max-height: 100px;
        opacity: 1;
        pointer-events: none;
    }
    .signature-container canvas, 
    .signature-container img.signature {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 10px;
    }
    .signature-buttons {
        margin-top: 10px;
        display: flex;
        justify-content: center;
        gap: 10px;
    }
    .signature-buttons button {
        padding: 8px 10px;
        border: none;
        background-color: #4CAF50;
        color: white;
        font-size: 10px;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .signature-buttons button:hover {
        background-color: #45a049;
    }
    .signature-title {
        margin-top: 8px;
        font-size: 10px;
        font-weight: bold;
        color: #333;
    }
    @media (max-width: 700px) {
        .terms-signature {
            display: block;
        }
        .terms-signature td {
            display: block;
            margin-bottom: 30px;
        }
    }
        
        h1 {
            color: #2a5885;
            letter-spacing: 0.5px;
        }
        
        .highlight-box {
            background-color: #f8f9fa;
            border-left: 4px solid #4a7ebb;
            padding: 10px;
            margin: 15px 0;
        }
        
        .logo-container {
            padding: 5px;
            border: 1px solid #e6eef7;
            border-radius: 4px;
            background-color: white;
        }
        
        .note-box {
            font-style: italic;
            background-color: #fff8e1;
            padding: 8px;
            border-left: 3px solid #ffc107;
            margin: 10px 0;
        }


        .floating-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #4a7ebb;
            color: white;
            width: 90px;
            height: 90px;
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
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>
    <table class="header-table">
        <tr>
            <td style="width: 30%; text-align: center; vertical-align: middle;">
                <div class="logo-container">
                    <img src="{{ asset('assets/images/logo.png') }}" style="max-height: 100px; margin-bottom: 5px;">
                    <div style="font-weight: bold; color: #2a5885;">Location de voitures</div>
                </div>
            </td>
            <td style="text-align: center; vertical-align: middle;">
                <h1 style="font-size: 16px; margin-bottom: 8px; text-transform: uppercase;">CONTRAT DE LOCATION</h1>
                <div style="margin-bottom: 3px;">Contrat N°: <strong style="color: #2a5885;">{{ $contract->number }}</strong></div>
                <div>N° Dossier: <strong style="color: #2a5885;">{{ $contract->dossier_number }}</strong></div>
            </td>
            <td style="width: 30%; vertical-align: top;">
                <div class="damage-box">
                    <div style="text-align: center; font-weight: bold; margin-bottom: 5px; color: #d32f2f;">DOMMAGES IDENTIFIÉS ET ACCEPTÉS</div>
                    <div>/// Éraflure</div>
                    <div>X Bosse</div>
                    <div>O Marque</div>
                    <table style="width: 100%; margin-top: 8px;">
                        <tr>
                            <td>Nombre</td>
                            <td style="text-align: right;">Paraphe Client</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <table class="main-table">
        <tr>
            <td style="width: 50%;">
                <div class="section-title">CLIENT</div>
                <div style="padding: 12px;">
                    <div class="field-row">
                        <span class="field-label">Nom :</span>
                        <span class="field-value">{{ $client->last_name }}</span>
                    </div>
                    <div class="field-row">
                        <span class="field-label">Prénom :</span>
                        <span class="field-value">{{ $client->first_name }}</span>
                    </div>
                    <div class="field-row">
                        <span class="field-label">Adresse :</span>
                        <span class="field-value">{{ $client->address }}</span>
                    </div>
                    <div class="field-row">
                        <span class="field-label">C.I.N N° :</span>
                        <span class="field-value">{{ $client->id_number }}</span>
                    </div>
                    <div class="field-row">
                        <span class="field-label">valable Jusqu'au :</span>
                        <span class="field-value">{{ $client->id_expiry_date }}</span>
                    </div>
                    <div class="field-row">
                        <span class="field-label">N° de Permis :</span>
                        <span class="field-value">{{ $client->license_number }}</span>
                    </div>
                    <div class="field-row">
                        <span class="field-label">Délivré le :</span>
                        <span class="field-value">{{ $client->license_issue_date }}</span>
                    </div>
                    <div class="field-row">
                        <span class="field-label">N° de Passeport :</span>
                        <span class="field-value">{{ $client->passport_number }}</span>
                    </div>
                    <div class="field-row">
                        <span class="field-label">Délivré le :</span>
                        <span class="field-value">{{ $client->passport_issue_date }}</span>
                    </div>
                    <div class="field-row">
                        <span class="field-label">Tél :</span>
                        <span class="field-value">{{ $client->phone }}</span>
                    </div>
                    <div class="field-row">
                        <span class="field-label">GSM :</span>
                        <span class="field-value">{{ $client->mobile }}</span>
                    </div>
                </div>
            </td>
            <td style="width: 50%;">
                <div class="section-title">VOITURE</div>
                <div style="padding: 12px;">
                    <div class="field-row">
                        <span class="field-label">Marque :</span>
                        <span class="field-value">{{ $vehicle->brand }}</span>
                        <span class="field-label" style="margin-left: 15px;">Km Départ:</span>
                        <span class="field-value">{{ $vehicle->start_km }}</span>
                    </div>
                    <div class="field-row">
                        <span class="field-label">Matricule :</span>
                        <span class="field-value">{{ $vehicle->plate_number }}</span>
                        <span class="field-label" style="margin-left: 15px;">Carburant :</span>
                        <span class="field-value">{{ $vehicle->fuel_type }}</span>
                    </div>

                    <table class="inner-table">
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
                                <td>{{ $rental->start_date }}</td>
                                <td>{{ $rental->end_date }}</td>
                            </tr>
                            <tr>
                                <td>Heure :</td>
                                <td>{{ $rental->start_time }}</td>
                                <td>{{ $rental->end_time }}</td>
                            </tr>
                            <tr>
                                <td>Lieu :</td>
                                <td>{{ $rental->start_location }}</td>
                                <td>{{ $rental->end_location }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="field-row">
                        <span class="field-label">Durée de location :</span>
                        <span class="field-value">{{ $rental->duration }} (J)</span>
                    </div>
                    <div class="field-row">
                        <span class="field-label">à :</span>
                        <span class="field-value">{{ $rental->daily_rate }}</span>
                        <span class="field-label" style="margin-left: 15px;">x :</span>
                        <span class="field-value">{{ $rental->duration }}</span>
                        <span class="field-label" style="margin-left: 15px;">jours :=</span>
                        <span class="field-value">{{ $rental->total_amount }} DH</span>
                    </div>
                    <div class="field-row">
                        <span class="field-label">Reste :</span>
                        <span class="field-value">{{ $rental->remaining_amount }}</span>
                        <span class="field-label" style="margin-left: 15px;">Avance :</span>
                        <span class="field-value">{{ $rental->advance_payment }}</span>
                    </div>

                    <div style="margin-top: 12px;">
                        <div class="field-label">REMARQUES :</div>
                        <div style="border: 1px solid #e6eef7; min-height: 40px; padding: 5px; background-color: #f8f9fa;">{{ $rental->remarks }}</div>
                    </div>

                    <div style="margin-top: 15px; font-weight: bold; text-align: center; background-color: #e6eef7; padding: 8px; border-radius: 4px;">
                        FRANCHISE {{ $rental->franchise }} DH
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td style="width: 50%;">
                <div class="section-title">AUTRES CONDUCTEURS</div>
                <div style="padding: 12px;">
                    <div class="field-row">
                        <span class="field-label">Nom :</span>
                        <span class="field-value">{{ $additional_driver->last_name ?? '' }}</span>
                    </div>
                    <div class="field-row">
                        <span class="field-label">Prénom :</span>
                        <span class="field-value">{{ $additional_driver->first_name ?? '' }}</span>
                    </div>
                    <div class="field-row">
                        <span class="field-label">Adresse :</span>
                        <span class="field-value">{{ $additional_driver->address ?? '' }}</span>
                    </div>
                    <div class="field-row">
                        <span class="field-label">C.I.N / Passeport :</span>
                        <span class="field-value">{{ $additional_driver->id_number ?? '' }}</span>
                    </div>
                    <div class="field-row">
                        <span class="field-label">valable Jusqu'au :</span>
                        <span class="field-value">{{ $additional_driver->id_expiry_date ?? '' }}</span>
                    </div>
                    <div class="field-row">
                        <span class="field-label">N° de Permis :</span>
                        <span class="field-value">{{ $additional_driver->license_number ?? '' }}</span>
                    </div>
                    <div class="field-row">
                        <span class="field-label">Délivré le :</span>
                        <span class="field-value">{{ $additional_driver->license_issue_date ?? '' }}</span>
                    </div>
                    <div class="field-row">
                        <span class="field-label">GSM :</span>
                        <span class="field-value">{{ $additional_driver->mobile ?? '' }}</span>
                    </div>

                    <div class="note-box">
                        NB : Ce contrat n'est pas considéré comme facture
                    </div>

                    <div class="highlight-box">
                        <p>J'ai lu et accepté les conditions stipulées ci-contre au verso de ce contrat.</p>
                        <p>Le client est seul responsable des violations de la loi sur la circulation routière.</p>
                    </div>

                    {{-- <div class="signature-section">
                        <div class="signature-box">
                            <div class="signature-line">Signature client</div>
                        </div>
                        <div class="signature-box">
                            <div class="signature-line">Signature 2ème Conducteur</div>
                        </div>
                    </div> --}}
                </div>
            </td>
            <td style="width: 50%;">
                <div class="section-title">CHANGEMENT DE VÉHICULE</div>
                <div style="padding: 12px;">
                    <div class="field-row">
                        <span class="field-label">Marque :</span>
                        <span class="field-value">{{ $vehicle_change->brand ?? '' }}</span>
                        <span class="field-label" style="margin-left: 15px;">Type :</span>
                        <span class="field-value">{{ $vehicle_change->type ?? '' }}</span>
                    </div>
                    <div class="field-row">
                        <span class="field-label">Matricule :</span>
                        <span class="field-value">{{ $vehicle_change->plate_number ?? '' }}</span>
                        <span class="field-label" style="margin-left: 15px;">Carburant :</span>
                        <span class="field-value">{{ $vehicle_change->fuel_type ?? '' }}</span>
                    </div>

                    <table class="inner-table">
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
                                <td>{{ $vehicle_change->end_date ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Heure :</td>
                                <td>{{ $vehicle_change->start_time ?? '' }}</td>
                                <td>{{ $vehicle_change->end_time ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Lieu :</td>
                                <td>{{ $vehicle_change->start_location ?? '' }}</td>
                                <td>{{ $vehicle_change->end_location ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div style="margin-top: 5px;">
                        <div class="field-label">Mode de règlement :</div>
                        <table style="margin-top: 8px;">
                            <tr>
                                <td style="padding-right: 20px; display: flex; align-items: center;">
                                    <div style="width: 14px; height: 14px; border: 2px solid #4a7ebb; border-radius: 2px; margin-right: 5px; {{ $payment_method == 'cash' ? 'background-color: #4a7ebb;' : '' }}"></div>
                                    <span>Espèces</span>
                                </td>
                                <td style="padding-right: 20px; display: flex; align-items: center;">
                                    <div style="width: 14px; height: 14px; border: 2px solid #4a7ebb; border-radius: 2px; margin-right: 5px; {{ $payment_method == 'check' ? 'background-color: #4a7ebb;' : '' }}"></div>
                                    <span>Chèque</span>
                                </td>
                                <td style="padding-right: 20px; display: flex; align-items: center;">
                                    <div style="width: 14px; height: 14px; border: 2px solid #4a7ebb; border-radius: 2px; margin-right: 5px; {{ $payment_method == 'other' ? 'background-color: #4a7ebb;' : '' }}"></div>
                                    <span>Autres</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    
                    

                    {{-- <div style="margin-top: 30px;">
                        <div class="field-label">Visa de la direction :</div>
                        <div style="height: 60px; border: 1px dashed #4a7ebb; background-color: #f8f9fa;"></div>
                    </div> --}}
                </div>
            </td>
        </tr>
    </table>

    <div style="text-align: center; font-weight: bold; margin: 15px 0; padding: 8px; background-color: #fff8e1; border-left: 4px solid #ffc107;">
        En cas de dépassement du kilométrage mentionné, vous allez payer 1.5 dhs pour chaque kilomètre additionnel.
    </div>

    <div class="footer">
        <div>Av Med V Imm Benhaddou N° 466 Bureau N°5 Kénitra - Tél: 05 30 19 24 11 - GSM: 06 13 96 94 57</div>
        <div>RC : 45059 - Patente: 20168908 - IF: 1876955 - CNSS: 4844917 - ICE: 00168597000027</div>
    </div>

    <div class="page-break">
        <div class="terms-title">CONDITIONS GENERALES DE LOCATION</div>
        
        <div class="terms-content">
            <p>
                Le loueur loue au locataire pour une durée déterminée, le véhicule décrit au recto 5/7outes amendes, taris, dépenses et impôt sur
                toutes infractions à la du présent contrat aux termes et conditions stipulés ci-après. Le locataire accepte législation relative à la
                circulation ou stationnement ou autre, commises par sa signature les dits termes et conditions. Le locataire a la garde du véhicule
                par le locataire ou autre utilisateur du véhicule. pendant toute la durée de la location depuis la prise de possession du véhicule
                jusqu'à sa restitution au loueur. 6/7ous frais encourus par le loueur, y compris les honoraires d'avocat, en vue d'obtenir du locataire
                les paiements dus en vertu du présent contrat; il est précisé qu'en cas de retard dans les règlement de ces paiements le loueur
                pourra de plein droit réclamer au locataire une indemnité égale à 20% des sommes restant dues à titre de clause pénale.
                7/Les paiements sont effectués d'avance et en totalité au moment de la livraison du véhicule par Jeunesse Car.
            </p>
            
            <div class="article-title">ARTICLE PREMIER : LIVRAISON ET RESTITUTION</div>
            <p>
                1/Le locataire reconnaît que le véhicule est en état de marche et en bon état général avec tous ses accessoires et documents.
            </p>
            <p>
                2/Le locataire s'engage à restituer au loueur le véhicule avec tous ses accessoires et documents dans un état identique à celui
                dans lequel il a été livré, au lieu et date indiqués au recto du présent contrat. La location prend fin lorsque le loueur ou toute
                personne habileté par lui constale la dite restitution.
            </p>
            <p>
                3/Sauf prolongation expressément autorisée par le loueur, la non-restitution du véhicule à la date prévue pourra être considérée
                comme un abus de confiance, exposant le locataire à des poursuites judiciaires. Dans ce cas, le loueur pourra faire reprendre le
                véhicule par contrainte, par un agent du bureau des notifications et exécution judiciaires près du tribunal de première instance de
                Kénitra, avec clés, carte grise, vignette, sure ordonnance rendue sur requête par Monsieur le Président du tribunal de premier
                instance de Kénitra.
            </p>
            
            <div class="article-title">ARTICLE2 : UTILISATION DU VEHICULE</div>
            <p>
                1/Le contrat de location est personnel et n'est en aucun cas cessible.
            </p>
            <p>
                2/Les conducteurs du véhicule doivent répondre aux conditions d'âge et de permis de conduire stipulées sur les tarifs en vigueur au
                moment de la location.
            </p>
            <p>
                3/le locataire s'engage à n'utiliser le véhicule que sur des routes propres a la circulation automobile.
            </p>
            <p>
                4/Le locataire s'engage à ne pas propulser ou tirer tout véhicule quelconque ou remorque, à n'apporter aucune modification au
                véhicule, à utiliser à chaque arrêt les systèmes de fermetures et de protection et à conserver les clés et les papiers du véhicule sur
                lui.
            </p>
            <p>
                5/En cas de détérioration de pneumatique (s) pour une cause autre que l'usure normale, le locataire s'engage à le (s) réparer ou à
                le (s) remplacer immédiatement par un pneu (s) de même dimensions et caractéristiques
            </p>
            
            <div class="article-title">ARTICLE 3 : PRIX ET PAIEMENT DE LA LOCATION</div>
            <p>
                Le locataire s'engage à payer ou rembourser au loueur, sur sa demande la somme représentant :
            </p>
            <p>
                1/Les frais de temps et de kilométrage calculés aux taux indiqués au recto du présent contrat ou sur le tarif en vigueur. Le nombre
                de kilométrage parcouru sera celui indiqué par le compteur installé par le fabriquant du véhicule.
            </p>
            <p>
                2/7ous frais de carburant, de suppression de franchise, assurances personnes transportées, accidents, et tous autres frais prévus
                au recto du présent contrat ou dans le tarif en vigueur.
            </p>
            <p>
                3/Les frais encourus par le loueur pour assurer la réparation des dommages au véhicule et ne résultant pas d'une usure normale.
                Sauf négligence du locataire et à condition que les clauses des conditions générales aient été respectées, la responsabilité
                maximale du locataire est définie à l'article 4 alinéa 3 du présent contrat.
            </p>
            
            <div class="article-title">ARTICLE 4 : ASSURANCES</div>
            <p>
                Le client est assuré suivant les conditions générales des polices d'assurance contractées par la société Jeunesse Car qu'il déclare
                bien connaître:
            </p>
            <p>
                A/ Les accidents causés aux tiers sans limitation.
            </p>
            <p>
                B/ L'assurance du véhicule contre le vol, l'incendie et responsabilité civil ne sont pas compris dans cette garantie, les accessoires,
                vêtement et tout objet oublié à l'intérieur de la voiture ou du coffre.
            </p>
            <p>
                C/ Les dégâts causés à la voiture étant entendu que le client supporte la franchise mentionnée au recto du contrat de la valeur
                réelle de la voiture Ajoutant les montant de jours de mobilisation de la voiture (montant = prise de jour de la location) en cas
                d'accident grave le client supporte le réforme de la voiture jusqu'au le PV sortira de Bureau de police le client doit déclarer à la
                société Jeunesse Car dans les plus brefs délais, tout accident, vol ou incendie, sa déclaration devra mentionner les circonstances
                exactes, notamment le lieu de l'accident, la date, l'heure, les témoins (avec appui de constat d'un agent de police ou d'un gendarme).
            </p>
            <p>
                D/ Le client peut accepter ou refuser l'assurance personnes transportées aux conditions des tarifs en vigueur. En aucun cas le
                nombre des personnes transportées dans la voiture ne devra excéder celui indiqué sur la police d'assurance du véhicule sous
                peine de voir la seule responsabilité du client engagé.
            </p>
            <table class="terms-signature">
                <tr>
                    <td>
            
                        <div class="signature-container">
                            
                            <img src="{{ asset('assets/images/cashez.png') }}" 
                            style="position: absolute; top: 5px; left: 50%; transform: translateX(-50%); 
                                   max-height: 100px; opacity: 1; {{ !$hideButton ? 'display: none;' : '' }}" 
                            alt="Logo de l'entreprise">
            
                            @if (!empty($signature2))
                                <img src="{{ $signature2 }}" class="signature" alt="Signature du deuxième signataire">
                            @else
                                <canvas id="signature-pad2"></canvas>
                            @endif
                        </div>
            
                        @if (empty($signature2))
                        <div class="signature-buttons">
                            <button type="button" id="clear-signature2">Effacer</button>
                            <button type="button" id="save-signature2">Enregistrer</button>
                        </div>
                        @endif
            
                        <div class="signature-title">
                            Signature du locataire
                        </div>
            
                    </td>
            
                    <td>
            
                        <div class="signature-container">
                            @if (!empty($signature))
                                <img src="{{ $signature }}" class="signature" alt="Signature du client">
                            @else
                                <canvas id="signature-pad"></canvas>
                            @endif
                        </div>
            
                        @if (empty($signature))
                        <div class="signature-buttons">
                            <button type="button" id="clear-signature">Effacer</button>
                            <button type="button" id="save-signature">Enregistrer</button>
                        </div>
                        @endif
            
                        <div class="signature-title">
                            Signature du client
                        </div>
            
                    </td>
                </tr>
            </table>
            <div style="text-align: center; font-weight: bold; margin: 30px 0; color: #4a7ebb;">
                Nous vous remercions d'avance pour votre compréhension
            </div>
        
            <a 
                href="{{ route('contract.generatePDF') }}" 
                class="floating-button" 
                title="تحويل إلى PDF" 
                id="generate_pdf_button"
                @if($hideButton) style="display: none;" @endif
            > 
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                </svg>
            </a>
        </body>
        
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



        
        <script>
            let canvas = document.getElementById('signature-pad');
            let ctx = canvas.getContext('2d');
            let drawing = false;
        
            // Mouse Events
            canvas.addEventListener('mousedown', () => drawing = true);
            canvas.addEventListener('mouseup', () => {
                drawing = false;
                ctx.beginPath();
            });
            canvas.addEventListener('mousemove', draw);
        
            // Touch Events
            canvas.addEventListener('touchstart', (e) => {
                e.preventDefault();
                drawing = true;
                draw(e.touches[0]);
            });
        
            canvas.addEventListener('touchend', (e) => {
                e.preventDefault();
                drawing = false;
                ctx.beginPath();
            });
        
            canvas.addEventListener('touchmove', (e) => {
                e.preventDefault();
                draw(e.touches[0]);
            });
        
            function draw(e) {
                if (!drawing) return;
                ctx.lineWidth = 2;
                ctx.lineCap = 'round';
                ctx.strokeStyle = '#000';
        
                let rect = canvas.getBoundingClientRect();
                let x, y;
        
                // Differentiate between MouseEvent and TouchEvent
                if (e.clientX && e.clientY) {
                    // For mouse
                    x = e.clientX - rect.left;
                    y = e.clientY - rect.top;
                } else if (e.pageX && e.pageY) {
                    // For touch fallback
                    x = e.pageX - rect.left;
                    y = e.pageY - rect.top;
                }
        
                ctx.lineTo(x, y);
                ctx.stroke();
                ctx.beginPath();
                ctx.moveTo(x, y);
            }
        
            document.getElementById('clear-signature').addEventListener('click', function() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
            });
        
            document.getElementById('save-signature').addEventListener('click', function() {
                let dataURL = canvas.toDataURL('image/png');
                $.ajax({
                    url: '{{ route("save.signature") }}', 
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        signature: dataURL
                    },
                    success: function(response) {
                        alert('Signature enregistrée avec succès!');
                        location.reload(); // إذا أردت إعادة تحميل الصفحة لعرض الصورة مباشرة
                    },
                    error: function(error) {
                        alert('Erreur lors de l\'enregistrement de la signature.');
                    }
                });
            });
        
            // لوحة التوقيع الثانية
        let canvas2 = document.getElementById('signature-pad2');
        let ctx2 = canvas2.getContext('2d');
        let drawing2 = false;
        
        // Mouse Events للوحة الثانية
        canvas2.addEventListener('mousedown', () => drawing2 = true);
        canvas2.addEventListener('mouseup', () => {
            drawing2 = false;
            ctx2.beginPath();
        });
        canvas2.addEventListener('mousemove', draw2);
        
        // Touch Events للوحة الثانية
        canvas2.addEventListener('touchstart', (e) => {
            e.preventDefault();
            drawing2 = true;
            draw2(e.touches[0]);
        });
        
        canvas2.addEventListener('touchend', (e) => {
            e.preventDefault();
            drawing2 = false;
            ctx2.beginPath();
        });
        
        canvas2.addEventListener('touchmove', (e) => {
            e.preventDefault();
            draw2(e.touches[0]);
        });
        
        function draw2(e) {
            if (!drawing2) return;
            ctx2.lineWidth = 2;
            ctx2.lineCap = 'round';
            ctx2.strokeStyle = '#000';
        
            let rect = canvas2.getBoundingClientRect();
            let x, y;
        
            if (e.clientX && e.clientY) {
                x = e.clientX - rect.left;
                y = e.clientY - rect.top;
            } else if (e.pageX && e.pageY) {
                x = e.pageX - rect.left;
                y = e.pageY - rect.top;
            }
        
            ctx2.lineTo(x, y);
            ctx2.stroke();
            ctx2.beginPath();
            ctx2.moveTo(x, y);
        }
        
        document.getElementById('clear-signature2').addEventListener('click', function() {
            ctx2.clearRect(0, 0, canvas2.width, canvas2.height);
        });
        
        document.getElementById('save-signature2').addEventListener('click', function() {
            let dataURL = canvas2.toDataURL('image/png');
            $.ajax({
                url: '{{ route("save.signature2") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    signature: dataURL
                },
                success: function(response) {
                    alert('Signature 2 enregistrée avec succès!');
                    location.reload();
                },
                error: function(error) {
                    alert('Erreur lors de l\'enregistrement de la signature 2.');
                }
            });
        });
        </script>
        
        </html>