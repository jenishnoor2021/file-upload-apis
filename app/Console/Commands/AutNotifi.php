<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use App\Models\Branch;
use Carbon\Carbon;
use File;
use Illuminate\Support\Facades\Log;

class AutNotifi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aut:notifi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $branches = Branch::where('created_at', '<', Carbon::now()->subHours(24))->get();
            // $branches = Branch::where('created_at', '<', Carbon::now()->subMinutes(1))->get();

            foreach ($branches as $branch) {

                // $imageName = str_replace('http://127.0.0.1:8000/branchimg/', '', $branch->image);
                $imageName = str_replace('https://uploadfile.sevenstepsschool.org/branchimg/', '', $branch->image);

                $filePath = public_path('branchimg/' . $imageName);

                if (File::exists($filePath)) {
                    File::delete($filePath);
                }

                $branch->delete();
            }

            Log::info('Records older than 1 minute and images removed successfully.');
        } catch (\Exception $e) {
            Log::error('Error removing records and images: ' . $e->getMessage());
        }
    }
}
