<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Restaurant; 
use Illuminate\Support\Facades\Log;

class UpdateRestaurantStatusByDateTime extends Command
{
    protected $signature = 'restaurants:update-status-by-datetime';
    protected $description = 'Update restaurant status based on custom date and time';

    public function handle()
    {
        $now = Carbon::now('Asia/Kolkata');
        $restaurantsToUpdate = Restaurant::where('self_pickup', 0)
            ->whereNotNull('enable_self_pickup_date')
            ->whereNotNull('enable_self_pickup_time')
            ->where('enable_self_pickup_date', '<=', $now->toDateString())
            ->where('enable_self_pickup_time', '<=', $now->format('H:i:s'))
            ->get();
            
            Log::warning("cron working resturant disable");
            
        foreach ($restaurantsToUpdate as $restaurant) {
                Log::warning("cron working resturant Enable");
            
            $restaurant->update([
                'self_pickup' => 1,
                'enable_self_pickup_date' => null,
                'enable_self_pickup_time' => null,
            ]);
        }

        $this->info('Self Pickup updated based on custom date and time.');
    }
}
