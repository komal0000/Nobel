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
            $imageUrl = $item['imageUrl'] ?? null;
            $type = 10; // Notice type

            $this->info("Processing: {$title}");

            // Check if blog with same title already exists
            $existingBlog = Blog::where('title', $title)->where('type', $type)->first();
            if ($existingBlog) {
                $this->info("Skipping - Blog already exists with ID: {$existingBlog->id}");
                continue;
            }
            $downloadedFile = null;
            $downloadedImage = null;

            // Download file if link exists
            if ($link) {
                $downloadedFile = $this->downloadFile($link, $title, 'document');
                if ($downloadedFile) {
                    $this->info("Downloaded document: {$downloadedFile}");
                } else {
                    $this->error("Failed to download file from: {$link}");
                }
            }

            // Download image if imageUrl exists
            if ($imageUrl) {
                $downloadedImage = $this->downloadFile($imageUrl, $title, 'image');
                if ($downloadedImage) {
                    $this->info("Downloaded image: {$downloadedImage}");
                } else {
                    $this->error("Failed to download image from: {$imageUrl}");
                }
            }

            // Create blog entry
            $blog = new Blog();
            $blog->title = $title;
            $blog->single_page_image = $downloadedImage; // Use image for single_page_image
            $blog->type = $type;
            $blog->creator_user_id = 1;
            $blog->blog_category_id = 1;
            $blog->date = Helper::convertDateToInteger($date);
            $blog->image = $downloadedImage; // Store image path if exists
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
     * @param string $type (document|image)
     * @return string|null
     */
    private function downloadFile($url, $title, $type = 'document')
    {
        try {
            // Get file extension from URL or default based on type
            $urlParts = parse_url($url);
            $pathInfo = pathinfo($urlParts['path'] ?? '');
            $extension = $pathInfo['extension'] ?? ($type === 'image' ? 'jpg' : 'pdf');

            // Create a safe filename from title
            $safeTitle = Str::slug($title);
            $prefix = $type === 'image' ? 'img_' : 'doc_';
            $filename = $prefix . $safeTitle . '_' . time() . '.' . $extension;

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
            $this->error("Error downloading {$type}: " . $e->getMessage());
            return null;
        }
    }
}
