
    <?php
    // Afficher les erreurs
    if (isset($_GET['form_errors'])) {
        $errors = explode(',', sanitize_text_field($_GET['form_errors']));
        echo '<div class="form-error">';
        if (in_array('name', $errors)) echo '<p>Veuillez entrer un nom valide.</p>';
        if (in_array('email', $errors)) echo '<p>Veuillez entrer un email valide.</p>';
        if (in_array('message', $errors)) echo '<p>Le message ne peut pas être vide.</p>';
        echo '</div>';
    }
    
    if (isset($_GET['form_error'])) {
        $error_type = sanitize_text_field($_GET['form_error']);
        echo '<div class="form-error">';
        if ($error_type === 'security') echo '<p>Vérification de sécurité échouée. Veuillez réessayer.</p>';
        if ($error_type === 'spam') echo '<p>Spam détecté.</p>';
        if ($error_type === 'email_failed') echo '<p>Erreur lors de l\'envoi. Veuillez réessayer plus tard.</p>';
        echo '</div>';
    }
    
    if (isset($_GET['form_success'])) {
        echo '<div class="form-success"><p>Votre message a été envoyé avec succès. Nous vous répondrons bientôt.</p></div>';
    }
    ?>
    
    <form id="custom-contact-form" method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <input type="hidden" name="action" value="custom_contact_form">
        <?php wp_nonce_field('custom_contact_form', 'cf_nonce'); ?>
        
     
        <div class="form-group name">
            <label for="cf_name">
            <input type="text" name="cf_name" id="cf_name" placeholder="Votre nom*" required>
            </label>
        </div>
        
        <div class="form-group email">
            <label for="cf_email">
            <input type="email" name="cf_email" id="cf_email" placeholder="Votre email*" required>
            </label>
        </div>
        
        
        <div class="form-group message">
            <label for="cf_message">
            <textarea name="cf_message" id="cf_message"  placeholder="Message*" required></textarea>
            </label>
        </div>
        
        <!-- Honeypot anti-spam -->
        <div style="position: absolute; left: -9999px;">
            <input type="text" name="cf_honeypot" tabindex="-1" autocomplete="off">
        </div>
        
        <div class="button-background-primary button-background-animation form-submit">
            <input type="submit" name="cf_submit" value="Envoyer le message" class="btn">
            <span class="hover-bg"></span>
        </div>
        </div>
    </form>
