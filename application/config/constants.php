<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
|--------------------------------------------------------------------------
| Define constantes
|--------------------------------------------------------------------------
|
| 
|
*/

define("LIMITE",     '10'); //define o limite paga a paginação nas páginas de consulta

define('MAXSALAS', '15'); // numero maximo de salas
define('MAXTOMADAS', '12');// numero maximo de tomadas por sala
    
define('HARMONICAS', '12');// numero de harmonicas da FFT (barras para gerar a onda)
define('PONTOSONDA', '256');// numero de pontos em cada forma de onda (grafico de linhas)
    
define('FREQBASE', '60');// frequencia base da aquisição

define('TEMPOATUALIZA', '3000');// tempo de atualização ajax página painel de controle em miliseguns (ms)