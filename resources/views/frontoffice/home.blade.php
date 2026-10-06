@extends('layouts.user')

@section('title', 'Leaf Village')

@section('content')
<div>

    <div class="bg-cream">
        {{-- Paste only the "content" part of your HTML here --}}
        <div class="max-w-screen-xl px-8 mx-auto flex flex-col lg:flex-row items-start">
            <!-- Left Col -->
            <div class="flex flex-col w-full lg:w-6/12 justify-center ...">
                <h1 class="my-4 text-5xl font-bold leading-tight text-darken">
                    <span class="text-yellow-500">🌿 Green Spaces</span>  Where Nature Meets Community
                </h1>
                <p class="leading-normal text-2xl mb-8">Building sustainable places to live, learn, and grow together.</p>
                {{-- Buttons etc. --}}
            </div>

            <!-- Right Col -->
            <div class="w-full lg:w-6/12 relative">
                <img src="{{ asset('images/trends-green-spaces-commercial-clients_web.jpg') }}" class="w-10/12 mx-auto" />
                {{-- Floating images --}}
            </div>
        </div>
    </div>
    <div class="container px-4 lg:px-8 mx-auto max-w-screen-xl text-gray-700 overflow-x-hidden overflow-y-hidden">

            <!-- supported by -->
            <div class="max-w-4xl mx-auto">
                <h1 class="text-center mb-3 text-green-600 font-medium">Supported by 200+ Eco Initiatives Worldwide</h1>
                <div class="grid grid-cols-3 lg:grid-cols-6 gap-4 justify-items-center">
                    <img class="h-10" src="{{asset('images/UNEP_logo.svg.png')}}" alt="UNEP">
                    <img class="h-10" src="{{asset('images/nature-conservancy.png')}}" alt="UNEP">
                    <img class="h-10" src="{{asset('images/WWF-logo.png')}}" alt="WWF">
                    <img class="h-10" src="{{asset('images/world-nature-organisation.jpg')}}" alt="Nature Org">
                    <img class="h-10" src="{{asset('images/AdobeStock_456417610-600x400.jpeg')}}" alt="Eco City">
                    <img class="h-10" src="{{asset('images/National_Parks_Conservation_Association_logo.svg')}}" alt="National Parks">
                </div>
            </div>

            <!-- All-In-One Green Spaces. -->
            <div data-aos="flip-up" class="max-w-xl mx-auto text-center mt-24">
                <h1 class="font-bold text-darken my-3 text-2xl">All-In-One <span class="text-green-600">Green Spaces Initiative</span></h1>
                <p class="leading-relaxed text-gray-500">A platform that connects citizens, communities, and cities to protect, enhance, and enjoy sustainable green areas.</p>
            </div>

            <!-- cards -->
            <div class="grid md:grid-cols-3 gap-14 md:gap-5 mt-20">
                <!-- Eco Parks -->
                <div data-aos="fade-up" class="bg-white shadow-xl p-6 text-center rounded-xl">
                    <div style="background: #16A34A;" class="rounded-full w-16 h-16 flex items-center justify-center mx-auto shadow-lg transform -translate-y-12">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 22 12 18.56 5.82 22 7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <h1 class="font-medium text-xl mb-3 lg:px-14 text-darken">Urban Parks & Gardens</h1>
                    <p class="px-4 text-gray-500">Transforming unused urban areas into vibrant green parks and community gardens for everyone.</p>
                </div>

                <!-- Clean Air -->
                <div data-aos="fade-up" data-aos-delay="150" class="bg-white shadow-xl p-6 text-center rounded-xl">
                    <div style="background: #84CC16;" class="rounded-full w-16 h-16 flex items-center justify-center mx-auto shadow-lg transform -translate-y-12">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 12h18M9 6h6M9 18h6"/>
                        </svg>
                    </div>
                    <h1 class="font-medium text-xl mb-3 lg:px-14 text-darken">Cleaner Air & Shade</h1>
                    <p class="px-4 text-gray-500">Green spaces help reduce pollution, lower city temperatures, and provide shade for healthier communities.</p>
                </div>

                <!-- Biodiversity -->
                <div data-aos="fade-up" data-aos-delay="300" class="bg-white shadow-xl p-6 text-center rounded-xl">
                    <div style="background: #22C55E;" class="rounded-full w-16 h-16 flex items-center justify-center mx-auto shadow-lg transform -translate-y-12">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 2C13.657 2 15 3.343 15 5s-1.343 3-3 3-3-1.343-3-3 1.343-3 3-3zm0 7c3.866 0 7 3.134 7 7v3H5v-3c0-3.866 3.134-7 7-7z"/>
                        </svg>
                    </div>
                    <h1 class="font-medium text-xl mb-3 lg:px-14 text-darken lg:h-14 pt-3">Biodiversity Protection</h1>
                    <p class="px-4 text-gray-500">Preserve ecosystems, protect wildlife habitats, and encourage planting of native species in every neighborhood.</p>
                </div>
            </div>

    <!-- EVENTS SECTION -->
    <div class="max-w-4xl mx-auto mt-20">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-semibold text-center md:text-left">Events</h2>
            <a href="{{ route('events.front.index') }}" class="text-green-600 font-medium hover:underline">View All</a>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            @php
                use App\Models\Evenement;
                use Illuminate\Support\Facades\Storage;
                
                $homepageEvents = Evenement::with('projet')
                    ->orderBy('date', 'desc')
                    ->take(3)
                    ->get();
            @endphp

            @foreach($homepageEvents as $index => $event)
            <div class="bg-white shadow-xl p-6 text-center rounded-xl" data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
            <!-- Photo de l'événement - SOLUTION CORRECTE -->
                @if($event->photo)
                <img src="{{ asset('storage/' . $event->photo) }}" alt="{{ $event->nom }}" class="w-full h-32 object-cover rounded-lg mb-4">
                @else
                <div class="w-full h-32 bg-green-100 rounded-lg mb-4 flex items-center justify-center">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                @endif
                <!-- Badge statut -->
                <div class="mb-2">
                    @if($event->statut === 'Upcoming')
                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                        🔥upcoming
                    </span>
                    @else
                    <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">
                        ✅ Passed
                    </span>
                    @endif
                </div>
                
                <h3 class="font-medium text-xl mb-3 text-darken">{{ $event->nom }}</h3>
                <p class="text-gray-500 px-4 mb-4">{{ Str::limit($event->description, 100) }}</p>
                
                <!-- Date et lieu -->
                <div class="mt-4 space-y-2">
                    <div class="text-sm text-gray-600">
                        📅 {{ $event->date_formatted }}
                    </div>
                    <div class="text-sm text-gray-600">
                        📍 {{ $event->lieu }}
                    </div>
                </div>
                
                <!-- Bouton Learn More -->
                <div class="mt-6">
                    <a href="{{ route('events.front.show', $event->idEvenement) }}" class="inline-block bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                        Learn More
                    </a>
                </div>
            </div>
            @endforeach

            @if($homepageEvents->isEmpty())
            <!-- Événements par défaut si aucun événement en base -->
            <div class="bg-white shadow-xl p-6 text-center rounded-xl" data-aos="fade-up">
                <div class="w-full h-32 bg-green-100 rounded-lg mb-4 flex items-center justify-center">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="font-medium text-xl mb-3 text-darken">Community Garden Day</h3>
                <p class="text-gray-500 px-4 mb-4">Join us for a day of planting and community building.</p>
                <div class="mt-4 space-y-2">
                    <div class="text-sm text-gray-600">📅 Coming Soon</div>
                    <div class="text-sm text-gray-600">📍 Central Park</div>
                </div>
                <div class="mt-6">
                    <a href="#" class="inline-block bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                        Learn More
                    </a>
                </div>
            </div>

            <div class="bg-white shadow-xl p-6 text-center rounded-xl" data-aos="fade-up" data-aos-delay="150">
                <div class="w-full h-32 bg-green-100 rounded-lg mb-4 flex items-center justify-center">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="font-medium text-xl mb-3 text-darken">Tree Planting Workshop</h3>
                <p class="text-gray-500 px-4 mb-4">Learn how to plant and care for trees.</p>
                <div class="mt-4 space-y-2">
                    <div class="text-sm text-gray-600">📅 Coming Soon</div>
                    <div class="text-sm text-gray-600">📍 City Garden</div>
                </div>
                <div class="mt-6">
                    <a href="#" class="inline-block bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                        Learn More
                    </a>
                </div>
            </div>

            <div class="bg-white shadow-xl p-6 text-center rounded-xl" data-aos="fade-up" data-aos-delay="300">
                <div class="w-full h-32 bg-green-100 rounded-lg mb-4 flex items-center justify-center">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="font-medium text-xl mb-3 text-darken">Eco Festival 2024</h3>
                <p class="text-gray-500 px-4 mb-4">Annual celebration of sustainability.</p>
                <div class="mt-4 space-y-2">
                    <div class="text-sm text-gray-600">📅 Coming Soon</div>
                    <div class="text-sm text-gray-600">📍 Innovation Hub</div>
                </div>
                <div class="mt-6">
                    <a href="#" class="inline-block bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                        Learn More
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- PROJECTS SECTION - MÊME STYLE QUE EVENTS ET PARTNERS -->
    <div class="max-w-4xl mx-auto mt-20">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-semibold text-center md:text-left">Projects</h2>
            <a href="{{ route('projects.front.index') }}" class="text-green-600 font-medium hover:underline">View All</a>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            @php
                use Illuminate\Support\Str;
                use Carbon\Carbon;
            @endphp

            @foreach($projects as $index => $project)
            <div class="bg-white shadow-xl p-6 text-center rounded-xl" data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
                <!-- Project Image -->
                @if(!empty($project->photo))
                <img src="{{ asset('storage/' . $project->photo) }}" 
                     alt="{{ $project->nom }}" 
                     class="w-full h-32 object-cover rounded-lg mb-4">
                @else
                <div class="w-full h-32 bg-green-100 rounded-lg mb-4 flex items-center justify-center">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                @endif

                <!-- Status Badge -->
                <div class="mb-2">
                    @if(isset($project->statut))
                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium 
                        {{ $project->statut === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        <div class="w-1.5 h-1.5 rounded-full {{ $project->statut === 'active' ? 'bg-green-500' : 'bg-gray-500' }}"></div>
                        {{ $project->statut === 'active' ? 'Active' : ucfirst($project->statut) }}
                    </span>
                    @endif
                </div>
                
                <h3 class="font-medium text-xl mb-3 text-darken">{{ $project->nom }}</h3>
                <p class="text-gray-500 px-4 mb-4">{{ Str::limit($project->description ?? 'No description available.', 100) }}</p>
                
                <!-- Project Details -->
                <div class="mt-4 space-y-2">
                    <!-- Timeline -->
                    @if(!empty($project->dateDebut) || !empty($project->dateFin))
                    <div class="text-sm text-gray-600">
                        📅 
                        @if(!empty($project->dateDebut))
                            {{ Carbon::parse($project->dateDebut)->isoFormat('DD MMM YYYY') }}
                        @endif
                        @if(!empty($project->dateDebut) && !empty($project->dateFin))
                            <span class="text-gray-400 mx-1">→</span>
                        @endif
                        @if(!empty($project->dateFin))
                            {{ Carbon::parse($project->dateFin)->isoFormat('DD MMM YYYY') }}
                        @endif
                    </div>
                    @endif

                    <!-- Budget -->
                    @if(!empty($project->budget))
                    <div class="text-sm text-gray-600">
                        💰 {{ number_format($project->budget, 0, ',', ' ') }} €
                    </div>
                    @endif
                </div>
                
                <!-- Support Button -->
                <div class="mt-6">
                    <a href="#" class="inline-block bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                        Support Project
                    </a>
                </div>
            </div>
            @endforeach

            @if($projects->isEmpty())
            <!-- Default Project Cards -->
            <div class="bg-white shadow-xl p-6 text-center rounded-xl" data-aos="fade-up">
                <div class="w-full h-32 bg-green-100 rounded-lg mb-4 flex items-center justify-center">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="mb-2">
                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                        <div class="w-1.5 h-1.5 bg-green-500 rounded-full"></div>
                        Active
                    </span>
                </div>
                <h3 class="font-medium text-xl mb-3 text-darken">Community Solar Project</h3>
                <p class="text-gray-500 px-4 mb-4">A pilot project bringing affordable solar to neighbourhoods with innovative energy solutions.</p>
                <div class="mt-4 space-y-2">
                    <div class="text-sm text-gray-600">📅 Ongoing</div>
                    <div class="text-sm text-gray-600">💰 75,000 €</div>
                </div>
                <div class="mt-6">
                    <a href="#" class="inline-block bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                        Support Project
                    </a>
                </div>
            </div>

            <div class="bg-white shadow-xl p-6 text-center rounded-xl" data-aos="fade-up" data-aos-delay="150">
                <div class="w-full h-32 bg-green-100 rounded-lg mb-4 flex items-center justify-center">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="mb-2">
                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                        <div class="w-1.5 h-1.5 bg-green-500 rounded-full"></div>
                        Active
                    </span>
                </div>
                <h3 class="font-medium text-xl mb-3 text-darken">Urban Garden Initiative</h3>
                <p class="text-gray-500 px-4 mb-4">Transforming vacant lots into productive community gardens for local food production.</p>
                <div class="mt-4 space-y-2">
                    <div class="text-sm text-gray-600">📅 Ongoing</div>
                    <div class="text-sm text-gray-600">💰 45,000 €</div>
                </div>
                <div class="mt-6">
                    <a href="#" class="inline-block bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                        Support Project
                    </a>
                </div>
            </div>

            <div class="bg-white shadow-xl p-6 text-center rounded-xl" data-aos="fade-up" data-aos-delay="300">
                <div class="w-full h-32 bg-green-100 rounded-lg mb-4 flex items-center justify-center">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="mb-2">
                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                        <div class="w-1.5 h-1.5 bg-green-500 rounded-full"></div>
                        Active
                    </span>
                </div>
                <h3 class="font-medium text-xl mb-3 text-darken">River Cleanup Program</h3>
                <p class="text-gray-500 px-4 mb-4">Restoring local waterways through community-led cleanup and conservation efforts.</p>
                <div class="mt-4 space-y-2">
                    <div class="text-sm text-gray-600">📅 Ongoing</div>
                    <div class="text-sm text-gray-600">💰 32,000 €</div>
                </div>
                <div class="mt-6">
                    <a href="#" class="inline-block bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                        Support Project
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- PARTNERS SECTION -->
    <div class="max-w-4xl mx-auto mt-20">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-semibold text-center md:text-left">Partners</h2>
            <a href="{{ route('partenaires.indexFront') }}" class="text-green-600 font-medium hover:underline">View All</a>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            @forelse($partenaires as $partenaire)
                <div class="bg-white shadow-xl p-6 text-center rounded-xl" data-aos="fade-up">
                    <div style="background: #22C55E;"
                        class="rounded-full w-16 h-16 flex items-center justify-center mx-auto shadow-lg transform -translate-y-12">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M12 2l3 6 6 .5-4.5 4 1.5 6-6-3.5-6 3.5 1.5-6-4.5-4L9 8l3-6z"/>
                        </svg>
                    </div>

                    <h3 class="font-medium text-xl mb-3">{{ $partenaire->nom }}</h3>
                    <p class="text-gray-500">Type: {{ $partenaire->type }}</p>
                    <p class="text-gray-500 mb-4">Contact: {{ $partenaire->contact }}</p>
                    
                    <a href="#" class="inline-block bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors">
                        Learn More
                    </a>
                </div>
            @empty
                <div class="col-span-3 text-center py-8">
                    <p class="text-gray-500">Aucun partenaire trouvé.</p>
                </div>
            @endforelse
        </div>
    </div>

<style>
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
</div>
@endsection