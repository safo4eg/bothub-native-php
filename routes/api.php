<?php

use Core\Facades\Route;
use \App\Http\Controllers\Webhook;

Route::get('/webhook', [Webhook::class, 'post']);