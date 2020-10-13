<?php

namespace Composer;

use Composer\Semver\VersionParser;






class InstalledVersions
{
private static $installed = array (
  'root' => 
  array (
    'pretty_version' => 'dev-master',
    'version' => 'dev-master',
    'aliases' => 
    array (
    ),
    'reference' => '328434d2eb04129945ada48e93f51c118d97335d',
    'name' => '__root__',
  ),
  'versions' => 
  array (
    '__root__' => 
    array (
      'pretty_version' => 'dev-master',
      'version' => 'dev-master',
      'aliases' => 
      array (
      ),
      'reference' => '328434d2eb04129945ada48e93f51c118d97335d',
    ),
    'behat/behat' => 
    array (
      'pretty_version' => 'v3.7.0',
      'version' => '3.7.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '08052f739619a9e9f62f457a67302f0715e6dd13',
    ),
    'behat/gherkin' => 
    array (
      'pretty_version' => 'v4.6.2',
      'version' => '4.6.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '51ac4500c4dc30cbaaabcd2f25694299df666a31',
    ),
    'behat/transliterator' => 
    array (
      'pretty_version' => 'v1.3.0',
      'version' => '1.3.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '3c4ec1d77c3d05caa1f0bf8fb3aae4845005c7fc',
    ),
    'psr/container' => 
    array (
      'pretty_version' => '1.0.0',
      'version' => '1.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b7ce3b176482dbbc1245ebf52b181af44c2cf55f',
    ),
    'psr/container-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0',
      ),
    ),
    'psr/log' => 
    array (
      'pretty_version' => '1.1.3',
      'version' => '1.1.3.0',
      'aliases' => 
      array (
      ),
      'reference' => '0f73288fd15629204f9d42b7055f72dacbe811fc',
    ),
    'psr/log-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0',
      ),
    ),
    'symfony/config' => 
    array (
      'pretty_version' => 'v3.4.45',
      'version' => '3.4.45.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd061a451ff6bc170c5454f4ac9b41ad2179e3960',
    ),
    'symfony/console' => 
    array (
      'pretty_version' => 'v3.4.45',
      'version' => '3.4.45.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b28996bc0a3b08914b2a8609163ec35b36b30685',
    ),
    'symfony/debug' => 
    array (
      'pretty_version' => 'v3.4.45',
      'version' => '3.4.45.0',
      'aliases' => 
      array (
      ),
      'reference' => '9109e4414e684d0b75276ae203883467476d25d0',
    ),
    'symfony/dependency-injection' => 
    array (
      'pretty_version' => 'v3.4.45',
      'version' => '3.4.45.0',
      'aliases' => 
      array (
      ),
      'reference' => '4199685e602129feb82b14279e774af05a4f5dc2',
    ),
    'symfony/event-dispatcher' => 
    array (
      'pretty_version' => 'v3.4.45',
      'version' => '3.4.45.0',
      'aliases' => 
      array (
      ),
      'reference' => '0bb9ea263b39fce3a12ac9f78ef576bdd80dacb8',
    ),
    'symfony/filesystem' => 
    array (
      'pretty_version' => 'v3.4.45',
      'version' => '3.4.45.0',
      'aliases' => 
      array (
      ),
      'reference' => '495646f13d051cc5a8f77a68b68313dc854080aa',
    ),
    'symfony/polyfill-ctype' => 
    array (
      'pretty_version' => 'v1.18.1',
      'version' => '1.18.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '1c302646f6efc070cd46856e600e5e0684d6b454',
    ),
    'symfony/polyfill-mbstring' => 
    array (
      'pretty_version' => 'v1.18.1',
      'version' => '1.18.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'a6977d63bf9a0ad4c65cd352709e230876f9904a',
    ),
    'symfony/translation' => 
    array (
      'pretty_version' => 'v3.4.45',
      'version' => '3.4.45.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c826cb2216d1627d1882e212d2ac3ac13d8d5b78',
    ),
    'symfony/yaml' => 
    array (
      'pretty_version' => 'v3.4.45',
      'version' => '3.4.45.0',
      'aliases' => 
      array (
      ),
      'reference' => 'ec3c2ac4d881a4684c1f0317d2107f1a4152bad9',
    ),
  ),
);







public static function getInstalledPackages()
{
return array_keys(self::$installed['versions']);
}









public static function isInstalled($packageName)
{
return isset(self::$installed['versions'][$packageName]);
}














public static function satisfies(VersionParser $parser, $packageName, $constraint)
{
$constraint = $parser->parseConstraints($constraint);
$provided = $parser->parseConstraints(self::getVersionRanges($packageName));

return $provided->matches($constraint);
}










public static function getVersionRanges($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

$ranges = array();
if (isset(self::$installed['versions'][$packageName]['pretty_version'])) {
$ranges[] = self::$installed['versions'][$packageName]['pretty_version'];
}
if (array_key_exists('aliases', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['aliases']);
}
if (array_key_exists('replaced', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['replaced']);
}
if (array_key_exists('provided', self::$installed['versions'][$packageName])) {
$ranges = array_merge($ranges, self::$installed['versions'][$packageName]['provided']);
}

return implode(' || ', $ranges);
}





public static function getVersion($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

if (!isset(self::$installed['versions'][$packageName]['version'])) {
return null;
}

return self::$installed['versions'][$packageName]['version'];
}





public static function getPrettyVersion($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

if (!isset(self::$installed['versions'][$packageName]['pretty_version'])) {
return null;
}

return self::$installed['versions'][$packageName]['pretty_version'];
}





public static function getReference($packageName)
{
if (!isset(self::$installed['versions'][$packageName])) {
throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}

if (!isset(self::$installed['versions'][$packageName]['reference'])) {
return null;
}

return self::$installed['versions'][$packageName]['reference'];
}





public static function getRootPackage()
{
return self::$installed['root'];
}







public static function getRawData()
{
return self::$installed;
}



















public static function reload($data)
{
self::$installed = $data;
}
}
