<?php 

namespace Evolutive\CommandeCli\Service;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

class FileManager
{
    private $filesystem;

    public function __construct()
    {
        $this->filesystem = new Filesystem();
    }

    public function getNamespaceFromComposer(): ?string
    {
        $composerJsonPath = __DIR__ . '/../../composer.json';
        if (!file_exists($composerJsonPath)) {
            return null;
        }

        $composerData = json_decode(file_get_contents($composerJsonPath), true);
        return $composerData['autoload']['psr-4'] ? rtrim(array_keys($composerData['autoload']['psr-4'])[0], '\\') : null;
    }

    public function createBasePath(?string $libpath, string $type, OutputInterface $output, string $module): ?string
    {
        $basePath = realpath(__DIR__ . "/../../../../modules/$module/src") . '/' . trim($libpath ?: $type, '/');
    
        if (!$this->filesystem->exists($basePath)) {
            try {
                $this->filesystem->mkdir($basePath, 0755);
                $output->writeln("Created directory: " . $basePath);
            } catch (Throwable $e) {
                $output->writeln('Error creating directory: ' . $e->getMessage());
                return null;
            }
        }
    
        return $basePath;
    }

    public function createDirectory(string $path): void
    {
        if (!$this->filesystem->exists($path)) {
            $this->filesystem->mkdir($path, 0755);
        }
    }
}
