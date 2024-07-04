<?php

namespace App\Services;

use App\Models\Lottery;
use Illuminate\Support\Facades\Log;

class LotteryResultService
{
    public static function saveLotteryResults(Lottery $lottery, $lotteryData)
    {
        try {
            $result = $lottery->results()->create(
                [
                    'data' => $lotteryData->data,
                    'date' => now(),
                    'round' => $lottery->getLatestResult()->round + 1
                ]
            );
            Log::info("message: Lottery result saved. Lottery ID: " . $lottery->id);
        } catch (\Exception $e) {
            dd($e);
        }

        return true;
    }

    public static function generateRandomNumbers($pattern) {
        do {
            $randomNumber = rand(1, 99);
            $randomString = str_pad($randomNumber, 2, '0', STR_PAD_LEFT);
        } while (!preg_match($pattern, $randomString));

        Log::info($randomString);

        return $randomString;
    }

    public static function publishLotteryResult(Lottery $lottery, $temporyNumbersList)
    {
        Log::info("message: Publishing lottery result. Lottery ID: " . $lottery->id);
        try {
            $result = $lottery->getLatestResult();
            $result->is_published = 1;
            $result->save();
        }
        catch (\Exception $e) {
            dd($e);
        }

        // TODO: Generate winning details with prices and places.
    }
}
