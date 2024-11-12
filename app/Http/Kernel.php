protected $routeMiddleware = [
    // andere middleware
    'admin' => \App\Http\Middleware\AdminMiddleware::class, // Voeg deze regel toe
];
