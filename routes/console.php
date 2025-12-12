<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;

Mail::raw('Congrats for sending test email with Mailtrap!', function ($message) {
    $message->to('geotheoprofs@gmail.com')
        ->subject('You are awesome!');
});

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');





Artisan::command('send-mail', function () {
    $client = new Client([
        'base_uri' => 'https://send.api.mailtrap.io',
        'headers' => [
            'Api-Token' => env('4f9cda736ad9370c6c204934a436ff70'),
            'Content-Type' => 'application/json',
        ],
    ]);

    $emailData = [
        'from' => [
            'email' => 'hello@example.com',
            'name' => 'Mailtrap Test'
        ],
        'to' => [
            [
                'email' => 'geotheoprofs@gmail.com',
                'name' => 'GeoTheoprofs'
            ]
        ],
        'subject' => 'You are awesome!',
        'text' => 'Congrats for sending a test email with Mailtrap API!'
    ];

    try {
        $response = $client->post('/api/send', ['json' => $emailData]);
        $this->info('Mail sent successfully!');
        $this->info($response->getBody()->getContents());
    } catch (\Exception $e) {
        $this->error('Failed to send mail: ' . $e->getMessage());
    }
})->purpose('Send Mail via Mailtrap API');
