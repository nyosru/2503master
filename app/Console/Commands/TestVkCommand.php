<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TestVkCommand extends Command
{
    protected $signature = 'test:vk';
    protected $description = 'Test VK API connection';

    public function handle()
    {
        $token = config('services.vk.service_token');
        $userId = env('VK_ADMIN_ID');

        $this->info("Token: " . substr($token, 0, 10) . '...');
        $this->info("User ID: " . $userId);

        // Test users.get
        $response = Http::get('https://api.vk.com/method/users.get', [
            'access_token' => $token,
            'user_ids' => $userId,
            'v' => '5.131'
        ]);

        $this->info("Users.get response: " . json_encode($response->json()));

        // Test messages.send
        $response2 = Http::asForm()->post('https://api.vk.com/method/messages.send', [
            'access_token' => $token,
            'user_id' => $userId,
            'message' => 'Test from artisan command',
            'random_id' => rand(1, 1000000),
            'v' => '5.131'
        ]);

        $this->info("Messages.send response: " . json_encode($response2->json()));

        return 0;
    }
}
