<?php

namespace App\Console\Commands;

use App\Models\Attendence;
use App\Models\User;
use Illuminate\Console\Command;
use Carbon\Carbon;

class DailyUpdateAttendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:updateAttendance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command Update Attendance Daily At 1PM.';

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
        $user = User::all();
        foreach ($user as $user) {
            $check = Attendence::where('user_id', $user->id)
                ->whereDate('created_at', Carbon::today())->first();
            if (!$check) {
                $addEntry = new Attendence;
                $addEntry->user_id = $user->id;
                $addEntry->is_present = '0';
                $addEntry->entry_ip = '';
                $addEntry->entry_location = '';
                $addEntry->exit_ip = '';
                $addEntry->exit_location = '';
                $addEntry->created_at = Carbon::now();
                $addEntry->save();
            }
        }
        // return 0;
    }
}
