<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

class MakeModule extends Command
{
    protected $signature = 'make:module {name}';
    protected $description = 'Tạo module với cấu trúc chuẩn';
    protected $files;

    public function __construct()
    {
        parent::__construct();
        $this->files = new Filesystem;
    }

    public function handle()
    {
        $createdFiles = [];
        $createdDirectories = [];

        try {
            $timestamp = now()->format('Y_m_d_His');
            $module = Str::studly($this->argument('name'));
            $lowerModule = Str::plural(Str::snake($module));  

            $createdFiles[] = $this->generateFile('Model.stub', "app/Models/{$module}.php", $module);
            #$createdFiles[] = $this->generateFile('Migration.stub', "database/migrations/{$timestamp}_create_{$lowerModule}_table.php", $module);
            $createdFiles[] = $this->generateFile('Controller.stub', "app/Http/Controllers/{$module}Controller.php", $module);
            $createdFiles[] = $this->generateFile('Repository.stub', "app/Repositories/{$module}/{$module}Repository.php", $module);
            $createdFiles[] = $this->generateFile('RepositoryInterface.stub', "app/Repositories/{$module}/{$module}RepositoryInterface.php", $module);
            $createdFiles[] = $this->generateFile('FormRequest.stub', "app/Http/Requests/{$module}Request.php", $module);
            $createdFiles[] = $this->generateFile('Filter.stub', "app/Filters/{$module}Filter.php", $module);

            $this->info("Module {$module} created successfully.");
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
            foreach ($createdFiles as $file) {
                if ($file && $this->files->exists($file)) {
                    $this->files->delete($file);
                    $this->warn("Deleted file: {$file}");
                }
            }
        
            foreach (array_reverse($createdDirectories) as $dir) {
                if ($this->files->isDirectory($dir)) {
                    $this->files->deleteDirectory($dir);
                    $this->warn("Deleted directory: {$dir}");
                }
            }
        }
    }

    protected function generateFile($stubFile, $targetPath, $module, &$createdDirectories = [])
    {
        $lowerModule = Str::snake($module);
        $lowerModule = Str::plural(Str::snake($module));  
        $stubPath = base_path("stubs/{$stubFile}");
        $content = $this->files->get($stubPath);
        $content = str_replace(['{{Module}}', '{{module}}'], [$module, $lowerModule], $content);

        $fullPath = base_path($targetPath);
        $directory = dirname($fullPath);

        if (!$this->files->isDirectory($directory)) {
            $this->files->makeDirectory($directory, 0755, true);
            $createdDirectories[] = $directory;
        }

        $this->files->put($fullPath, $content);
        return $fullPath;
    }

    protected function makeDirectory($path)
    {
        if (!$this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0755, true);
        }
    }
}
