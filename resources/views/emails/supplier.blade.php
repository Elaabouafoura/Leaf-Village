<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email GreenSpaces</title>
    <style>
        /* Styles généraux */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        
        /* En-tête */
        .header {
            background: linear-gradient(135deg, #2e7d32 0%, #4caf50 100%);
            padding: 30px 20px;
            text-align: center;
            color: white;
        }
        
        .logo {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }
        
        .tagline {
            font-size: 16px;
            opacity: 0.9;
            font-weight: 300;
        }
        
        /* Contenu principal */
        .content {
            padding: 30px;
        }
        
        .message-content {
            font-size: 16px;
            line-height: 1.7;
            color: #444;
            margin-bottom: 30px;
        }
        
        /* Pied de page */
        .footer {
            background-color: #f1f8e9;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #e8f5e9;
        }
        
        .signature {
            margin-bottom: 20px;
        }
        
        .company-name {
            font-weight: 700;
            color: #2e7d32;
            font-size: 18px;
        }
        
        .contact-info {
            font-size: 14px;
            color: #666;
            margin-top: 15px;
        }
        
        .social-links {
            margin-top: 20px;
        }
        
        .social-link {
            display: inline-block;
            margin: 0 10px;
            color: #4caf50;
            text-decoration: none;
            font-weight: 500;
        }
        
        .copyright {
            font-size: 12px;
            color: #888;
            margin-top: 20px;
        }
        
        /* Responsive */
        @media (max-width: 600px) {
            .content, .footer {
                padding: 20px;
            }
            
            .header {
                padding: 20px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- En-tête -->
        <div class="header">
            <div class="logo">Leaf Village</div>
            <div class="tagline">Créons ensemble un avenir plus vert</div>
        </div>
        
        <!-- Contenu principal -->
        <div class="content">
            <div class="message-content">
                {!! nl2br(e($messageContent)) !!}
            </div>
        </div>
        
        <!-- Pied de page -->
        <div class="footer">
            <div class="signature">
                <strong class="company-name">L'équipe Leaf Village</strong>
            </div>
            
            <div class="contact-info">
                contact@leafVillage.org | +216 51 660 733<br>
                2088 Ariana , Tunisie
            </div>
            
            <div class="social-links">
                <a href="#" class="social-link">LinkedIn</a>
                <a href="#" class="social-link">Twitter</a>
                <a href="#" class="social-link">Instagram</a>
            </div>
            
            <div class="copyright">
                © 2025 leafVillage . Tous droits réservés.
            </div>
        </div>
    </div>
</body>
</html>