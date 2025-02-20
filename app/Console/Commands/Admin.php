<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class Admin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To create an admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Ask user for attributes
        $name = $this->ask('Enter admin name');
        $email = $this->ask('Enter admin email');
        $password = $this->ask('Enter password');

        $admin = new User();
        $admin->name = $name;
        $admin->email = $email;
        $admin->password = bcrypt($password);
        $admin->role = 1;
        $admin->save();

        if ($admin) {
            $this->info("✅ Admin user created successfully.");
        } else {
            $this->error("❌ Failed to create the admin user.");
        }
    }
}
