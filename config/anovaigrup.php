<?php
define('DIR_CSS', '_css');
define('DIR_JS', '_js');
define('DIR_IMG', '_img');


$local_development_host = 'dev80.intranet'; // Development host
$production_url = 'mp.gestionproyectos.online'; //Staging host

if (is_int(strpos($_SERVER['HTTP_HOST'], $local_development_host)))
{
    define('IN_PRODUCTION', false);
    define('HTTP_WEB_ROOT', 'http://' . $local_development_host . '/mp_gestiononline/public');
    define('HTTPS_WEB_ROOT', 'https://' . $local_development_host . '/mp_gestiononline/public');
    define('DB_CONNECTION', 'mysql');
    define('DB_HOST', 'localhost');
    define('DB_PORT', 3306);
    define('DB_DATABASE', 'mp_gestiononline');
    define('DB_USERNAME', 'mp_novaigrup');
    define('DB_PREFIX', 'gp_mp_');
    define('DB_PASSWORD', 'r2$gYa211');
    define('DEBUG_MODE', false);
    define('EMAIL_HOST', 'smtp-relay.sendinblue.com');
    define('EMAIL_SENDER_ADDRESS', 'sblue-mp@scsolutions.es');
    define('EMAIL_SENDER_NAME', 'MpGroup no reply');
    define('EMAIL_SMTP_AUTH', true);
    define('EMAIL_SMTP_AUTH_USER', 'sblue-mp@scsolutions.e');
    define('EMAIL_SMTP_AUTH_PASSWORD', 'xsmtpsib-e6918d7253e666b13db7b36dcd72e1655f41618e10f6198c78291664f7f2f695-OJs8Ekt1dfPWZ6Xp');
    define('EMAIL_PORT', 587);
}
else
{
    // PRODUCTION WWW
    define('IN_PRODUCTION', true);
    define('HTTP_WEB_ROOT', 'http://' . $production_url);
    define('HTTPS_WEB_ROOT', 'https://' . $production_url);
    define('DB_CONNECTION', 'mysql');
    define('DB_HOST', '151.236.52.174');
    define('DB_PORT', 3306);
    define('DB_DATABASE', 'mp_gestiononline');
    define('DB_USERNAME', 'mp_novaigrup');
    define('DB_PREFIX', 'gp_mp_');
    define('DB_PASSWORD', 'r2$gYa211');
    define('DEBUG_MODE', false);
    define('EMAIL_HOST', 'smtp-relay.sendinblue.com');
    define('EMAIL_SENDER_ADDRESS', 'sblue-mp@scsolutions.es');
    define('EMAIL_SENDER_NAME', 'MpGroup no reply');
    define('EMAIL_SMTP_AUTH', true);
    define('EMAIL_SMTP_AUTH_USER', 'sblue-mp@scsolutions.e');
    define('EMAIL_SMTP_AUTH_PASSWORD', 'xsmtpsib-e6918d7253e666b13db7b36dcd72e1655f41618e10f6198c78291664f7f2f695-OJs8Ekt1dfPWZ6Xp');
    define('EMAIL_PORT', 587);
}

