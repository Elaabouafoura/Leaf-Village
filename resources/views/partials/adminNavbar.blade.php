<header class="app-header" style="z-index: 9999 !important;">
  <nav class="navbar navbar-expand-lg navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item d-block d-xl-none">
        <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
          <i class="ti ti-menu-2"></i>
        </a>
      </li>
      
      <!-- ✅ NOTIFICATION AMÉLIORÉE avec badge rouge RAPPROCHÉ -->
      <li class="nav-item dropdown position-relative">
        <a
          class="nav-link nav-icon-hover position-relative"
          href="#"
          id="notificationDropdown"
          role="button"
          data-bs-toggle="dropdown"
          aria-expanded="false"
        >
          <i class="ti ti-bell-ringing"></i>
          @if(!empty($notifications) && $notifications->count() > 0)
              @php
                  // Count unread notifications (etat = false)
                  $unreadCount = $notifications->where('etat', false)->count();
              @endphp

              @if($unreadCount > 0)
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger notification-badge">
                      {{ $unreadCount }}
                  </span>
              @endif
          @endif
        </a>

        <!-- ✅ DROPDOWN DES NOTIFICATIONS AMÉLIORÉ -->
        <div class="dropdown-menu dropdown-menu-end shadow-lg notifications-dropdown">
          <div class="notification-header">
            <h6 class="mb-0">Notifications</h6>
        @if(!empty($notifications) && $notifications->count() > 0)

            @if($unreadCount > 0)
              <span class="badge bg-success">{{ $unreadCount }} non lue(s)</span>
            @endif
        @endif
          </div>
          
          <div class="notification-body">
          @if(!empty($notifications) && $notifications->count() > 0)
            @forelse ($notifications as $notif)
              <a
                href="{{ route('notifications.read', $notif->idNotification) }}"
                class="notification-item {{ $notif->etat ? 'read' : 'unread' }}"
              >
                <div class="notification-content">
                  <div class="notification-title">
                    {{ $notif->evenement->nom ?? 'Événement supprimé' }}
                  </div>
                  <div class="notification-message">
                    {{ \Illuminate\Support\Str::limit($notif->evenement->description ?? $notif->message, 50) }}
                  </div>
                  <div class="notification-time">
                    {{ \Carbon\Carbon::parse($notif->date)->diffForHumans() }}
                  </div>
                </div>
              </a>
            @empty
              <div class="notification-empty">
                <p>Aucune notification</p>
              </div>
            @endforelse
          @endif
          </div>
          
          <div class="notification-footer">
            <a class="view-all-btn" href="{{ route('notifications.index') }}">
              Voir toutes les notifications
            </a>
          </div>
        </div>
      </li>
    </ul>

    <!-- ✅ SECTION UTILISATEUR CONSERVÉE INCHANGÉE -->
    <div class="navbar-collapse justify-content-end px-0">
      <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
        <li class="nav-item dropdown">
          <a class="nav-link nav-icon-hover" href="#" id="drop2" data-bs-toggle="dropdown">
            <img src="{{ asset('images/profile/user-1.jpg') }}" width="35" height="35" class="rounded-circle">
          </a>
          <div class="dropdown-menu dropdown-menu-end">
            <a href="{{ route('admin.profile') }}" class="dropdown-item"><i class="ti ti-user"></i> My Profile</a>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-outline-primary mx-3 mt-2">
                    Logout
                </button>
            </form> 
         </div>
        </li>
      </ul>
    </div>
  </nav>

  <!-- ✅ STYLES AMÉLIORÉS - BADGE RAPPROCHÉ DE L'ICÔNE -->
  <style>
    /* Badge de notification RAPPROCHÉ et plus visible */
    .notification-badge {
      background-color: #dc3545 !important;
      color: white !important;
      font-size: 0.65rem;
      font-weight: 700;
      padding: 0.3em 0.5em;
      min-width: 18px;
      min-height: 18px;
      border: 2px solid white;
      animation: pulse-red 1.5s infinite;
      
      /* POSITION RAPPROCHÉE - ajustement pour être plus près de l'icône */
      top: 2px !important;
      right: 2px !important;
      transform: translate(0%, 0%) !important;
      box-shadow: 0 2px 6px rgba(220, 53, 69, 0.4);
    }

    @keyframes pulse-red {
      0% { 
        transform: scale(1);
        box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7);
      }
      50% { 
        transform: scale(1.15);
        box-shadow: 0 0 0 4px rgba(220, 53, 69, 0.3);
      }
      100% { 
        transform: scale(1);
        box-shadow: 0 0 0 0 rgba(220, 53, 69, 0);
      }
    }

    /* Style de l'icône de notification pour mieux intégrer le badge */
    .nav-icon-hover {
      position: relative;
      padding: 8px;
      margin: 0 5px;
    }

    /* Dropdown notifications */
    .notifications-dropdown {
      min-width: 350px;
      border-radius: 10px;
      border: none;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
      padding: 0;
      overflow: hidden;
    }

    .notification-header {
      background: linear-gradient(135deg, #2e7d32, #4caf50);
      color: white;
      padding: 15px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .notification-header h6 {
      margin: 0;
      font-weight: 600;
    }

    .notification-body {
      max-height: 300px;
      overflow-y: auto;
    }

    .notification-item {
      display: block;
      padding: 12px 20px;
      border-bottom: 1px solid #f0f0f0;
      text-decoration: none;
      color: inherit;
      transition: background-color 0.2s ease;
    }

    .notification-item:hover {
      background-color: #f8f9fa;
      text-decoration: none;
      color: inherit;
    }

    .notification-item.unread {
      background-color: rgba(220, 53, 69, 0.05);
      border-left: 3px solid #dc3545;
    }

    .notification-title {
      font-weight: 600;
      color: #333;
      margin-bottom: 4px;
      font-size: 0.9rem;
    }

    .notification-message {
      color: #666;
      font-size: 0.85rem;
      margin-bottom: 4px;
      line-height: 1.4;
    }

    .notification-time {
      color: #888;
      font-size: 0.75rem;
    }

    .notification-empty {
      padding: 30px 20px;
      text-align: center;
      color: #888;
    }

    .notification-footer {
      border-top: 1px solid #f0f0f0;
      padding: 0;
    }

    .view-all-btn {
      display: block;
      padding: 12px 20px;
      background-color: #f8f9fa;
      color: #2e7d32;
      text-decoration: none;
      font-weight: 600;
      text-align: center;
      transition: all 0.3s ease;
    }

    .view-all-btn:hover {
      background-color: #2e7d32;
      color: white;
    }

    /* Responsive pour mobiles */
    @media (max-width: 576px) {
      .notification-badge {
        top: 1px !important;
        right: 1px !important;
        font-size: 0.6rem;
        min-width: 16px;
        min-height: 16px;
      }
    }
  </style>
 <!-- 🔥 SOLUTION DÉFINITIVE - Script unique -->
<script>
// Attendre que la page soit chargée
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Initialisation notifications temps réel...');
    
    // Vérifier si Echo est disponible (depuis Vite)
    if (typeof Echo !== 'undefined') {
        initializeRealtimeNotifications();
    } else {
        // Si Echo n'est pas chargé, on le charge manuellement
        loadEchoManually();
    }
});

