<?php

use Core\Facades\Route;
use \App\Http\Controllers\Webhook;

Route::post('/webhook', [Webhook::class, 'post']);