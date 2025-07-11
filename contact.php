<?php
$success_message = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $recipient_email = "info@eventsbys.be";

    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error_message = "Veuillez remplir tous les champs du formulaire.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Le format de votre adresse email est invalide.";
    } else {
        $email_subject = "Nouveau message du site web: $subject";

        $email_body = "Vous avez reçu un nouveau message via le formulaire de contact de votre site.\n\n";
        $email_body .= "Nom: $name\n";
        $email_body .= "Email: $email\n\n";
        $email_body .= "Message:\n$message\n";

        $headers = "From: webmaster@eventsbys.be\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        if (mail($recipient_email, $email_subject, $email_body, $headers)) {
            $success_message = "Merci ! Votre message a été envoyé avec succès. Je vous répondrai dans les plus brefs délais.";
        } else {
            $error_message = "Oups ! Une erreur s'est produite et votre message n'a pas pu être envoyé. Veuillez réessayer ou me contacter directement par email.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Events By S</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <!-- Your Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="assets/image/logo.jpg" alt="Events By S Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="about.php">À propos</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                    <li class="nav-item"><a class="nav-link active" href="contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Contactez-moi</h2>
                <p>Une question ? Un projet ? Remplissez le formulaire ou contactez-moi directement.</p>
            </div>

            <div class="row">
                <div class="col-lg-5 d-flex align-items-stretch mb-4 mb-lg-0">
                    <div class="contact-info-box w-100">
                        <h3>Events By S</h3>
                        <p>Contactez-moi pour donner vie à vos idées et créer ensemble un événement mémorable.</p>
                        <div class="d-flex align-items-start my-4">
                            <i class="fas fa-map-marker-alt fa-fw mt-1 me-3"></i>
                            <div><strong>Adresse :</strong><br>Rue des Dolmens 20<br>6940 Wéris, Durbuy</div>
                        </div>
                        <div class="d-flex align-items-start my-4">
                            <i class="fas fa-envelope fa-fw mt-1 me-3"></i>
                            <div><strong>Email :</strong><br><a href="mailto:info@eventsbys.be">info@eventsbys.be</a></div>
                        </div>
                        <div class="d-flex align-items-start my-4">
                            <i class="fas fa-phone fa-fw mt-1 me-3"></i>
                            <div><strong>Téléphone :</strong><br><a href="tel:0032470697638">0032 470 69 76 38</a></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <?php if (!empty($success_message)): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $success_message; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($error_message)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>

                    <form action="contact.php" method="post" class="p-4" style="background-color: #fff; border-radius: 10px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Votre Nom</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Votre Email</label>
                                <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Sujet</label>
                            <input type="text" class="form-control" name="subject" id="subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Votre Message</label>
                            <textarea class="form-control" name="message" rows="6" required></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Envoyer le message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-12">
                    <h4>Events By S</h4>
                    <p>Rue des Ecoles 2, 6940 Wéris, Durbuy</p>
                    <p>
                        <a href="tel:0032470697638">0032 470 69 76 38</a> | <a href="mailto:info@eventsbys.be">info@eventsbys.be</a>
                    </p>
                    <div class="social-links mt-3">
                        <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                    </div>
                    <p class="mt-4 mb-0">&copy; Copyright Events By S. All Rights Reserved. 2025</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>