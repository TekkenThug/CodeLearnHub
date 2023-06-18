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

		$process = Process::fromShellCommandline($command);
    $process->run();

		$output = $process->getOutput();
    $error = $process->getErrorOutput();

		$processTwo = Process::fromShellCommandline('ls');
		$processTwo->run();

		dd($processTwo->getErrorOutput(), $processTwo->getOutput());

		Storage::disk('local')->delete($fileWithTest);
		Storage::disk('local')->delete($testConfig);

		return strpos($error, 'PASS') === 0;
	}
}