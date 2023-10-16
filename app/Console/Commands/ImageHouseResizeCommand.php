<?php

namespace App\Console\Commands;

use App\Models\Builder\HouseImagesModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImageHouseResizeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upload:houses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'upload houses photo for resize';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $photo = HouseImagesModel::where('isResize', 0)
          ->limit(100)
          ->get();

        Http::post(env('SERVICE_URL' . '/resize', [
          'photo' => $photo,
          'type' => 0
        ]));

        info('upload 100 photo for house');
    }
}
