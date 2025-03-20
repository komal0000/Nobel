<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class Pullcss extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pull:css';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $response = Http::get('https://raw.githubusercontent.com/Amrit-Rijal-01/hospital-ui/refs/heads/main/public/front/css/index.css');

            if ($response->successful()) {
                $cssContent = $response->body();
                $output = 'front/assets/css/index.css';
                // Ensure the output directory exists
                $fullOutputPath = public_path($output);
                $directory = dirname($fullOutputPath);
                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }

                // Save the CSS content to the file
                file_put_contents($fullOutputPath, $cssContent);

                $this->info("CSS successfully saved to: {$fullOutputPath}");
            } else {
                $this->error("Failed to fetch CSS. HTTP Status: " . $response->status());
            }
        } catch (\Exception $e) {
            $this->error("Error fetching CSS: " . $e->getMessage());
        }
    }

}
