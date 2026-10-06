@extends('layouts.user')

@section('title', 'Leaf Village - Modifier Mon Profil')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-green-50 to-emerald-100 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-green-800 mb-2">Modifier Mon Profil</h1>
            <p class="text-lg text-green-600">Mettez à jour vos informations personnelles</p>
        </div>

        <!-- Profile Edit Card -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-green-200">
            <div class="bg-green-600 h-2"></div>
            
            <div class="p-6 md:p-8">
                <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" id="profileForm">
                    @csrf
                    @method('PUT')
                    
                    <!-- Profile Picture Section -->
                    <div class="text-center mb-8">
                        <div class="relative inline-block">
                            <img 
                                src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . auth()->user()->prenom . '+' . auth()->user()->nom . '&background=11998e&color=fff&size=150' }}" 
                                alt="Profile" 
                                class="w-32 h-32 rounded-full border-4 border-white shadow-lg mx-auto mb-4 profile-image-preview"
                                id="profileImagePreview"
                            >
                    </div>

                    <!-- Personal Information -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                        <!-- Left Column -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-green-700 mb-2">Nom <span class="text-red-500">*</span></label>
                                <input 
                                    type="text" 
                                    name="nom" 
                                    value="{{ old('nom', auth()->user()->nom) }}"
                                    class="w-full px-4 py-3 bg-green-50 border border-green-200 rounded-lg text-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200 @error('nom') border-red-500 @enderror"
                                    required
                                >
                                @error('nom')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-green-700 mb-2">Email <span class="text-red-500">*</span></label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    value="{{ old('email', auth()->user()->email) }}"
                                    class="w-full px-4 py-3 bg-green-50 border border-green-200 rounded-lg text-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200 @error('email') border-red-500 @enderror"
                                    required
                                >
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                        </div>
                        
                        <!-- Right Column -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-green-700 mb-2">Prénom <span class="text-red-500">*</span></label>
                                <input 
                                    type="text" 
                                    name="prenom" 
                                    value="{{ old('prenom', auth()->user()->prenom) }}"
                                    class="w-full px-4 py-3 bg-green-50 border border-green-200 rounded-lg text-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200 @error('prenom') border-red-500 @enderror"
                                    required
                                >
                                @error('prenom')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-green-700 mb-2">Téléphone</label>
                                <input 
                                    type="tel" 
                                    name="telephone" 
                                    value="{{ old('telephone', auth()->user()->telephone) }}"
                                    class="w-full px-4 py-3 bg-green-50 border border-green-200 rounded-lg text-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200 @error('telephone') border-red-500 @enderror"
                                    placeholder="+33 1 23 45 67 89"
                                >
                                @error('telephone')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                        </div>
                    </div>



                    <!-- Form Actions -->
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-6 border-t border-green-200">
                        <a 
                            href="{{ route('profile') }}" 
                            class="w-full sm:w-auto bg-gray-500 hover:bg-gray-600 text-white px-8 py-3 rounded-lg font-medium transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50 text-center"
                        >
                            Annuler
                        </a>
                        
                        <button 
                            type="submit" 
                            class="w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-medium transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 flex items-center justify-center"
                            id="submitBtn"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Enregistrer les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>


<style>
.profile-image-preview {
    transition: transform 0.3s ease;
}

.profile-image-preview:hover {
    transform: scale(1.05);
}

input:focus, textarea:focus, select:focus {
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}
</style>
@endsection