<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixForeignKeys extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:fix-foreign-keys {--force : Force the operation without confirmation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix foreign key constraint issues by cleaning orphaned records';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (!$this->option('force')) {
            if (!$this->confirm('This will clean orphaned records that violate foreign key constraints. Continue?')) {
                $this->info('Operation cancelled.');
                return 0;
            }
        }

        $this->info('Starting to fix foreign key constraints...');

        try {
            DB::beginTransaction();

            // Clean brand_localizations with invalid brand_id
            $this->info('Cleaning brand_localizations with invalid brand_id...');
            $deleted = DB::table('brand_localizations')
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('brands')
                        ->whereRaw('brands.id = brand_localizations.brand_id');
                })
                ->delete();
            $this->info("Deleted {$deleted} orphaned brand_localizations records.");

            // Clean brand_localizations with invalid meta_image
            $this->info('Cleaning brand_localizations with invalid meta_image...');
            $deleted = DB::table('brand_localizations')
                ->whereNotNull('meta_image')
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('media_managers')
                        ->whereRaw('media_managers.id = brand_localizations.meta_image');
                })
                ->update(['meta_image' => null]);
            $this->info("Fixed {$deleted} brand_localizations records with invalid meta_image.");

            // Clean other common orphaned records
            $this->info('Cleaning category_localizations with invalid category_id...');
            $deleted = DB::table('category_localizations')
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('categories')
                        ->whereRaw('categories.id = category_localizations.category_id');
                })
                ->delete();
            $this->info("Deleted {$deleted} orphaned category_localizations records.");

            // Clean product_localizations with invalid product_id
            $this->info('Cleaning product_localizations with invalid product_id...');
            $deleted = DB::table('product_localizations')
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('products')
                        ->whereRaw('products.id = product_localizations.product_id');
                })
                ->delete();
            $this->info("Deleted {$deleted} orphaned product_localizations records.");

            DB::commit();

            $this->info('✅ Successfully fixed foreign key constraints!');
            $this->info('🎯 You can now import your SQL file without foreign key errors.');

        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('❌ Error occurred while fixing foreign keys: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
