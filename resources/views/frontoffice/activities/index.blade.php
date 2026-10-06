@extends('layouts.user')

@section('title', 'My Activities - Green Spaces')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/30 py-12">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Page Header -->
        <div class="text-center mb-12" data-aos="fade-up">
            <h1 class="text-5xl font-bold text-gray-900 mb-4">My Activities</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                Explore all activities related to your projects and initiatives. 
                Track their progress, budgets, and assigned members.
            </p>
        </div>

        <!-- Activities List -->
        @if(isset($activities) && $activities->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($activities as $activity)
            @php
                $infoModalId = "infoModal_" . $activity->idActivite;
                $feedbackModalId = "feedbackModal_" . $activity->idActivite;
            @endphp

            <div class="group bg-white/80 backdrop-blur-sm border border-slate-200/50 rounded-3xl p-6 transition-all duration-500 hover:shadow-xl hover:-translate-y-1" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                
                <!-- Header -->
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4 -4m6 2a9 9 0 1 1 -18 0a9 9 0 0 1 18 0z" />
                        </svg>
                    </div>
                    <div>
                        <h2 
                            class="text-lg font-bold text-gray-900 group-hover:text-green-700 transition-colors cursor-pointer"
                            onclick="openModal('{{ $infoModalId }}')">
                            {{ $activity->nom }}
                        </h2>
                        <p class="text-sm text-gray-500 flex items-center gap-1">
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
                <div class="text-sm text-gray-700 space-y-2 mb-6">
                    <div class="flex justify-between border-b border-slate-100 pb-1">
                        <span class="text-gray-500">Member:</span>
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
                        <span class="font-semibold 
                            @if($activity->status === 'Completed') text-green-600 
                            @elseif($activity->status === 'In Progress') text-orange-500 
                            @else text-gray-500 @endif">
                            {{ $activity->status ?? 'Pending' }}
                        </span>
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex items-center justify-between">
                    <span class="text-xs text-gray-400">Project: {{ $activity->projet?->nom ?? '—' }}</span>
                </div>

                <!-- Feedback & Cancel Buttons -->
                <div class="mt-3 flex items-center gap-3">
                    <!-- Give Feedback Button -->
                    <button type="button"
                            onclick="openModal('{{ $feedbackModalId }}')"
                            class="flex items-center gap-2 bg-green-600 text-white font-semibold px-4 py-2 rounded-lg hover:bg-green-700 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        Give Feedback
                    </button>

                    <!-- Cancel Participation Button -->
                    <form action="{{ route('activite.cancel', $activity->idActivite) }}" method="POST"
                        onsubmit="return confirm('Voulez-vous vraiment annuler votre participation ?')">
                        @csrf
                        <button type="submit"
                                class="flex items-center gap-2 bg-red-600 text-white font-semibold px-4 py-2 rounded-lg hover:bg-red-700 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Cancel Participation
                        </button>
                    </form>
                </div>
            </div>

            <!-- ℹ️ Activity Info Modal -->
            <div id="{{ $infoModalId }}" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white rounded-2xl p-6 max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Activity Details - {{ $activity->nom }}</h3>
                        <button onclick="closeModal('{{ $infoModalId }}')" class="text-gray-500 hover:text-gray-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    
                    <div class="space-y-6">
                        <!-- Activity Details -->
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Basic Info -->
                            <div class="space-y-4">
                                <div>
                                    <strong class="text-gray-700 block mb-2">Description:</strong>
                                    <p class="text-gray-600 bg-slate-50 p-3 rounded-lg">{{ $activity->description ?? 'No description available.' }}</p>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <strong class="text-gray-700 block text-sm">Date:</strong>
                                        <p class="text-gray-600">{{ $activity->date ? \Carbon\Carbon::parse($activity->date)->format('d M Y') : 'Not specified' }}</p>
                                    </div>
                                    <div>
                                        <strong class="text-gray-700 block text-sm">Budget:</strong>
                                        <p class="text-gray-600">{{ $activity->budget ? number_format($activity->budget, 0, ',', ' ') . ' €' : 'Not specified' }}</p>
                                    </div>
                                    <div>
                                        <strong class="text-gray-700 block text-sm">Status:</strong>
                                        <p class="text-gray-600">{{ $activity->status ?? 'Pending' }}</p>
                                    </div>
                                    <div>
                                        <strong class="text-gray-700 block text-sm">Project:</strong>
                                        <p class="text-gray-600">{{ $activity->projet?->nom ?? '—' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Members Section -->
                            <div>
                                <strong class="text-gray-700 block mb-2">Members:</strong>
                                <div class="bg-slate-50 p-3 rounded-lg">
                                    <p class="text-gray-600">
                                        @if($activity->members->isNotEmpty())
                                            {{ $activity->members->pluck('nom')->join(', ') }}
                                        @else
                                            Aucun membre assigné
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Feedbacks Section -->
                        <div class="border-t border-gray-200 pt-6">
                            <div class="flex justify-between items-center mb-4">
                                <strong class="text-gray-700 text-lg">Feedbacks</strong>
                                <span class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                                    {{ $activity->feedbacks->count() }} feedback(s)
                                </span>
                            </div>
                            
                            @if($activity->feedbacks->isNotEmpty())
                            <div class="max-h-80 overflow-y-auto border border-gray-200 rounded-lg">
                                <div class="divide-y divide-gray-100">
                                    @foreach($activity->feedbacks as $feedback)
                                    @php
                                        $editFeedbackModalId = "editFeedbackModal_" . $feedback->idFeedback;
                                        $deleteFeedbackModalId = "deleteFeedbackModal_" . $feedback->idFeedback;
                                    @endphp
                                    <div class="p-4 hover:bg-gray-50 transition-colors group relative" data-feedback-id="{{ $feedback->idFeedback }}">
                                        <!-- Actions Dropdown -->
                                       @auth

                                        @if($feedback->idUser === auth()->user()->idUser)
                                        <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <div class="relative">
                                                <button class="p-1 text-gray-400 hover:text-gray-600 transition-colors" onclick="toggleDropdown('feedback-actions-{{ $feedback->idFeedback }}')">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                    </svg>
                                                </button>
                                                <div id="feedback-actions-{{ $feedback->idFeedback }}" class="absolute right-0 top-full mt-1 w-32 bg-white border border-gray-200 rounded-lg shadow-lg py-1 z-10 hidden">
                                                    <button 
                                                        onclick="openEditFeedbackModal('{{ $editFeedbackModalId }}', {{ $feedback->idFeedback }}, {{ $feedback->note }}, '{{ addslashes($feedback->commentaire) }}')"
                                                        class="w-full text-left px-3 py-2 text-sm text-blue-600 hover:bg-blue-50 flex items-center gap-2">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        Edit
                                                    </button>
                                                    <button 
                                                        onclick="confirmDeleteFeedback('{{ $deleteFeedbackModalId }}', {{ $feedback->idFeedback }})"
                                                        class="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center gap-2">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endauth
                                        <div class="flex justify-between items-start mb-2">
                                            <div class="flex items-center gap-3">
                                                <!-- User Avatar -->
                                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <span class="font-medium text-gray-900 text-sm">
                                                        {{ $feedback->user->nom.' '.$feedback->user->prenom ?? 'Anonymous User' }}
                                                    </span>
                                                    <span class="text-xs text-gray-500 block">
                                                        {{ $feedback->created_at ? \Carbon\Carbon::parse($feedback->created_at)->format('d M Y, H:i') : 'Unknown date' }}
                                                    </span>
                                                </div>
                                            </div>
                                            
                                            <!-- Rating Stars -->
                                            <div class="flex items-center gap-1">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $feedback->note)
                                                        <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>
                                                    @else
                                                        <svg class="w-4 h-4 text-gray-300 fill-current" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>
                                                    @endif
                                                @endfor
                                                <span class="text-xs text-gray-500 ml-1">({{ $feedback->note }}/5)</span>
                                            </div>
                                        </div>
                                        
                                        <!-- Comment -->
                                        @if($feedback->commentaire)
                                        <div class="mt-2">
                                            <p class="text-gray-700 text-sm bg-blue-50 p-3 rounded-lg">
                                                "{{ $feedback->commentaire }}"
                                            </p>
                                        </div>
                                        @else
                                        <div class="mt-2">
                                            <p class="text-gray-400 text-sm italic">
                                                No comment provided
                                            </p>
                                        </div>
                                        @endif
                                    </div>
                                                <!-- Edit Feedback Modal for this specific activity -->
                                    <div id="{{ $editFeedbackModalId }}" class="fixed inset-0 z-60 bg-black bg-opacity-50 flex items-center justify-center hidden">
                                        <div class="bg-white rounded-2xl p-6 max-w-md w-full mx-4">
                                            <div class="flex justify-between items-center mb-4">
                                                <h3 class="text-xl font-bold text-gray-900">Edit Feedback</h3>
                                                <button onclick="closeModal('{{ $editFeedbackModalId }}')" class="text-gray-500 hover:text-gray-700">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <form id="{{ $editFeedbackModalId }}Form" method="POST">
                                                @csrf
                                                @method('POST')
                                                <div class="mb-4">
                                                    <label for="edit_note_{{ $feedback->idFeedback }}" class="block text-sm font-medium text-gray-700 mb-2">Rating (1-5)</label>
                                                    <select name="note" id="edit_note_{{ $feedback->idFeedback }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" required>
                                                        <option value="">Select a rating</option>
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <option value="{{ $i }}">{{ $i }} / 5</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="mb-6">
                                                    <label for="edit_commentaire_{{ $feedback->idFeedback }}" class="block text-sm font-medium text-gray-700 mb-2">Comment</label>
                                                    <textarea name="commentaire" id="edit_commentaire_{{ $feedback->idFeedback }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" rows="4" placeholder="Share your thoughts..."></textarea>
                                                </div>
                                                <div class="flex gap-3">
                                                    <button type="button" onclick="closeModal('{{ $editFeedbackModalId }}')" class="flex-1 px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                                                        Cancel
                                                    </button>
                                                    <button type="submit" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                                        Update Feedback
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Delete Confirmation Modal for this specific activity -->
                                    <div id="{{ $deleteFeedbackModalId }}" class="fixed inset-0 z-60 bg-black bg-opacity-50 flex items-center justify-center hidden">
                                        <div class="bg-white rounded-2xl p-6 max-w-md w-full mx-4">
                                            <div class="text-center">
                                                <div class="w-12 h-12 mx-auto mb-4 bg-red-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                                    </svg>
                                                </div>
                                                <h3 class="text-lg font-bold text-gray-900 mb-2">Delete Feedback</h3>
                                                <p class="text-gray-600 mb-6">Are you sure you want to delete this feedback? This action cannot be undone.</p>
                                                <div class="flex gap-3">
                                                    <button onclick="closeModal('{{ $deleteFeedbackModalId }}')" class="flex-1 px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                                                        Cancel
                                                    </button>
                                                    <form id="{{ $deleteFeedbackModalId }}Form" method="POST" class="flex-1">
                                                        @csrf
                                                        @method('POST')
                                                        <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @else
                            <!-- Empty Feedback State -->
                            <div class="text-center py-8 bg-gray-50 rounded-lg border-2 border-dashed border-gray-200">
                                <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                                <p class="text-gray-500 text-sm">No feedback yet. Be the first to share your thoughts!</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- 💬 Feedback Modal -->
            <div id="{{ $feedbackModalId }}" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white rounded-2xl p-6 max-w-md w-full mx-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-900">Give Feedback - {{ $activity->nom }}</h3>
                        <button onclick="closeModal('{{ $feedbackModalId }}')" class="text-gray-500 hover:text-gray-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <form id="{{ $feedbackModalId }}Form" action="{{ route('activities.feedback.store', $activity->idActivite) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="commentaire_{{ $activity->idActivite }}" class="block text-sm font-medium text-gray-700 mb-2">Commentaire</label>
                            <textarea name="commentaire" id="commentaire_{{ $activity->idActivite }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" rows="4" placeholder="Share your thoughts..."></textarea>
                        </div>
                        <div class="mb-6">
                            <label for="note_{{ $activity->idActivite }}" class="block text-sm font-medium text-gray-700 mb-2">Note (sur 5)</label>
                            <select name="note" id="note_{{ $activity->idActivite }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                <option value="">Select a rating</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }} / 5</option>
                                @endfor
                            </select>
                        </div>
                        <div class="flex gap-3">
                            <button type="button" onclick="closeModal('{{ $feedbackModalId }}')" class="flex-1 px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                                Cancel
                            </button>
                            <button type="submit" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                Submit Feedback
                            </button>
                        </div>
                    </form>
                </div>
            </div>



            @endforeach
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-24" data-aos="fade-up">
            <div class="w-24 h-24 mx-auto mb-6 bg-slate-100 rounded-2xl flex items-center justify-center">
                <svg class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2H7v2h2zm8 0v-2h-2v2h2zM3 9h18M4 9l1-2h14l1 2" />
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">No Activities Found</h3>
            <p class="text-gray-600 mb-6">You don't have any registered activities yet.</p>

        </div>
        @endif
    </div>

    <!-- Floating Background Effects -->
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-32 w-96 h-96 bg-green-200 rounded-full blur-3xl opacity-20 animate-float"></div>
        <div class="absolute -bottom-40 -left-32 w-96 h-96 bg-emerald-200 rounded-full blur-3xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
    </div>
</div>

<script>
    // Toggle dropdown menu
    function toggleDropdown(dropdownId) {
        const dropdown = document.getElementById(dropdownId);
        dropdown.classList.toggle('hidden');
        
        // Close other dropdowns
        document.querySelectorAll('[id^="feedback-actions-"]').forEach(otherDropdown => {
            if (otherDropdown.id !== dropdownId) {
                otherDropdown.classList.add('hidden');
            }
        });
    }

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.relative')) {
            document.querySelectorAll('[id^="feedback-actions-"]').forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        }
    });

    // Open edit feedback modal
    function openEditFeedbackModal(editModalId, feedbackId, currentNote, currentComment) {
        // Set form action
        document.getElementById(editModalId + 'Form').action = `/feedbacks/update/${feedbackId}`;
        
        // Set current values
        document.getElementById('edit_note_' + editModalId.split('_')[1]).value = currentNote;
        document.getElementById('edit_commentaire_' + editModalId.split('_')[1]).value = currentComment;
        
        // Open modal on top of activity modal
        openModal(editModalId);
    }

    // Confirm delete feedback
    function confirmDeleteFeedback(deleteModalId, feedbackId) {
        // Set form action
        document.getElementById(deleteModalId + 'Form').action = `/feedbacks/delete/${feedbackId}`;
        
        // Open confirmation modal on top of activity modal
        openModal(deleteModalId);
    }

    // Enhanced modal functions
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
        
        // Only reset body overflow when no modals are open
        const openModals = document.querySelectorAll('.fixed:not(.hidden)');
        if (openModals.length === 0) {
            document.body.style.overflow = 'auto';
        }
    }

    // Close modals when clicking outside - only close the topmost modal
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('fixed')) {
            // Get all open modals
            const openModals = Array.from(document.querySelectorAll('.fixed:not(.hidden)'));
            
            if (openModals.length > 0) {
                // Close only the topmost modal (highest z-index)
                const topModal = openModals.reduce((top, current) => {
                    const topZIndex = parseInt(window.getComputedStyle(top).zIndex) || 0;
                    const currentZIndex = parseInt(window.getComputedStyle(current).zIndex) || 0;
                    return currentZIndex > topZIndex ? current : top;
                });
                
                closeModal(topModal.id);
            }
        }
    });

    // Close modals with Escape key - only close the topmost modal
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            // Get all open modals
            const openModals = Array.from(document.querySelectorAll('.fixed:not(.hidden)'));
            
            if (openModals.length > 0) {
                // Close only the topmost modal (highest z-index)
                const topModal = openModals.reduce((top, current) => {
                    const topZIndex = parseInt(window.getComputedStyle(top).zIndex) || 0;
                    const currentZIndex = parseInt(window.getComputedStyle(current).zIndex) || 0;
                    return currentZIndex > topZIndex ? current : top;
                });
                
                closeModal(topModal.id);
            }
        }
    });
</script>

<style>
@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}
.animate-float { animation: float 8s ease-in-out infinite; }

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection