<?php

namespace App\Console\Commands;

use App\Model\Package;
use App\Model\Payment;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;

class PaymentCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Payment Cron Successfully Started';

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
            
            $package_days = Package::first();
            $payment_array = Payment::get();
            $today = Carbon::now();

            foreach($payment_array as $key => $value){

                $payment_date = $value->created_at;
                $date_difference = $today->diffInDays($payment_date);

                if($date_difference > $package_days->validity){
                    
                    $update_payment = Payment::findOrFail($value->id);
                    $update_payment->is_active = 'No';
                    $update_payment->save();
                }

            }

        } catch (Exception $e) {
            return $e;
        }
    }
}
