<?php

use App\Models\Systems\SystemPlatformSsl;
use Illuminate\Database\Seeder;

/**
 * Class SystemPlatformSslSeeder
 */
class SystemPlatformSslSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SystemPlatformSsl::insert(
            [
             'platform_sign' => 'test',
             'private_key'   => '-----BEGIN PRIVATE KEY-----
MIICeAIBADANBgkqhkiG9w0BAQEFAASCAmIwggJeAgEAAoGBAKDLok66m4OoT2K1
VC8ZIEMmi0EQkUBK6SUjC9ww21dQf3092KEn5Mk3YCM2mHMJ2Av0qWC4Mb67gLvX
0Nk4Ldisafs+z29Y4W1BgvOHr1wZ36eWo5HgspVIBhGfY22tX16UDMGOJ79jshMy
xT35lOxxxGpv6p346UGxh2D12G9VAgMBAAECgYAdHuQFOByECo5eBRL6+KT0JF3h
6bs0lpyEwkUamqqOtKByMSozfYMcwe+iUPfpFaZP+/5U6ubvcQvOeTZ0sIz0wDab
Lw9jI5s0pMehBW0h/22e7Sng26VViObYL6LU8NoQ37tB94aU3tTJcn4eSwWBGJyJ
PUTJJM6s9Cf1rJuXQQJBANFUsQIJRjK/uDCCL55KuQfzAwYQ59N9mcYvAIF2QWEd
Ssgm/gaXuJS7jhNkCkjGEjk9UqIvaO/PyiYIrqlHmwUCQQDEpNfjCRshHspE07DX
+9i+HcTWF+TsT3cMUzyLzCkMPeYePowlQwR4WZ9jKICPDqZ/EMqXcSyW4ANK8P5A
i9QRAkEAuWdnt8P7FuvT+bL09iB8rdvBK9hBXIJ8dpoeuovA8ID/QTO3/qLW63UL
K4WJzlcQwP3deKTBLtY9114NRQWU+QJBALZ/4pijv9jqMYDVEsAwzQQMrryfqmci
jPMUYRHBZasl22bgV8LRQtnLG6C0WzPpvd4ZoFwSvfY8avHnXaBb5XECQQCnIoG3
G0RABilQJWSPgQRba23BUPOSY6W338pYa8KGmlW922aBYC+q5hnnHsHhrbzysuh/
sUOhANCQXzzmA7LV
-----END PRIVATE KEY-----
',
             'public_key'    => '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCgy6JOupuDqE9itVQvGSBDJotB
EJFASuklIwvcMNtXUH99PdihJ+TJN2AjNphzCdgL9KlguDG+u4C719DZOC3YrGn7
Ps9vWOFtQYLzh69cGd+nlqOR4LKVSAYRn2NtrV9elAzBjie/Y7ITMsU9+ZTsccRq
b+qd+OlBsYdg9dhvVQIDAQAB
-----END PUBLIC KEY-----
',
             'interval_str'  => 'aesrsastart',
            ],
        );
    }
}
