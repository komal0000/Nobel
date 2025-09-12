<?php

namespace App\Console\Commands;

use App\Helper;
use App\Models\Blog;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImportJSON extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import notices from JSON file and download associated files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $json = file_get_contents(base_path('kmc_notices.json'));
        $data = json_decode($json, true);

        $this->info('Starting import of ' . count($data) . ' notices...');

        foreach($data as $item){
            $title = $item['title'];
            $date = $item['date'];
            $link = $item['link'] ?? null;
            $type = 10; // Notice type

            $this->info("Processing: {$title}");

            $downloadedFile = null;

            // Download file if link exists
            if ($link) {
                $downloadedFile = $this->downloadFile($link, $title);
                if ($downloadedFile) {
                    $this->info("Downloaded: {$downloadedFile}");
                } else {
                    $this->error("Failed to download file from: {$link}");
                }
            }

            // Create blog entry
            $blog = new Blog();
            $blog->title = $title;
            $blog->single_page_image = $downloadedFile;
            $blog->type = $type;
            $blog->creator_user_id = 1;
            $blog->blog_category_id = 9;
            $blog->date = Helper::convertDateToInteger($date);
            $blog->save();

            $this->info("Created blog entry with ID: {$blog->id}");
        }

        $this->info('Import completed successfully!');
    }

    /**
     * Download file from URL and store in uploads/blogcategory/10
     *
     * @param string $url
     * @param string $title
     * @return string|null
     */
    private function downloadFile($url, $title)
    {
        try {
            // Get file extension from URL or default to pdf
            $urlParts = parse_url($url);
            $pathInfo = pathinfo($urlParts['path'] ?? '');
            $extension = $pathInfo['extension'] ?? 'pdf';

            // Create a safe filename from title
            $safeTitle = Str::slug($title);
            $filename = $safeTitle . '_' . time() . '.' . $extension;

            // Download the file
            $response = Http::timeout(30)->get($url);

            if ($response->successful()) {
                // Ensure directory exists
                $uploadPath = public_path('uploads/blogcategory/10');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                // Save file
                $filePath = $uploadPath . '/' . $filename;
                file_put_contents($filePath, $response->body());

                // Return relative path for database storage
                return 'uploads/blogcategory/10/' . $filename;
            }

            return null;
        } catch (\Exception $e) {
            $this->error("Error downloading file: " . $e->getMessage());
            return null;
        }
    }
}
