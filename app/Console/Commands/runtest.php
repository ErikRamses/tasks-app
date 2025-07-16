<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class runtest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'runtest:commandt';

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
        $exists = Storage::disk('s3')->exists('aui_media/documents/c424b65a-cf9f-494d-aa87-42261f375c0e.docx');

        if ($exists) {
            echo 'Existe';
        } else {
            echo 'No existe';
        }
    }
}
