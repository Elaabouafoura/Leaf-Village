<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Services\IAService;
use PDF;

class ProjetReportController extends Controller
{
    protected $iaService;

    public function __construct(IAService $iaService)
    {
        $this->iaService = $iaService;
    }

    public function generate($id)
    {
$project = Projet::with(['financements', 'espacesVerts', 'evenements'])->findOrFail($id);

        // 🧠 Génération du résumé IA enrichi
        $summary = $this->iaService->summarizeProjectWithDetails($project);

        // 📈 Statistiques rapides
        $totalFinancement = $project->financements->sum('montant');
        $nbEspacesVerts = $project->espacesVerts->count();
        $nbEvenements = $project->evenements->count();

        $data = [
            'project' => $project,
            'summary' => $summary,
            'totalFinancement' => $totalFinancement,
            'nbEspacesVerts' => $nbEspacesVerts,
            'nbEvenements' => $nbEvenements,
            'date' => now()->format('d/m/Y'),
        ];

        $pdf = PDF::loadView('pdf.projet_report_full', $data)
                  ->setPaper('a4', 'portrait');
return $pdf->stream("rapport_{$project->nom}.pdf");

      //  return $pdf->download("rapport_{$project->nom}.pdf");
    }
}