function initializeRealtimeNotifications() {
    console.log('✅ Echo disponible, écoute des notifications...');
    
    window.Echo.channel('notifications')
        .listen('.notification.created', (e) => {
            console.log('🎉 NOTIFICATION TEMPS RÉEL REÇUE:', e);
            updateNotificationUI(e);
        });
}

function loadEchoManually() {
    console.log('⚠️ Chargement manuel d\'Echo...');
    
    // Créer et charger les scripts manuellement
    const pusherScript = document.createElement('script');
    pusherScript.src = 'https://cdn.jsdelivr.net/npm/pusher-js@8.4.0/dist/web/pusher.min.js';
    
    const echoScript = document.createElement('script');
    echoScript.src = 'https://cdn.jsdelivr.net/npm/laravel-echo@1.16.0/dist/echo.iife.js';
    
    // Charger Pusher d'abord, puis Echo
    pusherScript.onload = function() {
        document.head.appendChild(echoScript);
    };
    
    echoScript.onload = function() {
        // Initialiser Echo après chargement
        window.Echo = new Echo({
            broadcaster: 'reverb',
            key: 'ot75rshnne8giitmlgdt',
            wsHost: 'localhost',
            wsPort: 8080,
            forceTLS: false,
        });
        
        console.log('✅ Echo chargé manuellement!');
        initializeRealtimeNotifications();
    };
    
    document.head.appendChild(pusherScript);
}

function updateNotificationUI(notification) {
    console.log('🔄 Mise à jour de l\'interface...');
    
    // 1. Mettre à jour le badge
    let badge = document.querySelector('.notification-badge');
    if (!badge) {
        const icon = document.querySelector('.ti-bell-ringing').closest('a');
        if (icon) {
            icon.innerHTML += '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger notification-badge">1</span>';
        }
    } else {
        const currentCount = parseInt(badge.textContent) || 0;
        badge.textContent = currentCount + 1;
    }
    
    // 2. Ajouter la notification dans la liste
    const notificationBody = document.querySelector('.notification-body');
    if (notificationBody) {
        const timeAgo = new Date().toLocaleTimeString('fr-FR', { 
            hour: '2-digit', 
            minute: '2-digit' 
        });
        
        const newNotificationHTML = `
            <a href="/notifications/${notification.id}/read" class="notification-item unread">
                <div class="notification-content">
                    <div class="notification-title">${notification.event_name}</div>
                    <div class="notification-message">${notification.message}</div>
                    <div class="notification-time">${timeAgo}</div>
                </div>
            </a>
        `;
        
        notificationBody.insertAdjacentHTML('afterbegin', newNotificationHTML);
    }
}
</script>
</header>

