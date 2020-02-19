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
             'platform_sign'       => 'jhhy',
             'private_key_first'   => '-----BEGIN PRIVATE KEY-----
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
             'public_key_first'    => '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCgy6JOupuDqE9itVQvGSBDJotB
EJFASuklIwvcMNtXUH99PdihJ+TJN2AjNphzCdgL9KlguDG+u4C719DZOC3YrGn7
Ps9vWOFtQYLzh69cGd+nlqOR4LKVSAYRn2NtrV9elAzBjie/Y7ITMsU9+ZTsccRq
b+qd+OlBsYdg9dhvVQIDAQAB
-----END PUBLIC KEY-----
',
             'interval_str_first'  => 'aesrsastart',
             'private_key_second'  => '-----BEGIN PRIVATE KEY-----
MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAPTYUA2oNnnEwCM+
firQEh3qtvhzy2sPcCCPBuk1ALN98ThFtwbsAIXn4iflC8cL74OxsW5LhVLqRaNJ
wrj19nUWRNg2V0UG0qiSMDoFQzcf14Tl3YEMVhHmhT60KEc/mcOkGp7BGFneNRkU
rnAedUPaI18hHfwlOXCTBOXjsLEHAgMBAAECgYAOsZCUUTz7r8gMFWsC7Lu5meVj
Iafag/GpsouqoSiqnOtGAkEKpE0fvBvBYyiCyH+WOqq4QMX+hNqrAvkxmmkw3Zj6
pqGIGBm8qP0sC7kV9l3+1GyNweBaPqnZs02Kb3WCZnw8h1NaJRR9uqXFITzLkNgx
EOuq9oiQqmI9UmP7sQJBAP1qL2O32RS/i08lCHR1r/XQTF/0pkSPX+a6SEf25iew
zKm5do8hOtSG7+zjOlOQwsGwCPuNovz5g8BPMv2juQ8CQQD3V78skMtTp+0c6WjV
h5ORIkkYAyOnSfl3nigkQKCfGyiTwX1cm3GLTHkDHZBVJjFyz8U/ngZZbG8ScHZC
MtiJAkEAroiApQxNXaXiu5rE7PjVPNa+k2P7U8LviQiJmc7pizKQcuDCUCfRzeg1
vJBvbniIOkAUn7RYKiVrYXrqopgtbwJAd+zzpIgQDd+99+a0DdROmHAnQJ1FDDex
3W2xyOIM/xgL9Jg8UEqOIxxREFGlSaPbFe/nk5DrQzBwKmCc9jvxAQJALe9ZaKqP
eZywh2aUa8huotTe5lj/iDeGdHOgxx4xkDK9ddzuSks1dbJQ/gHl8lA7MjOI6Tvt
geLB9FOOvsi5EQ==
-----END PRIVATE KEY-----
',
             'public_key_second'   => '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQD02FANqDZ5xMAjPn4q0BId6rb4
c8trD3AgjwbpNQCzffE4RbcG7ACF5+In5QvHC++DsbFuS4VS6kWjScK49fZ1FkTY
NldFBtKokjA6BUM3H9eE5d2BDFYR5oU+tChHP5nDpBqewRhZ3jUZFK5wHnVD2iNf
IR38JTlwkwTl47CxBwIDAQAB
-----END PUBLIC KEY-----
',
             'interval_str_second' => 'hDdoAPaXI3S',
            ],
        );
    }
}
