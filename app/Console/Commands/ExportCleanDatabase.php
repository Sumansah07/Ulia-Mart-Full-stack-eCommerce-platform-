<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ExportCleanDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:export-clean {filename?} {--force : Force overwrite existing file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export a clean database SQL file ready for production deployment';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filename = $this->argument('filename') ?: 'clean_database_' . date('Y_m_d_H_i_s') . '.sql';
        
        if (file_exists($filename) && !$this->option('force')) {
            if (!$this->confirm("File {$filename} already exists. Overwrite?")) {
                $this->info('Export cancelled.');
                return 0;
            }
        }

        $this->info('Starting clean database export...');

        try {
            // First, clean the database
            $this->info('Step 1: Cleaning orphaned records...');
            $this->call('db:fix-foreign-keys', ['--force' => true]);

            // Get database connection details
            $database = config('database.connections.mysql.database');
            $username = config('database.connections.mysql.username');
            $password = config('database.connections.mysql.password');
            $host = config('database.connections.mysql.host');
            $port = config('database.connections.mysql.port') ?: 3306;

            $this->info('Step 2: Exporting database...');

            // Build mysqldump command
            $command = sprintf(
                'mysqldump --host=%s --port=%s --user=%s --password=%s --single-transaction --routines --triggers --add-drop-table --disable-keys --extended-insert %s > %s',
                escapeshellarg($host),
                escapeshellarg($port),
                escapeshellarg($username),
                escapeshellarg($password),
                escapeshellarg($database),
                escapeshellarg($filename)
            );

            // Execute the command
            $output = [];
            $returnCode = 0;
            exec($command, $output, $returnCode);

            if ($returnCode !== 0) {
                $this->error('Failed to export database using mysqldump.');
                $this->error('Make sure mysqldump is installed and accessible.');
                return 1;
            }

            // Add foreign key disable/enable statements
            $this->info('Step 3: Adding foreign key safety statements...');
            $sqlContent = file_get_contents($filename);
            
            $cleanSql = "-- Clean Database Export for Production\n";
            $cleanSql .= "-- Generated on: " . date('Y-m-d H:i:s') . "\n";
            $cleanSql .= "-- Safe for import without foreign key constraint errors\n\n";
            $cleanSql .= "SET FOREIGN_KEY_CHECKS=0;\n";
            $cleanSql .= "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\n";
            $cleanSql .= "START TRANSACTION;\n";
            $cleanSql .= "SET time_zone = \"+00:00\";\n\n";
            $cleanSql .= $sqlContent;
            $cleanSql .= "\n\nSET FOREIGN_KEY_CHECKS=1;\n";
            $cleanSql .= "COMMIT;\n";

            file_put_contents($filename, $cleanSql);

            $this->info('✅ Clean database exported successfully!');
            $this->info("📁 File: {$filename}");
            $this->info('🎯 This file is ready for production deployment.');
            $this->info('💡 Your client can import this without foreign key errors.');

            // Show file size
            $fileSize = round(filesize($filename) / 1024 / 1024, 2);
            $this->info("📊 File size: {$fileSize} MB");

        } catch (\Exception $e) {
            $this->error('❌ Error occurred during export: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
