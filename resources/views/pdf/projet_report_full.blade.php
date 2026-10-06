<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $project->nom }} - Rapport</title>
    <style>
        /* Styles simplifiés pour compatibilité PDF */
        :root {
            --primary-green: #2e7d32;
            --light-green: #e8f5e9;
            --dark-green: #1b5e20;
            --accent-blue: #1976d2;
        }
        
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        
        .header {
            border-bottom: 3px solid var(--primary-green);
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        
        .logo {
            font-size: 18px;
            font-weight: bold;
            color: var(--primary-green);
            margin-bottom: 5px;
        }
        
        .project-title {
            font-size: 22px;
            color: var(--accent-blue);
            margin: 10px 0 5px 0;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            margin: 20px 0;
        }
        
        .stat-card {
            background: var(--light-green);
            padding: 15px;
            text-align: center;
            border-radius: 5px;
            border-left: 3px solid var(--primary-green);
        }
        
        .stat-value {
            font-size: 18px;
            font-weight: bold;
            color: var(--primary-green);
            margin: 5px 0;
        }
        
        .stat-label {
            font-size: 10px;
            color: #666;
            text-transform: uppercase;
        }
        
        .section {
            margin: 25px 0;
        }
        
        .section-title {
            color: var(--dark-green);
            font-size: 16px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }
        
        .detail-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-bottom: 15px;
        }
        
        .detail-item {
            background: #f9f9f9;
            padding: 10px;
            border-radius: 3px;
        }
        
        .detail-label {
            font-weight: bold;
            color: #555;
            font-size: 10px;
            text-transform: uppercase;
            margin-bottom: 3px;
        }
        
        .ai-summary {
            background: #f0f7ff;
            padding: 15px;
            border-radius: 5px;
            border-left: 3px solid var(--accent-blue);
            margin: 15px 0;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        
        th {
            background: var(--primary-green);
            color: white;
            padding: 8px 10px;
            text-align: left;
            font-weight: bold;
        }
        
        td {
            padding: 6px 10px;
            border-bottom: 1px solid #ddd;
        }
        
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .footer {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 9px;
            color: #777;
        }
        
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: bold;
        }
        
        .badge-success { background: #e8f5e9; color: var(--primary-green); }
        .badge-info { background: #e3f2fd; color: var(--accent-blue); }
        .badge-secondary { background: #f5f5f5; color: #666; }
    </style>
</head>
<body>
    <!-- En-tête -->
    <div class="header">
        <div class="logo">VILLE DURABLE</div>
        <div class="project-info">
            <h1 class="project-title">{{ $project->nom }}</h1>
            <div>Rapport généré le {{ $date }}</div>
        </div>
    </div>
    
    <!-- Cartes de statistiques -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Budget Total</div>
            <div class="stat-value">{{ number_format($project->budget, 2) }} $</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Financement Obtenu</div>
            <div class="stat-value">{{ number_format($totalFinancement, 2) }} TND</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Espaces Verts</div>
            <div class="stat-value">{{ $nbEspacesVerts }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Événements</div>
            <div class="stat-value">{{ $nbEvenements }}</div>
        </div>
    </div>
    
    <!-- Détails du projet -->
    <div class="section">
        <h2 class="section-title">Informations du Projet</h2>
        <div class="detail-grid">
            <div class="detail-item">
                <div class="detail-label">Description</div>
                <div>{{ $project->description }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Date de Début</div>
                <div>{{ $project->dateDebut ?? 'N/A' }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Date de Fin</div>
                <div>{{ $project->dateFin ?? 'N/A' }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Statut</div>
                <div>
                    @php
                        $today = now();
                        $startDate = $project->dateDebut ? \Carbon\Carbon::parse($project->dateDebut) : null;
                        $endDate = $project->dateFin ? \Carbon\Carbon::parse($project->dateFin) : null;
                    @endphp
                    
                    @if(!$startDate)
                        <span class="badge badge-info">Planifié</span>
                    @elseif($today->lt($startDate))
                        <span class="badge badge-info">À venir</span>
                    @elseif($today->between($startDate, $endDate))
                        <span class="badge badge-success">En cours</span>
                    @else
                        <span class="badge badge-secondary">Terminé</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Résumé IA -->
    <div class="section">
        <h2 class="section-title">Analyse du Projet</h2>
        <div class="ai-summary">
            <strong>Résumé Généré par Intelligence Artificielle</strong>
            <p>{{ $summary }}</p>
        </div>
    </div>
    
    <!-- Financements -->
    @if($project->financements->count())
    <div class="section">
        <h2 class="section-title">Financements</h2>
        <table>
            <thead>
                <tr>
                    <th>Source</th>
                    <th>Montant (TND)</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($project->financements as $financement)
                    <tr>
                        <td>{{ $financement->source }}</td>
                        <td style="text-align: right">{{ number_format($financement->montant, 2) }}</td>
                        <td>{{ $financement->date ?? 'N/A' }}</td>
                    </tr>
                @endforeach
                <tr style="background-color: #e8f5e9; font-weight: bold;">
                    <td>Total</td>
                    <td style="text-align: right">{{ number_format($totalFinancement, 2) }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    @endif
    
    <!-- Espaces Verts -->
    @if($project->espacesVerts->count())
    <div class="section">
        <h2 class="section-title">Espaces Verts</h2>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Type</th>
                    <th>Surface (m²)</th>
                    <th>Localisation</th>
                </tr>
            </thead>
            <tbody>
                @foreach($project->espacesVerts as $espace)
                    <tr>
                        <td>{{ $espace->nom }}</td>
                        <td>{{ $espace->type }}</td>
                        <td style="text-align: right">{{ $espace->surface }}</td>
                        <td>{{ $espace->localisation ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    
    <!-- Événements -->
    @if($project->evenements->count())
    <div class="section">
        <h2 class="section-title">Événements</h2>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Date</th>
                    <th>Lieu</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach($project->evenements as $event)
                    <tr>
                        <td>{{ $event->nom }}</td>
                        <td>{{ $event->date }}</td>
                        <td>{{ $event->lieu ?? 'N/A' }}</td>
                        <td>{{ $event->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    
    <!-- Pied de page -->
    <div class="footer">
        <p>Rapport généré automatiquement par le Système de Gestion de Projets Urbains</p>
        <p>Confidentiel - Usage interne uniquement</p>
    </div>
</body>
</html>