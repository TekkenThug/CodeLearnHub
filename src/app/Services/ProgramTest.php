<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class ProgramTest
{
	public function run($language, $code, $testCode) 
	{
		if ($language === 'JavaScript') {
			return $this->javaScriptCode($code, $testCode);
		}
	}

	public function javaScriptCode($code, $testCode)
	{
		$testConfig = uniqid('script_', true) . '.config.json';

		$fileWithTest = uniqid('script_', true) . '.test.js';
		Storage::disk('local')->put($fileWithTest, $code . "\n" . $testCode);
		Storage::disk('local')->put($testConfig, '{
			"bail": 1,
			"verbose": true
		  }');

		$command = 'jest' . ' ' . storage_path('app/' . $fileWithTest) . ' ' . '--config=' . storage_path('app/' . $testConfig);
		putenv('PATH=/root/.nvm/versions/node/v16.19.0/bin:/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/games:/usr/local/games:/snap/bin');
		$process = new Process(['node', '-v']);
    $process->run();

		$output = $process->getOutput();
    $error = $process->getErrorOutput();

		dd($output, $error);

		Storage::disk('local')->delete($fileWithTest);
		Storage::disk('local')->delete($testConfig);

		return strpos($error, 'PASS') === 0;
	}
}