<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:cache';

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
        $cacheDirectory = resource_path('views/front/cache');

        if (is_dir($cacheDirectory)) {
            $this->deleteDirectoryContents($cacheDirectory);
            $this->info('Front-end cache cleared successfully.');
        } else {
            $this->warn("Cache directory not found at: {$cacheDirectory}");
        }
    }

    /**
     * Recursively delete directory contents without removing the directory itself
     *
     * @param string $directory
     * @return void
     */
    private function deleteDirectoryContents($directory)
    {
        if (!is_dir($directory)) {
            return;
        }

        $items = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directory, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($items as $item) {
            $path = $item->getRealPath();

            if ($item->isDir()) {
                // Skip the base cache directory itself
                if ($path !== $directory) {
                    rmdir($path);
                    $this->info("Deleted directory: " . str_replace($directory . '/', '', $path));
                }
            } else {
                unlink($path);
                $this->info("Deleted file: " . str_replace($directory . '/', '', $path));
            }
        }
    }
}
