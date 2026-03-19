<?php

namespace Theme_base;

class MessengerWebhook
{
    private const REST_NAMESPACE = 'messenger/v1';
    private const REST_ROUTE     = 'webhook';

    public function __construct()
    {
        add_action('rest_api_init', [$this, 'registerWebhookRoute']);
    }

    public function registerWebhookRoute(): void
    {
        register_rest_route(self::REST_NAMESPACE, '/' . self::REST_ROUTE, [
            'methods'             => ['GET', 'POST'],
            'callback'            => [$this, 'handleWebhook'],
            'permission_callback' => '__return_true',
        ]);
    }

    public function handleWebhook($request)
    {
        if ($request->get_method() === 'GET') {
            return $this->handleVerification($request);
        }

        if ($request->get_method() === 'POST') {
            return $this->handleEvent($request);
        }

        return new \WP_REST_Response('Method Not Allowed', 405);
    }

    private function handleVerification($request)
    {
        $mode      = $request->get_param('hub_mode');
        $token     = $request->get_param('hub_verify_token');
        $challenge = $request->get_param('hub_challenge');

        $verifyToken = get_field('messenger_verify_token', 'option') ?? '';

        if ($mode === 'subscribe' && $verifyToken && $token === $verifyToken) {
            return new \WP_REST_Response((int) $challenge, 200);
        }

        return new \WP_REST_Response('Forbidden', 403);
    }

    private function handleEvent($request)
    {
        $body = $request->get_json_params();

        if (isset($body['object']) && $body['object'] === 'page') {
            foreach ($body['entry'] ?? [] as $entry) {
                foreach ($entry['messaging'] ?? [] as $event) {
                    // Traiter les messages ici
                    error_log('Messenger event: ' . wp_json_encode($event));
                }
            }
            return new \WP_REST_Response('EVENT_RECEIVED', 200);
        }

        return new \WP_REST_Response('Not Found', 404);
    }
}
