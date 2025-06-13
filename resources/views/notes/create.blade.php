<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Évaluation de la vidéo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .container {
            max-width: 700px;
            padding-top: 30px;
            padding-bottom: 50px;
        }
        
        .rating-form {
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            position: relative;
        }
        
        .form-header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 25px 30px;
            position: relative;
        }
        
        .form-header h2 {
            font-weight: 700;
            margin-bottom: 15px;
            font-size: 1.8rem;
        }
        
        .rating-info {
            font-size: 1rem;
            opacity: 0.9;
            max-width: 90%;
        }
        
        .back-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s ease;
        }
        
        .back-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateX(-3px);
        }
        
        form {
            padding: 30px;
        }
        
        .rating-stars {
            display: flex;
            justify-content: center;
            margin: 25px 0 30px;
            direction: rtl;
        }
        
        .rating-stars input {
            display: none;
        }
        
        .rating-stars label {
            color: #ddd;
            font-size: 2.5rem;
            padding: 0 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .rating-stars label:hover,
        .rating-stars label:hover ~ label,
        .rating-stars input:checked ~ label {
            color: #ffc107;
        }
        
        .rating-description {
            text-align: center;
            min-height: 24px;
            margin: -15px 0 25px;
            font-weight: 500;
            color: #6c757d;
        }
        
        textarea.form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 15px;
            font-size: 1rem;
            resize: none;
            transition: all 0.3s ease;
        }
        
        textarea.form-control:focus {
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }
        
        .btn-submit {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            border: none;
            border-radius: 50px;
            color: white;
            font-weight: 600;
            padding: 12px 30px;
            width: 100%;
            margin-top: 20px;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
            font-size: 1.1rem;
        }
        
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(37, 117, 252, 0.25);
        }
        
        .btn-submit:active {
            transform: translateY(0);
        }
        
        .video-info {
            background: #f1f3ff;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }
        
        .video-info i {
            font-size: 1.5rem;
            color: #2575fc;
            margin-right: 12px;
        }
        
        .video-title {
            font-weight: 600;
            margin-bottom: 0;
            color: #343a40;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="rating-form">
            <div class="form-header">
                <h2><i class="fas fa-star me-2"></i>Évaluer cette vidéo</h2>
                <div class="rating-info">
                    <p class="mb-0">Votre avis nous aide à améliorer le contenu et à guider les autres utilisateurs vers les meilleures vidéos. Merci de partager votre opinion sincère.</p>
                </div>
                
                <!-- Bouton Retour -->
                <a href="{{ url()->previous() }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>

            <form action="{{ route('notes.store') }}" method="POST">
                @csrf
                <input type="hidden" name="video_id" value="{{ $video->id }}">
                
                <!-- Info vidéo -->
                <div class="video-info">
                    <i class="fas fa-video"></i>
                    <p class="video-title">{{ $video->titre }}</p>
                </div>

                <!-- Étoiles -->
                <div class="rating-stars">
                    <input type="radio" id="star5" name="valeur" value="5">
                    <label for="star5"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star4" name="valeur" value="4">
                    <label for="star4"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star3" name="valeur" value="3">
                    <label for="star3"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star2" name="valeur" value="2">
                    <label for="star2"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star1" name="valeur" value="1">
                    <label for="star1"><i class="fas fa-star"></i></label>
                </div>
                
                <!-- Description de la note -->
                <div class="rating-description" id="ratingDescription">
                    Sélectionnez une note en cliquant sur les étoiles
                </div>

                <textarea id="commentaire" name="commentaire" class="form-control" rows="4" placeholder="Ajoutez un commentaire (facultatif)..."></textarea>

                <button type="submit" id="submitBtn" class="btn btn-submit">
                    <i class="fas fa-paper-plane me-2"></i> Envoyer l'évaluation
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Descriptions en français
        const ratingDescriptions = {
            1: "Mauvais - Pas du tout satisfait",
            2: "Passable - Peut mieux faire",
            3: "Correct - Contenu moyen",
            4: "Très bien - J'ai apprécié",
            5: "Excellent - J'ai adoré !"
        };

        document.querySelectorAll('.rating-stars input').forEach(star => {
            star.addEventListener('change', function() {
                const value = this.value;
                document.getElementById('ratingDescription').textContent = ratingDescriptions[value];
            });
        });

        const submitBtn = document.getElementById('submitBtn');
        const form = document.querySelector('form');

        form.addEventListener('submit', function(e) {
            const selected = document.querySelector('input[name="valeur"]:checked');
            if (!selected) {
                e.preventDefault();
                document.getElementById('ratingDescription').textContent = "Veuillez sélectionner une note !";
                document.getElementById('ratingDescription').style.color = "#dc3545";
                return;
            }

            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Envoi en cours...';
            submitBtn.disabled = true;
        });

        const textarea = document.getElementById('commentaire');
        if (textarea) {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = Math.min(this.scrollHeight, 150) + 'px';
            });
        }
    </script>
</body>
</html>