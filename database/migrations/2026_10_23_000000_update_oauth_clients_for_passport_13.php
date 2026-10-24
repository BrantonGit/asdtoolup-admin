<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bring the legacy Passport clients table in line with Passport 13.
     */
    public function up(): void
    {
        if (! Schema::hasTable('oauth_clients')) {
            return;
        }

        Schema::table('oauth_clients', function (Blueprint $table) {
            $table->string('provider')->nullable()->after('secret');
            $table->text('grant_types')->nullable()->after('provider');
            $table->text('redirect_uris')->nullable()->after('grant_types');
            $table->string('owner_type')->nullable()->after('user_id');
            $table->unsignedBigInteger('owner_id')->nullable()->after('owner_type');
        });

        foreach (DB::table('oauth_clients')->get() as $client) {
            $grantTypes = [];

            if ($client->personal_access_client) {
                $grantTypes[] = 'personal_access';
            }

            if ($client->password_client) {
                $grantTypes[] = 'password';
                $grantTypes[] = 'refresh_token';
            }

            if ($grantTypes === []) {
                $grantTypes = ['authorization_code', 'refresh_token'];
            }

            $redirectUris = array_values(array_filter(array_map(
                'trim',
                explode(',', (string) $client->redirect)
            )));

            DB::table('oauth_clients')->where('id', $client->id)->update([
                'provider' => 'users',
                'grant_types' => json_encode($grantTypes),
                'redirect_uris' => json_encode($redirectUris),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('oauth_clients')) {
            return;
        }

        Schema::table('oauth_clients', function (Blueprint $table) {
            $table->dropColumn([
                'provider',
                'grant_types',
                'redirect_uris',
                'owner_type',
                'owner_id',
            ]);
        });
    }
};
