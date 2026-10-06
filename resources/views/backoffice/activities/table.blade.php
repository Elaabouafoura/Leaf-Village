<!-- backoffice/activities/table.blade.php -->
<div class="overflow-hidden rounded-3xl">
    <!-- Table Header -->
    <div class="bg-gradient-to-r from-emerald-600 to-teal-600 px-6 py-4">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-white flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                Liste des Activités
            </h3>
            <span class="bg-white/20 text-white px-3 py-1 rounded-full text-sm font-medium">
                {{ $activities->count() }} activité(s)
            </span>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-emerald-50 border-b border-emerald-100">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-emerald-900 uppercase tracking-wider">
                        🌿 Activity
                    </th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-emerald-900 uppercase tracking-wider">
                        📋 Description
                    </th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-emerald-900 uppercase tracking-wider">
                        📂 Project
                    </th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-emerald-900 uppercase tracking-wider">
                        👥 Members
                    </th>
                    <th class="px-6 py-4 text-center text-sm font-semibold text-emerald-900 uppercase tracking-wider">
                        ⚙️ Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($activities as $activity)
                <tr class="group hover:bg-emerald-50/50 transition-all duration-300">
                    <!-- Nom -->
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $activity->nom }}</p>
                                @if($activity->date)
                                <p class="text-sm text-gray-500 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ \Carbon\Carbon::parse($activity->date)->format('d/m/Y') }}
                                </p>
                                @endif
                            </div>
                        </div>
                    </td>

                    <!-- Description -->
                    <td class="px-6 py-4">
                        <p class="text-gray-600 text-sm max-w-xs truncate" title="{{ $activity->description }}">
                            {{ $activity->description }}
                        </p>
                    </td>

                    <!-- Projet -->
                    <td class="px-6 py-4">
                        @if($activity->projet)
                        <span class="inline-flex items-center gap-2 bg-emerald-100 text-emerald-800 px-3 py-2 rounded-full text-sm font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            {{ $activity->projet->nom }}
                        </span>
                        @else
                        <span class="text-gray-400 text-sm italic">—</span>
                        @endif
                    </td>

                    <!-- Membres -->
                    <td class="px-6 py-4">
                        @if($activity->members->isNotEmpty())
                        <div class="flex flex-wrap gap-1">
                            @foreach($activity->members->take(2) as $member)
                            <span class="bg-teal-100 text-teal-800 px-2 py-1 rounded-lg text-xs font-medium">
                                {{ $member->nom }}
                            </span>
                            @endforeach
                            @if($activity->members->count() > 2)
                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-lg text-xs font-medium">
                                +{{ $activity->members->count() - 2 }}
                            </span>
                            @endif
                        </div>
                        @else
                        <span class="text-gray-400 text-sm italic">Aucun membre</span>
                        @endif
                    </td>

                    <!-- Actions -->
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <div class="flex items-center justify-center gap-2">
                            <!-- View Button -->
                            <a href="{{ route('activities.show', $activity) }}" 
                               class="group p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all duration-300 transform hover:scale-110"
                               title="Voir les détails">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>

                            <!-- Edit Button -->
                            <button class="group p-2 bg-amber-50 text-amber-600 rounded-xl hover:bg-amber-600 hover:text-white transition-all duration-300 transform hover:scale-110"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editActivityModal{{ $activity->idActivite }}"
                                    title="Modifier">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>

                            <!-- Delete Button -->
                            <button class="group p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all duration-300 transform hover:scale-110"
                                    onclick="confirmDelete('{{ route('activities.destroy', $activity) }}')"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteConfirmModal"
                                    title="Supprimer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center gap-3 text-gray-400">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="text-lg font-medium">Aucune activité trouvée</p>
                            <p class="text-sm">Commencez par créer votre première activité</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>