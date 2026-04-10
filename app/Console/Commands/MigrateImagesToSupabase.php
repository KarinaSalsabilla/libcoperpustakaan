<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class MigrateImagesToSupabase extends Command
{
    protected $signature = 'migrate:images';
    protected $description = 'Migrate images from local to Supabase';

    public function handle()
    {
        $folders = ['covers', 'ebooks', 'foto'];

        foreach ($folders as $folder) {
            $files = Storage::disk('public')->allFiles($folder);

            $this->info("📁 Folder: $folder — " . count($files) . " file ditemukan");

            if (empty($files)) {
                $this->warn("  ⚠️ Tidak ada file di folder $folder");
                continue;
            }

            foreach ($files as $file) {
                $this->info("  Uploading: $file");
                $content = Storage::disk('public')->get($file);
                $result = Storage::disk('supabase')->put($file, $content, 'public');
                
                if ($result) {
                    $this->info("  ✅ Done: $file");
                } else {
                    $this->error("  ❌ Gagal: $file");
                }
            }
        }

        $this->info('🎉 Migrasi selesai!');
    }
}