<?php

namespace App\Jobs;

use App\Models\Visit;
use Illuminate\Support\Facades\Redis;
use DB;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class visitsAddDB implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $input;

    public function __construct($input)
    {
        $this->input = $input;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {  /*
        Redis::lrange('Vst',0,-1);
        DB::table('visits')->insert([
            ['user_id' => '1111165759f543192858a37388230245', 'date' => '2022-02-08 19:47:31',],
            ['user_id' => '1111165759f543192858a37388230245', 'date' => '2022-02-08 19:47:31',],
            ['user_id' => '1111165759f543192858a37388230245', 'date' => '2022-02-08 19:47:31',],
            ['user_id' => '1111165759f543192858a37388230245', 'date' => '2022-02-08 19:47:31',],

        ]);
        */
        Visit::create($this->input);
    }
}
