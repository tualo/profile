# profile

a simple profile package
including edit profile

Initials avatars use `naas/php-initial-avatar-generator` ^4.5.0, a fork
retaining the `LasseRafn\InitialAvatarGenerator` namespace with Intervention
Image 3 support. Unlike the original generator, it does not require Guzzle
PSR-7 1.x/2.x and can be installed alongside Guzzle HTTP 8.3.1.

Avatar generation requires PHP 8.1+, mbstring, and GD (the default image
driver). Generated images are encoded with Intervention Image 3's `toPng()`
and `toJpeg()` APIs.