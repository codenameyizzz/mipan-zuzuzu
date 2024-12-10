<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Prodi;
use App\Models\Alumni;
use App\Models\Fakultas;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AlumniCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:alumni-data';

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


        DB::beginTransaction();
        try {
            foreach ($data_alumni as $data) {
                $fakultas = Fakultas::where('name', $data['fakultas'])->first();
                $prodi = Prodi::where('name', $data['prodi_name'])->first();

                if (!$fakultas) {
                    $fakultas = Fakultas::create([
                        'name' => $data['fakultas']
                    ]);
                }

                if (!$prodi) {
                    $prodi = Prodi::create([
                        'name' => $data['prodi_name'],
                        'fakultas_id' => $fakultas->id
                    ]);
                }

                $user = User::create([
                    'name' => $data['nama'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['nim']),
                    'role' => 'mahasiswa'
                ]);

                Alumni::create([
                    'name' => $data['nama'],
                    'nim' => $data['nim'],
                    'angkatan' => $data['angkatan'],
                    'status' => $data['status'],
                    'user_id' => $user->id,
                    'fakultas_id' => $fakultas->id,
                    'prodi_id' => $prodi->id,
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->info($th);
        }

        return $this->info('Data Mahasiswa Berhasil Diinputkan');
    }
}
