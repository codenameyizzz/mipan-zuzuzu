<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class updateMahasiswaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:mahasiswa';

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
        User::where('role', 'mahasiswa')->update([
            'role' => 'alumni'
        ]);
    }
}
