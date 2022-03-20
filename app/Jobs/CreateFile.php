<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $newName;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($newName)
    {
        $this->newName = $newName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $img = \Intervention\Image\Facades\Image::make(public_path('storage/cover/'.$this->newName));
        $img->fit(200,200)->save(public_path('storage/cover/square_'.$this->newName));

        $img = \Intervention\Image\Facades\Image::make(public_path('storage/cover/'.$this->newName));
        $img->resize(300,null,function ($c){
            $c->aspectRatio();
        })->save(public_path('storage/cover/resize_'.$this->newName));

    }
}
