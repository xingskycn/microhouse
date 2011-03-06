--TEST--
benchmark class
--SKIPIF--
<?php
if (!class_exists('MHBenchmark')) die("skip microhouse extension not available\n");
?>
--FILE--
<?php
ob_start();
define('BASEPATH', dirname(__FILE__) . '/../CodeIgniter/');
$benchmark = new MHBenchmark();
var_dump($benchmark->memory_usage());
$mh = ob_get_clean();

ob_start();
require BASEPATH . 'system/core/Benchmark.php';
$benchmark = new CI_Benchmark();
var_dump($benchmark->memory_usage());
$ci = ob_get_clean();

$mh = preg_replace('/object\((MH|CI_)Benchmark\)\#[0-9]+/', 'object(Benchmark)', $mh);
$mh = preg_replace('/string\(6\) "0.[0-9]{4}"/', '__benchmarkvalue__', $mh);
$ci = preg_replace('/object\((MH|CI_)Benchmark\)\#[0-9]+/', 'object(Benchmark)', $ci);
$ci = preg_replace('/string\(6\) "0.[0-9]{4}"/', '__benchmarkvalue__', $ci);

echo (int)($mh == $ci);
?>

--EXPECTF--
1
