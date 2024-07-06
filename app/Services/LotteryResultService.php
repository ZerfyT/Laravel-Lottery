<?php

namespace App\Services;

use App\Models\Lottery;
use App\Models\PrintedList;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class LotteryResultService
{
    public static function saveLotteryResults(Lottery $lottery, $lotteryData)
    {
        try {
            // dd($lotteryData);
            $result = $lottery->results()->create(
                [
                    'data' => $lotteryData['data'],
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

    public static function generateRandomNumbers($pattern)
    {
        set_time_limit(300);
        info('pattern : ' . $pattern);
        $numbers = [];
        $numberCount = substr_count($pattern, '\d{2}');
        for ($i = 0; $i < $numberCount; $i++) {
            $numbers[] = random_int(1, 99);
        }

        $formattedNumbers = implode(' ', array_map(function ($number) {
            return str_pad($number, 2, '0', STR_PAD_LEFT);
        }, $numbers));

        Log::info("message: Lottery result generated. Lottery ID: " . $pattern . ' ' . $formattedNumbers);

        return $formattedNumbers;
    }

    public static function publishLotteryResult(Lottery $lottery, $temporyNumbersList)
    {
        Log::info("message: Publishing lottery result. Lottery ID: " . $lottery->id);
        $result = null;
        try {
            $result = $lottery->getLatestResult();
            $result->is_published = 1;
            $result->save();
        } catch (\Exception $e) {
            dd($e);
        }

        // dd($temporyNumbersList, $result);

        $winningDetails = self::generateWinningDetails($temporyNumbersList, $result->data);
        PrintedList::create([
            'result_id' => $result->id,
            'number_list' => json_encode($temporyNumbersList ),
            'winning_list' => json_encode($winningDetails)
        ]);

        // TODO: Generate winning details with prices and places.

    }

    public static function generateWinningDetails($temporyNumbersList, $resultNumbers)
    {
        $winningDetails = [
            'one_in_a_row' => 0,
            'two_in_a_row' => 0,
            'three_in_a_row' => 0,
            'four_in_a_row' => 0,
        ];
        $resultNumbers = explode(' ', $resultNumbers);
        // dd($temporyNumbersList, $resultNumbers);

        foreach ($temporyNumbersList as $temporyNumbers) {
            $temporyNumbers = explode(' ', $temporyNumbers);
            $matchedNumbers = array_intersect($temporyNumbers, $resultNumbers);

            if (count($matchedNumbers) == 4) {
                $winningDetails['four_in_a_row']++;
            } elseif (count($matchedNumbers) == 3) {
                $winningDetails['three_in_a_row']++;
            } elseif (count($matchedNumbers) == 2) {
                $winningDetails['two_in_a_row']++;
            } elseif (count($matchedNumbers) == 1) {
                $winningDetails['one_in_a_row']++;
            }
        }

        // dd($winningDetails);

        return $winningDetails;
    }

    public static function startLotteryRound($lotteryId)
    {
        $lottery = Lottery::find($lotteryId);
        $printedLotteryLimit = 5;

        Log::warning("message: Lottery round started.");
        if (isset($lottery)) {
            $lotteryLatestResult = $lottery->getLatestResult();
            Log::warning("message: Lottery result already published. Lottery ID: " . $lottery->id);

            if (isset($lotteryLatestResult->is_published) && $lotteryLatestResult->is_published == 0) {

                Log::warning("message: Lottery result not yet published. Lottery ID: " . $lottery->id);
                LotteryResultService::publishLotteryResult($lottery, json_decode(Redis::get('tempory_numbers_lottey_' . $lottery->id)));
                Redis::del('tempory_numbers_lottey_' . $lottery->id);
            }

            $temporyNumbersList = [];
            $resultNumbers = LotteryResultService::generateRandomNumbers($lottery->pattern);

            for ($i = 0; $i < $printedLotteryLimit; $i++) {
                $temporyNumbersList[] = LotteryResultService::generateRandomNumbers($lottery->pattern);
            }

            Redis::set('tempory_numbers_lottey_' . $lottery->id, json_encode($temporyNumbersList));
            LotteryResultService::saveLotteryResults($lottery, ['data' => $resultNumbers]);

            Log::info("message: Lottery result generated. Lottery ID: " . $lottery->id);
        }
    }
}
