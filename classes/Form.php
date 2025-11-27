<?php

namespace Theme_base;

class Form
{
    private const ACTION_NAME = 'custom_contact_form';
    private const NONCE_NAME = 'custom_contact_form';
    private const HONEYPOT_FIELD = 'cf_honeypot';

    public function __construct()
    {
        add_action('admin_post_' . self::ACTION_NAME, [$this, 'handleSubmission']);
        add_action('admin_post_nopriv_' . self::ACTION_NAME, [$this, 'handleSubmission']);
    }

    /**
     * Handle form submission
     */
    public function handleSubmission(): void
    {
        if (!$this->verifySecurity()) {
            $this->redirectError('security');
            return;
        }

        if (!$this->checkHoneypot()) {
            $this->redirectError('spam');
            return;
        }

        $data = $this->sanitizeInputs();
        $errors = $this->validateInputs($data);

        if (!empty($errors)) {
            $this->redirectValidationErrors($errors);
            return;
        }

        if ($this->sendEmail($data)) {
            $this->redirectSuccess();
        } else {
            $this->redirectError('email_failed');
        }
    }

    /**
     * Verify nonce security
     */
    private function verifySecurity(): bool
    {
        return isset($_POST['cf_nonce']) && wp_verify_nonce($_POST['cf_nonce'], self::NONCE_NAME);
    }

    /**
     * Check honeypot for spam detection
     */
    private function checkHoneypot(): bool
    {
        return empty($_POST[self::HONEYPOT_FIELD]);
    }

    /**
     * Sanitize all form inputs
     */
    private function sanitizeInputs(): array
    {
        return [
            'name' => sanitize_text_field($_POST['cf_name'] ?? ''),
            'email' => sanitize_email($_POST['cf_email'] ?? ''),
            'message' => sanitize_textarea_field($_POST['cf_message'] ?? ''),
        ];
    }

    /**
     * Validate form inputs
     */
    private function validateInputs(array $data): array
    {
        $errors = [];

        if (empty($data['name'])) {
            $errors[] = 'name';
        }

        if (empty($data['email']) || !is_email($data['email'])) {
            $errors[] = 'email';
        }

        if (empty($data['message'])) {
            $errors[] = 'message';
        }

        return $errors;
    }

    /**
     * Send email notification
     */
    private function sendEmail(array $data): bool
    {
        $to = get_option('admin_email');
        $subject = sprintf('Nouveau message de %s', esc_html($data['name']));
        
        $headers = [
            'Content-Type: text/html; charset=UTF-8',
            sprintf('From: %s <%s>', get_option('blogname'), get_option('admin_email')),
            sprintf('Reply-To: %s <%s>', esc_html($data['name']), sanitize_email($data['email'])),
        ];

        $message_body = sprintf(
            '<p><strong>Nom:</strong> %s<br><strong>Email:</strong> %s<br><strong>Message:</strong></p>%s',
            esc_html($data['name']),
            sanitize_email($data['email']),
            wp_kses_post(wpautop($data['message']))
        );

        return wp_mail($to, $subject, $message_body, $headers);
    }

    /**
     * Get form anchor URL
     */
    private function getFormAnchor(): string
    {
        return '#section-form-title';
    }

    /**
     * Redirect on validation errors
     */
    private function redirectValidationErrors(array $errors): void
    {
        $url = home_url('/?form_errors=' . implode(',', $errors) . $this->getFormAnchor());
        wp_safe_redirect($url);
        exit;
    }

    /**
     * Redirect on error
     */
    private function redirectError(string $error_type): void
    {
        $url = home_url('/?form_error=' . sanitize_key($error_type) . $this->getFormAnchor());
        wp_safe_redirect($url);
        exit;
    }

    /**
     * Redirect on success
     */
    private function redirectSuccess(): void
    {
        $url = home_url('/?form_success=1' . $this->getFormAnchor());
        wp_safe_redirect($url);
        exit;
    }
}
