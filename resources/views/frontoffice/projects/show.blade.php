@extends('layouts.user')

@section('title', $project->nom . ' - Green Spaces')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/30 py-8">
    <div class="container mx-auto px-4 max-w-6xl">
        <!-- Back Button -->
        <div class="mb-8" data-aos="fade-down">
            <a href="{{ route('projects.front.index') }}" 
               class="inline-flex items-center gap-3 px-6 py-3 bg-white/80 backdrop-blur-sm border border-slate-200 hover:border-green-300 text-slate-700 rounded-2xl transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5 group">
                <svg class="w-5 h-5 transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span class="font-semibold">Back to Projects</span>
            </a>
        </div>

        <!-- Project Header -->
        <div class="text-center mb-12" data-aos="fade-up">
            @php
                $now = now();
                $start = $project->dateDebut ? \Carbon\Carbon::parse($project->dateDebut) : null;
                $end = $project->dateFin ? \Carbon\Carbon::parse($project->dateFin) : null;
                
                if (!$start) {
                    $status = 'Planned';
                    $statusColor = 'bg-blue-100 text-blue-700 border-blue-200';
                    $dotColor = 'bg-blue-500';
                } elseif ($now->lt($start)) {
                    $status = 'Upcoming';
                    $statusColor = 'bg-purple-100 text-purple-700 border-purple-200';
                    $dotColor = 'bg-purple-500';
                } elseif ($end && $now->gt($end)) {
                    $status = 'Completed';
                    $statusColor = 'bg-green-100 text-green-700 border-green-200';
                    $dotColor = 'bg-green-500';
                } else {
                    $status = 'In Progress';
                    $statusColor = 'bg-orange-100 text-orange-700 border-orange-200';
                    $dotColor = 'bg-orange-500';
                }
            @endphp
            
            <div class="inline-flex items-center gap-2 px-4 py-2 {{ $statusColor }} backdrop-blur-sm rounded-full text-sm font-semibold border mb-6">
                <div class="w-2 h-2 rounded-full {{ $dotColor }} animate-pulse"></div>
                {{ $status }}
            </div>

            <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                {{ $project->nom }}
            </h1>
            
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                {{ $project->description ?? 'No description available.' }}
            </p>
        </div>

        <!-- Project Details Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
            <!-- Main Info Card -->
            <div class="lg:col-span-2" data-aos="fade-right">
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-slate-200/50 shadow-sm hover:shadow-xl transition-all duration-500">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <div class="w-2 h-8 bg-gradient-to-b from-green-500 to-emerald-600 rounded-full"></div>
                        Project Overview
                    </h2>
                    
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Timeline -->
                            <div class="group p-4 bg-slate-50/50 rounded-2xl border border-slate-100 hover:border-green-200 transition-all duration-300">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <span class="text-gray-700 font-semibold">Timeline</span>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-500 text-sm">Start Date</span>
                                        <span class="text-gray-900 font-medium">{{ $project->dateDebut ? \Carbon\Carbon::parse($project->dateDebut)->format('d M Y') : 'TBD' }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-500 text-sm">End Date</span>
                                        <span class="text-gray-900 font-medium">{{ $project->dateFin ? \Carbon\Carbon::parse($project->dateFin)->format('d M Y') : 'Ongoing' }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Budget -->
                            <div class="group p-4 bg-slate-50/50 rounded-2xl border border-slate-100 hover:border-green-200 transition-all duration-300">
                                <div class="flex items-center gap-3 mb-3">
                                    <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                        </svg>
                                    </div>
                                    <span class="text-gray-700 font-semibold">Budget</span>
                                </div>
                                <div class="text-center">
                                    <span class="text-2xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">
                                        {{ $project->budget ? number_format($project->budget, 0, ',', ' ') . ' €' : 'Not specified' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        @if($project->dateDebut && $project->dateFin)
                        <div class="pt-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-700 font-medium">Project Progress</span>
                                <span class="text-sm text-gray-500">
                                    @php
                                        $startDate = \Carbon\Carbon::parse($project->dateDebut);
                                        $endDate = \Carbon\Carbon::parse($project->dateFin);
                                        $totalDays = $startDate->diffInDays($endDate);
                                        $daysPassed = $startDate->diffInDays(min($now, $endDate));
                                        $progress = $totalDays > 0 ? min(100, max(0, ($daysPassed / $totalDays) * 100)) : 0;
                                    @endphp
                                    {{ number_format($progress, 1) }}%
                                </span>
                            </div>
                            <div class="w-full bg-slate-200 rounded-full h-3">
                                <div class="bg-gradient-to-r from-green-500 to-emerald-600 h-3 rounded-full transition-all duration-1000 ease-out" 
                                     style="width: {{ $progress }}%"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6" data-aos="fade-left" data-aos-delay="200">
                <!-- Project Stats -->
                <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-6 border border-slate-200/50 shadow-sm">
                    <h3 class="font-semibold text-gray-900 mb-4">Project Details</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between py-2 border-b border-slate-100">
                            <span class="text-gray-600">Status</span>
                            <span class="font-semibold {{ $statusColor }} px-3 py-1 rounded-full text-sm">{{ $status }}</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-slate-100">
                            <span class="text-gray-600">Duration</span>
                            <span class="font-semibold text-gray-900">
                                @if($project->dateDebut && $project->dateFin)
                                    {{ \Carbon\Carbon::parse($project->dateDebut)->diffInDays(\Carbon\Carbon::parse($project->dateFin)) }} days
                                @else
                                    N/A
                                @endif
                            </span>
                        </div>
                       
                    </div>
                </div>

                <!-- Action Card -->
                <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-3xl p-6 text-white shadow-lg">
                    <h3 class="font-bold text-lg mb-3">Get Involved</h3>
                    <p class="text-green-100 text-sm mb-4">Interested in this project? Contact us for more information.</p>
                    <button class="w-full bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105 border border-white/20">
                        Contact Team
                    </button>
                </div>
            </div>
        </div>
<!-- Associated Green Spaces Section -->@if(isset($project->espacesVerts) && $project->espacesVerts->isNotEmpty())
<div class="bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-slate-200/50 shadow-sm mb-12" data-aos="fade-up">
    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
        <div class="w-2 h-8 bg-gradient-to-b from-green-500 to-emerald-600 rounded-full"></div>
        Associated Green Spaces
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
       @foreach($project->espacesVerts as $espace)
    <div class="group bg-slate-50/70 border border-slate-100 hover:border-green-200 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2C9.243 2 7 4.243 7 7c0 2.323 1.575 4.272 3.715 4.86A6.003 6.003 0 016 17h12a6.003 6.003 0 01-4.715-5.14C15.425 11.272 17 9.323 17 7c0-2.757-2.243-5-5-5z" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-900">{{ $espace->nom }}</h3>
                <p class="text-gray-500 text-sm flex items-center gap-1">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.866-3 7-3 7s3 3.134 3 7c0-3.866 3-7 3-7s-3-3.134-3-7z" />
                    </svg>
                    {{ $espace->localisation ?? 'No location specified' }}
                </p>
            </div>
        </div>

        <!-- Description -->
        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
            {{ $espace->description ?? 'No description available.' }}
        </p>

        <!-- Additional Details -->
        <div class="text-sm text-gray-700 space-y-2 mb-4">
            <div class="flex justify-between border-b border-slate-100 pb-1">
                <span class="text-gray-500">Type:</span>
                <span class="font-semibold text-gray-900">{{ $espace->type ?? 'N/A' }}</span>
            </div>
            <div class="flex justify-between border-b border-slate-100 pb-1">
                <span class="text-gray-500">Surface area:</span>
                <span class="font-semibold text-gray-900">
                    {{ $espace->surface ? number_format($espace->surface, 2, ',', ' ') . ' m²' : 'N/A' }}
                </span>
            </div>
            <div class="flex justify-between border-b border-slate-100 pb-1">
                <span class="text-gray-500">Location:</span>
                <span class="font-semibold text-gray-900">{{ $espace->localisation ?? 'Not specified' }}</span>
            </div>
            <!-- Eco Score & Justification -->
            <div class="flex justify-between border-b border-slate-100 pb-1">
                <span class="text-gray-500">Eco Score:</span>
                <span class="font-semibold text-gray-900">
                    {{ $espace->eco_score !== null ? $espace->eco_score . '%' : 'Not generated' }}
                </span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Justification:</span>
                <span class="font-semibold text-gray-900">
                    {{ $espace->eco_justification ?? 'Not generated' }}
                </span>
            </div>
        </div>

        <!-- Decorative footer -->
        <div class="inline-flex items-center gap-2 text-green-700 font-semibold">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            Part of this project
        </div>
    </div>
@endforeach

    </div>
</div>
@else
<div class="bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-slate-200/50 shadow-sm mb-12 text-center" data-aos="fade-up">
    <div class="w-20 h-20 mx-auto mb-4 bg-slate-100 rounded-2xl flex items-center justify-center">
        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M4 11h16M4 15h16M4 19h16"/>
        </svg>
    </div>
    <p class="text-gray-600 text-lg">No green spaces associated with this project yet.</p>
</div>
@endif

        <!-- Additional Content Placeholder -->
        <!-- Associated Activities Section -->
@if(isset($project->activites) && $project->activites->isNotEmpty())
<div class="bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-slate-200/50 shadow-sm mb-12" data-aos="fade-up">
    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
        <div class="w-2 h-8 bg-gradient-to-b from-green-500 to-emerald-600 rounded-full"></div>
        Associated Activities
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($project->activites as $activity)
        <div class="group bg-slate-50/70 border border-slate-100 hover:border-green-200 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
            <div class="flex items-center gap-4 mb-4">
                <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4 -4m6 2a9 9 0 1 1 -18 0a9 9 0 0 1 18 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ $activity->nom }}</h3>
                    <p class="text-gray-500 text-sm flex items-center gap-1">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                        </svg>
                        {{ $activity->date ? \Carbon\Carbon::parse($activity->date)->format('d M Y') : 'No date specified' }}
                    </p>
                </div>
            </div>

            <!-- Description -->
            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                {{ $activity->description ?? 'No description available.' }}
            </p>

            <!-- Details -->
            <div class="text-sm text-gray-700 space-y-2 mb-4">
                <div class="flex justify-between border-b border-slate-100 pb-1">
                    <span class="text-gray-500">Members:</span>
                    <span class="font-semibold text-gray-900">
                        @if($activity->members->isNotEmpty())
                            {{ $activity->members->pluck('nom')->join(', ') }}
                        @else
                            {{ '— Aucun membre assigné —' }}
                        @endif
                    </span>
                </div>
                <div class="flex justify-between border-b border-slate-100 pb-1">
                    <span class="text-gray-500">Budget:</span>
                    <span class="font-semibold text-gray-900">
                        {{ $activity->budget ? number_format($activity->budget, 0, ',', ' ') . ' €' : 'Not specified' }}
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Status:</span>
                    <span class="font-semibold text-gray-900">
                        {{ $activity->status ?? 'Pending' }}
                    </span>
                </div>
            </div>

                            <!-- Feedback Button -->
                <div class="mt-3 inline-flex items-center gap-2 text-green-700 font-semibold cursor-pointer hover:underline"
                     onclick="openPopup({{ $activity->idActivite }})">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    Participate 
                </div>
        </div>
        <!-- Popup -->
        <div id="popup-{{ $activity->idActivite }}" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white rounded-lg p-6 w-96 text-center">
                <h2 class="text-lg font-semibold mb-4">Es-tu sûr de vouloir participer à cette activité ?</h2>
                <div class="flex justify-center gap-4">
                    <!-- Bouton Confirmer -->
                    <form action="{{ route('activite.participate', $activity->idActivite) }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="px-4 py-2 rounded-lg bg-green-600 text-white hover:bg-green-700 transition-colors">
                            Confirmer
                        </button>
                    </form>
                    <!-- Bouton Annuler -->
                    <button onclick="closePopup({{ $activity->idActivite }})"
                            class="px-4 py-2 rounded-lg bg-gray-400 text-white hover:bg-gray-500 transition-colors">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@else
<div class="bg-white/80 backdrop-blur-sm rounded-3xl p-8 border border-slate-200/50 shadow-sm mb-12 text-center" data-aos="fade-up">
    <div class="w-20 h-20 mx-auto mb-4 bg-slate-100 rounded-2xl flex items-center justify-center">
        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16M4 11h16M4 15h16M4 19h16"/>
        </svg>
    </div>
    <p class="text-gray-600 text-lg">No activities associated with this project yet.</p>
</div>
@endif

   

    <!-- Background Elements -->
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-32 w-96 h-96 bg-green-200 rounded-full blur-3xl opacity-20 animate-float"></div>
        <div class="absolute -bottom-40 -left-32 w-96 h-96 bg-emerald-200 rounded-full blur-3xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
    </div>
</div>

<script>
        function openPopup(id) {
        document.getElementById('popup-' + id).classList.remove('hidden');
    }

    function closePopup(id) {
        document.getElementById('popup-' + id).classList.add('hidden');
    }
</script>


<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }
    .animate-float {
        animation: float 8s ease-in-out infinite;
    }
</style>
@endsection