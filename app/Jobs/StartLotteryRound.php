<?php

namespace App\Jobs;

use App\Models\Lottery;
use App\Services\LotteryResultService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class StartLotteryRound implements ShouldQueue, ShouldBeUniqueUntilProcessing
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    // public $uniqueFor = 10;

    private $lotteries = null;
    private $lotteryLimit = 5;

    public function __construct()
    {
        $this->lotteries = Lottery::select('id', 'pattern')->where('is_active', 1)->get();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::warning("message: Lottery round started.");
        if(isset($this->lotteries) && count($this->lotteries) > 0) {
            Log::warning("message: Lottery Count: " . count($this->lotteries));
            foreach ($this->lotteries as $lottery) {

                // if($lottery->getLatestResult()->is_published == 1) {
                //     Log::warning("message: Lottery result already published. Lottery ID: " . $lottery->id);

                // }
                // else {
                //     LotteryResultService::publishLotteryResult($lottery, Redis::get('tempory_numbers_lottey_' . $lottery->id));
                //     Redis::del('tempory_numbers_lottey_' . $lottery->id);
                // }
                $lotteryLatestResult = $lottery->getLatestResult();
                Log::warning("message: Lottery result already published. Lottery ID: " . $lottery->id);

                if(isset($lotteryLatestResult->is_published) && $lotteryLatestResult->is_published == 0) {

                    Log::warning("message: Lottery result not yet published. Lottery ID: " . $lottery->id);
                    LotteryResultService::publishLotteryResult($lottery, Redis::get('tempory_numbers_lottey_' . $lottery->id));
                    Redis::del('tempory_numbers_lottey_' . $lottery->id);
                }

                $temporyNumbersList = [];
                $resultNumbers = LotteryResultService::generateRandomNumbers($lottery->pattern);

                for ($i = 0; $i < $this->lotteryLimit; $i++) {
                    $temporyNumbersList[] = LotteryResultService::generateRandomNumbers($lottery->pattern);
                }

                $temporyNumbersList = json_encode($temporyNumbersList);
                Redis::set('tempory_numbers_lottey_' . $lottery->id, $temporyNumbersList);
                LotteryResultService::saveLotteryResults($lottery, ['data' => $resultNumbers]);

                Log::info("message: Lottery result generated. Lottery ID: " . $lottery->id);
            }
        }
    }

    // public function uniqueId(): string
    // {
    //     return Carbon::now()->timestamp;
    // }
}
