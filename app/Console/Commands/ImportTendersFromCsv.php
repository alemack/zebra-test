<?php

namespace App\Console\Commands;

use App\Models\Tender;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ImportTendersFromCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:tenders {path=storage/app/test_task_data.csv}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import tenders from CSV file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = $this->argument('path');
        if (!file_exists($path)) {
            $this->error("File not found: $path");
            return 1;
        }

        $handle = fopen($path, 'r');
        $header = fgetcsv($handle, 1000, ',');

        while (($row = fgetcsv($handle, 1000, ',')) !== false) {
            Tender::create([
                'external_code' => $row[0],
                'number' => $row[1],
                'status' => $row[2],
                'name' => $row[3],
                'updated_at' => Carbon::createFromFormat('d.m.Y H:i:s', $row[4])->toDateTimeString(),
            ]);
        }
        fclose($handle);

        $this->info('Tenders imported');
        return 0;
    }
}
