<?php

namespace App\Mail;

use App\Models\Tenant;
use Illuminate\Mail\Mailable;

class TenantBalanceMail extends Mailable
{
    public $tenant;
    public $balanceDetails;

    public function __construct($tenant, $balanceDetails)
    {
        $this->tenant = $tenant;
        $this->balanceDetails = $balanceDetails;
    }

    public function build()
{
    return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                ->subject('Your Tenant Balance Information')
                ->view('emails.tenant_balance')
                ->with([
                    'tenant' => $this->tenant,
                    'balanceDetails' => $this->balanceDetails,
                ]);
}

}
