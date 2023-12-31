<?php

namespace App\Jobs;

use App\Enums\UserRole;
use App\Enums\UserType;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Hash;
use Stancl\Tenancy\Contracts\TenantWithDatabase;

class CreateTenantAdmin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected TenantWithDatabase $tenant;

    public function __construct(TenantWithDatabase $tenant)
    {
      $this->tenant = $tenant;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->tenant->run(function () {
          $adminUser = User::create([
            'name' => $this->tenant->name,
            'password' => Hash::make($this->tenant->password),
            'email' => $this->tenant->email,
            'email_verified_at' => $this->tenant->created_at,
            'username' => $this->tenant->username,
            'type' => UserType::Tenant->value
          ]);

          $adminUser->assignRole(UserRole::TenantAdmin->value);
        });

        // We no longer need this password on the Tenant model
        $this->tenant->password = null;
        $this->tenant->save();
    }
}