define('SSL_CRYPTO_PUBLIC_KEY', '-----BEGIN CERTIFICATE-----
MIIFVTCCBD2gAwIBAgIHTvdgNI/J2DANBgkqhkiG9w0BAQUFADCByjELMAkGA1UE
BhMCVVMxEDAOBgNVBAgTB0FyaXpvbmExEzARBgNVBAcTClNjb3R0c2RhbGUxGjAY
BgNVBAoTEUdvRGFkZHkuY29tLCBJbmMuMTMwMQYDVQQLEypodHRwOi8vY2VydGlm
aWNhdGVzLmdvZGFkZHkuY29tL3JlcG9zaXRvcnkxMDAuBgNVBAMTJ0dvIERhZGR5
IFNlY3VyZSBDZXJ0aWZpY2F0aW9uIEF1dGhvcml0eTERMA8GA1UEBRMIMDc5Njky
ODcwHhcNMTMxMDA5MTczMTEyWhcNMTQxMDA5MTczMTEyWjBCMSEwHwYDVQQLExhE
b21haW4gQ29udHJvbCBWYWxpZGF0ZWQxHTAbBgNVBAMTFHd3dy5uZXNwcmVzc29w
ZHYuY29tMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA1au8Tv3uA5Ib
vs3FFCZkz1nk2GtboHTRK5Y6088mZ9VcK/ZvdEH91Vkv+bsO7a3AN5hZDTGKLMuz
puaWkvlcUxR89dmdcqyJykOAo5fwoaOgrklucTV3UuVR/m/7J7oSoF/0aML6s8tk
/tcl/HID/cEkGlN+K621IfDng8S+Et9Ua6HNlA1duBJrEvems66eDTQMuSAMEeqP
ukOIiTFCn4LnN/3C07qgEM5Mpd9HolT4wR6gOGfINFjUvyyJtyEpp0VmAjC/N19M
AjUjhihlM0R2VRXUDfHi6oQwu5SXLAvx74ORx8JVArOKCoILxlISVaSnlarbdltO
hyrXpoWSKQIDAQABo4IBxTCCAcEwDwYDVR0TAQH/BAUwAwEBADAdBgNVHSUEFjAU
BggrBgEFBQcDAQYIKwYBBQUHAwIwDgYDVR0PAQH/BAQDAgWgMDQGA1UdHwQtMCsw
KaAnoCWGI2h0dHA6Ly9jcmwuZ29kYWRkeS5jb20vZ2RzMS0xMDAuY3JsMFMGA1Ud
IARMMEowSAYLYIZIAYb9bQEHFwEwOTA3BggrBgEFBQcCARYraHR0cDovL2NlcnRp
ZmljYXRlcy5nb2RhZGR5LmNvbS9yZXBvc2l0b3J5LzCBgAYIKwYBBQUHAQEEdDBy
MCQGCCsGAQUFBzABhhhodHRwOi8vb2NzcC5nb2RhZGR5LmNvbS8wSgYIKwYBBQUH
MAKGPmh0dHA6Ly9jZXJ0aWZpY2F0ZXMuZ29kYWRkeS5jb20vcmVwb3NpdG9yeS9n
ZF9pbnRlcm1lZGlhdGUuY3J0MB8GA1UdIwQYMBaAFP2sYTKTbEXW4u6FX5q653aZ
aMznMDEGA1UdEQQqMCiCFHd3dy5uZXNwcmVzc29wZHYuY29tghBuZXNwcmVzc29w
ZHYuY29tMB0GA1UdDgQWBBRaaUDg+YjmNz5GLLXNAXJNkRy1PjANBgkqhkiG9w0B
AQUFAAOCAQEAscgJHb5PNhFkwMkP7c+icpvSxCXD35gLFEjjiS+jZP1f/G80+BGU
TQkx9xsQ4JPwEIioo3RWvZGRty/uOKWujX9c2rHV2rZHlAmN13xg5UpEW02iEC8u
FwIX1jMSFTEEguVUg/Z1qQse+PWzeFqZaDhS/ztD5N5APgzx/X4uOip3cLKhtK6j
pupEintpJRP0KWoXlJuRrnuUKnDNVBHBvEn8fLzXmXyAS84wMlpcUFe9LqDr559W
sahFWMkxzLYEYS6uxn1uhsP/nTeV9qvp1RR358W0G1hTd/N+uepD0sQEaaJ3NSmB
g6iXzmx8jGRusT6XorrDxJYWZf0j3RGUlQ==
-----END CERTIFICATE-----');

define('SSL_CRYPTO_PRIVATE_KEY', '-----BEGIN RSA PRIVATE KEY-----
MIIEpAIBAAKCAQEA1au8Tv3uA5Ibvs3FFCZkz1nk2GtboHTRK5Y6088mZ9VcK/Zv
dEH91Vkv+bsO7a3AN5hZDTGKLMuzpuaWkvlcUxR89dmdcqyJykOAo5fwoaOgrklu
cTV3UuVR/m/7J7oSoF/0aML6s8tk/tcl/HID/cEkGlN+K621IfDng8S+Et9Ua6HN
lA1duBJrEvems66eDTQMuSAMEeqPukOIiTFCn4LnN/3C07qgEM5Mpd9HolT4wR6g
OGfINFjUvyyJtyEpp0VmAjC/N19MAjUjhihlM0R2VRXUDfHi6oQwu5SXLAvx74OR
x8JVArOKCoILxlISVaSnlarbdltOhyrXpoWSKQIDAQABAoIBAHo2cU3JJhM6xc3b
yiadUznaU++JcG4VgvJoShuON4xaWA75NISNnk8iZTN0z7QYloH2DLFkLYEzvfzv
lR5ZrHoElPjV0J2fnGxpMbHgnQ0HF0e4zofIKgjrC3v5tvDhF/hNCfHF3DlsU8cD
bkG3QRsqFqlMKjV3dMwGC5WtuX323bZ5sy1U7AZsZ35BgwNnfUp9ur2wo3bnMVRj
E61GxPj2riINUgMGnV9DkEu9QE/yKObRZxG03NiS2Myit2psxe+rFGjntHQaIZkB
kp6B9JhQWBajtFRjwNc4wMTFxopL7JhO/x1yxpCdOfupGkQyQoXRUYZcBWI4eZDx
kEa5OUUCgYEA7A5b2QcI8WH6zC9Nqqrp5sW81bDYVbenTddoWEhLemFybuuuHBO6
OaxXULokg/HHETWQ6P2i9a7CgZxUynw5CnofK+0ZYwe8+dtLJQoCZ0GFkhVzeiOM
dqM9oCrd6uU9IJFAx8fQOHZqCOehs7wFLzs+axioOrGxNGpPHLYE0o8CgYEA57k1
MsQ2OIFxPlEuIavwlw7ly4VmISBkitH23htqMFoDOiAE9vH9DQRVqNwPJeph51jk
GgCd8hWWULxWOGO2ChIM12sNVsPM+riavBGJnlg1Ig/C8rrGM2dCr4hz/tKytzJE
yYTI/dqg6qo1Bal4M3pQARaiRFZl4LVyWeKKS8cCgYAEQA3vTm0ey4DUhFWFqSYk
/ZJ01oZOpMviXuqGDGcvgOmqjZvI7aIAv9Wiondd2NCYwrolN8vjWI4v/zyXmLz+
L0y4YcB/Q/hnF0e3FwMMEOXyx2gY3uL8j9vgMmVkgVQkbfkYn8Rj/93Q4zrKHayK
OSraissco25pXzCld7GGiQKBgQCaCu5JjFR7JdnRUog3TCUJVpb+v/SPywfrnP7e
0hy6fewtRMHoJCBT+fCz626KhxCEifxBKO3W0/D0RO+QVwDaGvu8bOcWKd3nQrdi
lMoGoJ7ZwN6ZG/7MhzW2mSB7Yzf5PwqpaINw9lkJBxNuayWEGyh6QMCoa0MYqaaW
CFplWwKBgQDpEVFDRjy07DQ1mHqzX8uQmPzsJqbOCrQzmKVwZQCSXBUcg6C7LAU0
aHhMEl8as8n1t4Aj2zORt1jGLVeBYV4tFfQ2H8i6Hbqa4lbZemEC+vpjQvIoF5oW
1t2QrMQmu+AMPqXqcI8sFBa0LPEZ5bPmx4kQF5rQuPpgIiAITEOlJg==
-----END RSA PRIVATE KEY-----');

define('SSL_CRYPTO_PASSWORD', '344zxq00_1f3mmT_5dS');

return [];
