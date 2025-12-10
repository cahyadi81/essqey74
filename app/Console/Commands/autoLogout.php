<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class autoLogout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'autologout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $this->logout('demo');
        $this->logout('pma');
        $this->logout('jalusi');
        $this->logout('sinar_anugrah');
        $this->logout('addroo');
        $this->logout('pma_testing');
        $this->logout('yafindo');
    }

    public function logout($target)
    {
        DB::disconnect(config('database.default'));
        //Config::set('database.default', '');
            //config(['database.connections.demo' => $jalusi ]);
        config(['database.default' => $target ]);

        $user = DB::update(
            DB::raw("
            update user set is_login = '0', first_login = '1'
            where TIMESTAMPDIFF(SECOND,last_login,NOW()) > 3600"));
        
        if($user){
            $this->info('success auto logout ('. date("Y-m-d H:i:s") .') ');
        }

        
    }
}
