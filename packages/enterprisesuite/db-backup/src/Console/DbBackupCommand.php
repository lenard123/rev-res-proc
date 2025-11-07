<?php

namespace Enterprisesuite\DbBackup\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Process\Process;

class DbBackupCommand extends Command
{
    protected $signature = 'db:backup {--path= : Custom path to store the backup file}';
    protected $description = 'Backup Database';

    public function handle(): int
    {
        // --- Step 1: Get database config
        $connection = config('database.default');
        $config = config("database.connections.{$connection}");

        if ($config['driver'] !== 'mysql') {
            $this->error("This command only supports MySQL connections.");
            return SymfonyCommand::FAILURE;
        }

        $database = $config['database'];
        $username = $config['username'];
        $password = $config['password'];
        $host     = $config['host'];
        $port     = $config['port'] ?? 3306;

        // --- Step 2: Prepare backup path
        $timestamp = now()->format('Y-m-d_His');
        $filename = "{$database}_backup_{$timestamp}.sql";
        $backupPath = $this->option('path') ?: storage_path("app/backups/{$filename}");

        // Ensure directory exists
        if (! is_dir(dirname($backupPath))) {
            mkdir(dirname($backupPath), 0755, true);
        }

        // --- Step 3: Run mysqldump command
        $command = [
            'mysqldump',
            '--user=' . $username,
            '--password=' . $password,
            '--host=' . $host,
            '--port=' . $port,
            '--skip-lock-tables',
            '--routines',
            '--single-transaction',
            $database,
        ];

        $process = new Process($command);
        $process->setTimeout(null); // no time limit

        $this->info("Creating database backup...");

        try {
            $process->mustRun();
            file_put_contents($backupPath, $process->getOutput());
            $this->info("✅ Backup completed: {$backupPath}");
        } catch (\Throwable $e) {
            $this->error("❌ Backup failed: {$e->getMessage()}");
            return 1;
        }

        return SymfonyCommand::SUCCESS;
    }
}
