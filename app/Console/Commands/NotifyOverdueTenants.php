<?php

namespace App\Console\Commands;

use App\Mail\OverdueRentNotification;
use App\Models\Tenant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class NotifyOverdueTenants extends Command
{
    protected $signature = 'notify:overdue-tenants';
    protected $description = 'Send email notifications to tenants with overdue rent';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Fetch tenants with overdue rent
        $overdueTenants = Tenant::where('due_date', '<', now())->get();

        foreach ($overdueTenants as $tenant) {
            Mail::to($tenant->email)->send(new OverdueRentNotification($tenant));
            $this->info("Notification sent to: {$tenant->email}");
        }

        $this->info('All overdue notifications sent.');
    }
}
