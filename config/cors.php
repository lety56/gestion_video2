<?php
return [
    /*
     * Paths for which CORS headers should be added.
     */
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    /*
     * Allowed HTTP methods (e.g., GET, POST, PUT, DELETE).
     */
    'allowed_methods' => ['*'],

    /*
     * Allowed origins (domains) for cross-origin requests.
     */
    'allowed_origins' => ['*'],  // * pour tout autoriser, ou tu peux mettre des domaines spécifiques comme ['http://example.com']

    /*
     * Allowed headers for requests.
     */
    'allowed_headers' => ['*'],

    /*
     * Exposed headers that can be sent to the browser.
     */
    'exposed_headers' => [],

    /*
     * Maximum age for caching the CORS headers.
     */
    'max_age' => 0,

    /*
     * Whether or not the CORS response should include the `Access-Control-Allow-Credentials` header.
     */
    'supports_credentials' => false,
];
