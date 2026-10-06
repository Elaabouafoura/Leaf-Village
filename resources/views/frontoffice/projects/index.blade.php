@extends('layouts.user')

@section('title', 'All Projects - Green Spaces')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 via-white to-emerald-100 py-16">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Header Section -->
        <div class="text-center mb-16" data-aos="fade-down">
              
            
            <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                Discover Our <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-emerald-500">Green Projects</span>
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Explore our comprehensive portfolio of sustainable initiatives and environmental projects 
                dedicated to creating greener, healthier communities.
            </p>
        </div>

        <!-- Stats Bar -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-16" data-aos="fade-up" data-aos-delay="100">
            <div class="group relative bg-white/90 backdrop-blur-sm rounded-2xl p-6 text-center border border-green-100/50 shadow-sm hover:shadow-2xl transition-all duration-500 hover:-translate-y-1">
                <div class="relative z-10">
                    <div class="text-3xl font-bold text-green-600 mb-2">{{ $projects->count() }}</div>
                    <div class="text-gray-600 font-medium">Total Projects</div>
                </div>
                <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-green-500/5 to-emerald-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </div>
            
            <div class="group relative bg-white/90 backdrop-blur-sm rounded-2xl p-6 text-center border border-green-100/50 shadow-sm hover:shadow-2xl transition-all duration-500 hover:-translate-y-1">
                <div class="relative z-10">
                    <div class="text-3xl font-bold text-green-600 mb-2">{{ $projects->where('dateDebut', '<=', now())->where('dateFin', '>=', now())->count() }}</div>
                    <div class="text-gray-600 font-medium">Active Projects</div>
                </div>
                <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-green-500/5 to-emerald-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </div>
            
            <div class="group relative bg-white/90 backdrop-blur-sm rounded-2xl p-6 text-center border border-green-100/50 shadow-sm hover:shadow-2xl transition-all duration-500 hover:-translate-y-1">
                <div class="relative z-10">
                    <div class="text-3xl font-bold text-green-600 mb-2">{{ $projects->where('dateFin', '<', now())->count() }}</div>
                    <div class="text-gray-600 font-medium">Completed</div>
                </div>
                <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-green-500/5 to-emerald-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </div>
            
            <div class="group relative bg-white/90 backdrop-blur-sm rounded-2xl p-6 text-center border border-green-100/50 shadow-sm hover:shadow-2xl transition-all duration-500 hover:-translate-y-1">
                <div class="relative z-10">
                    <div class="text-3xl font-bold text-green-600 mb-2">{{ $projects->where('dateDebut', '>', now())->count() }}</div>
                    <div class="text-gray-600 font-medium">Upcoming</div>
                </div>
                <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-green-500/5 to-emerald-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </div>
        </div>

        <!-- Projects Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8" data-aos="fade-up" data-aos-delay="200">
            @forelse($projects as $project)
            <div class="group relative bg-white/90 backdrop-blur-sm border border-green-100/50 hover:border-green-300/70 p-8 rounded-3xl transition-all duration-500 hover:shadow-2xl hover:-translate-y-2"
                 data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                
                <!-- Status Badge -->
                <div class="absolute top-6 right-6 z-20">
                    @php
                        $now = now();
                        $start = $project->dateDebut ? \Carbon\Carbon::parse($project->dateDebut) : null;
                        $end = $project->dateFin ? \Carbon\Carbon::parse($project->dateFin) : null;
                        
                        if (!$start) {
                            $status = 'Planned';
                            $statusColor = 'bg-blue-100/80 text-blue-700 backdrop-blur-sm';
                            $dotColor = 'bg-blue-500';
                        } elseif ($now->lt($start)) {
                            $status = 'Upcoming';
                            $statusColor = 'bg-purple-100/80 text-purple-700 backdrop-blur-sm';
                            $dotColor = 'bg-purple-500';
                        } elseif ($end && $now->gt($end)) {
                            $status = 'Completed';
                            $statusColor = 'bg-green-100/80 text-green-700 backdrop-blur-sm';
                            $dotColor = 'bg-green-500';
                        } else {
                            $status = 'In Progress';
                            $statusColor = 'bg-orange-100/80 text-orange-700 backdrop-blur-sm';
                            $dotColor = 'bg-orange-500';
                        }
                    @endphp
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold border border-white/50 {{ $statusColor }} transition-all duration-300 group-hover:scale-105">
                        <div class="w-1.5 h-1.5 rounded-full {{ $dotColor }} animate-pulse"></div>
                        {{ $status }}
                    </span>
                </div>

                <!-- Project Icon -->
                <div class="relative mb-8">
                    <div class="absolute inset-0 bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl blur-lg opacity-20 group-hover:opacity-30 transition-opacity duration-500"></div>
                    <div class="relative bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl w-16 h-16 flex items-center justify-center mx-auto shadow-2xl transform group-hover:scale-110 transition-transform duration-300 group-hover:rotate-3">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                </div>

                <!-- Project Content -->
                <div class="space-y-4 relative z-10">
                    <h3 class="font-bold text-2xl text-gray-900 group-hover:text-green-700 transition-colors duration-300 line-clamp-2 leading-tight">
                        {{ $project->nom }}
                    </h3>
                    
                    <p class="text-gray-600 leading-relaxed line-clamp-3 text-lg">
                        {{ $project->description ?? 'No description available' }}
                    </p>

                    <!-- Project Details -->
                    <div class="space-y-3 pt-4 border-t border-gray-100/50">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500 font-medium flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Timeline
                            </span>
                            <span class="text-gray-700 font-semibold text-right">
                                {{ $project->dateDebut ? \Carbon\Carbon::parse($project->dateDebut)->format('d M Y') : 'TBD' }}<br>
                                <span class="text-gray-400">→</span><br>
                                {{ $project->dateFin ? \Carbon\Carbon::parse($project->dateFin)->format('d M Y') : 'Ongoing' }}
                            </span>
                        </div>
                        
                        <div class="flex items-center justify-between text-sm pt-2">
                            <span class="text-gray-500 font-medium flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                </svg>
                                Budget
                            </span>
                            <span class="text-green-600 font-bold text-lg">
                                {{ $project->budget ? number_format($project->budget, 0, ',', ' ') . ' €' : 'Not specified' }}
                            </span>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="pt-6">
                        <a href="{{ route('projects.front.show', $project) }}" 
                           class="inline-flex items-center justify-center gap-2 w-full px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg group/btn">
                            <span>View Details</span>
                            <svg class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Hover Effect Overlay -->
                <div class="absolute inset-0 rounded-3xl bg-gradient-to-br from-green-500/5 to-emerald-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
            </div>
            @empty
            <!-- Empty State -->
            <div class="col-span-3 text-center py-20" data-aos="fade-up">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-gray-100 to-gray-200 rounded-3xl flex items-center justify-center shadow-lg">
                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-3">No Projects Available</h3>
                    <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                        We're currently working on new exciting projects. Check back soon for updates!
                    </p>
                    <a href="#" class="inline-flex items-center gap-2 px-8 py-4 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                        <span>Subscribe for Updates</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </a>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Background Elements -->
{{--     <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute -top-40 -right-32 w-96 h-96 bg-green-200 rounded-full blur-3xl opacity-20 animate-float"></div>
        <div class="absolute -bottom-40 -left-32 w-96 h-96 bg-emerald-200 rounded-full blur-3xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
    </div> --}}
</div>

<style>
    @keyframes float {
        0%, 100% { 
            transform: translateY(0px) rotate(0deg) scale(1); 
        }
        33% { 
            transform: translateY(-20px) rotate(120deg) scale(1.05); 
        }
        66% { 
            transform: translateY(10px) rotate(240deg) scale(0.95); 
        }
    }
    .animate-float {
        animation: float 12s ease-in-out infinite;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection