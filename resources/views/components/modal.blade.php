<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered {{ $size }}">
    <div class="modal-content rounded-3xl shadow-2xl border-0 overflow-hidden backdrop-blur-sm">

      <!-- Header -->
      <div class="modal-header border-0 
                  @if($type === 'confirm') bg-gradient-to-r from-red-600 to-red-500 text-white
                  @elseif($type === 'info') bg-gradient-to-r from-blue-600 to-blue-500 text-white
                  @elseif($type === 'form') bg-gradient-to-r from-emerald-600 to-teal-500 text-white
                  @else bg-gradient-to-r from-emerald-600 to-teal-500 text-white @endif
                  p-6">
        <div class="flex items-center gap-3 w-full">
          <!-- Icon based on modal type -->
          <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
            @if($type === 'confirm')
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z" />
            </svg>
            @elseif($type === 'info')
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            @elseif($type === 'form')
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            @else
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
            @endif
          </div>
          <div class="flex-1">
            <h5 class="modal-title text-xl font-bold" id="{{ $id }}Label">
              {{ $title ?? 'Modal Title' }}
            </h5>
            @if(isset($subtitle))
            <p class="text-white/80 text-sm mt-1">{{ $subtitle }}</p>
            @endif
          </div>
          <button type="button" class="btn-close btn-close-white opacity-80 hover:opacity-100 transition-opacity duration-200 scale-110" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      </div>

      <!-- Body -->
      <div class="modal-body bg-gradient-to-br from-white to-gray-50/80 p-6">
        <div class="space-y-4">
          {{ $slot }}
        </div>
      </div>

      <!-- Footer -->
      <div class="modal-footer border-t border-gray-200/50 bg-white/80 backdrop-blur-sm p-6">
        @isset($footer)
            <div class="flex gap-3 w-full">
                {{ $footer }}
            </div>
        @else
            <div class="flex gap-3 w-full">
                @if($type === 'confirm')
                    <button type="button" class="flex-1 px-6 py-3 text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition-all duration-300 font-semibold shadow-sm" data-bs-dismiss="modal">
                        Annuler
                    </button>
                    <button type="submit" form="{{ $id }}Form" class="flex-1 px-6 py-3 bg-gradient-to-r from-red-600 to-red-500 text-white rounded-xl hover:shadow-lg transition-all duration-300 font-semibold shadow-sm">
                        Confirmer
                    </button>
                @elseif($type === 'form')
                    <button type="button" class="flex-1 px-6 py-3 text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition-all duration-300 font-semibold shadow-sm" data-bs-dismiss="modal">
                        Annuler
                    </button>
                    <button type="submit" form="{{ $id }}Form" class="flex-1 px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-500 text-white rounded-xl hover:shadow-lg transition-all duration-300 font-semibold shadow-sm">
                        Enregistrer
                    </button>
                @elseif($type === 'info')
                    <button type="button" class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-500 text-white rounded-xl hover:shadow-lg transition-all duration-300 font-semibold shadow-sm" data-bs-dismiss="modal">
                        Fermer
                    </button>
                @else
                    <button type="button" class="w-full px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-500 text-white rounded-xl hover:shadow-lg transition-all duration-300 font-semibold shadow-sm" data-bs-dismiss="modal">
                        Fermer
                    </button>
                @endif
            </div>
        @endisset
      </div>

    </div>
  </div>
</div>

<style>
.modal-content {
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
}

.modal-header {
  background: linear-gradient(135deg, var(--tw-gradient-from) 0%, var(--tw-gradient-to) 100%);
}

.btn-close {
  transition: all 0.3s ease;
}

.btn-close:hover {
  transform: scale(1.1);
}

/* Smooth modal animations */
.modal.fade .modal-dialog {
  transition: transform 0.3s ease-out;
}

.modal.show .modal-dialog {
  transform: none;
}

/* Custom scrollbar for modal body */
.modal-body {
  scrollbar-width: thin;
  scrollbar-color: #cbd5e0 #f7fafc;
}

.modal-body::-webkit-scrollbar {
  width: 6px;
}

.modal-body::-webkit-scrollbar-track {
  background: #f7fafc;
  border-radius: 3px;
}

.modal-body::-webkit-scrollbar-thumb {
  background: #cbd5e0;
  border-radius: 3px;
}

.modal-body::-webkit-scrollbar-thumb:hover {
  background: #a0aec0;
}
</style>