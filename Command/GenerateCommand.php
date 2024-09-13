<?php

namespace Evo\CommandeCli\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Evo\CommandeCli\Service\FileManager;
use Evo\CommandeCli\Service\CodeGenerator;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Throwable;

class GenerateCommand extends Command
{
    protected static $defaultName = 'evo_commandcli:generate';

    private FileManager $fileManager;
    private CodeGenerator $codeGenerator;

    public function __construct(FileManager $fileManager, CodeGenerator $codeGenerator)
    {
        parent::__construct();
        $this->fileManager = $fileManager;
        $this->codeGenerator = $codeGenerator;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Generate files for the specified module.')
            ->addArgument('module', InputArgument::REQUIRED, 'The name of the module where the files will be generated.')
            ->addArgument('type', InputArgument::REQUIRED, 'The type of file to generate (e.g., Entity, Form, Controller).')
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the entity or class to generate.')
            ->addArgument('fields', InputArgument::OPTIONAL, 'Comma-separated list of fields and their types (e.g., field1:string,field2:int).', '')
            ->addArgument('libpath', InputArgument::OPTIONAL, 'The relative path from src to store the file.', '');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $module = $input->getArgument('module');
        $type = $input->getArgument('type');
        $name = $input->getArgument('name');
        $fields = $input->getArgument('fields');
        $libpath = $input->getArgument('libpath');

        try {
            $this->validateArguments($module, $type, $name);
            
            $namespace = $this->fileManager->getNamespaceFromComposer();
            $basePath = $this->fileManager->createBasePath($libpath, $type, $output, $module);

            $this->codeGenerator->generateFile($type, $name, $fields, $basePath, $namespace, $output);
            $output->writeln("<info>Files generated successfully in: $basePath</info>");

            return 0;
        } catch (InvalidArgumentException $e) {
            $output->writeln("<error>Invalid Argument: {$e->getMessage()}</error>");
            return 1;
        } catch (Throwable $e) {
            $output->writeln("<error>An error occurred: {$e->getMessage()}</error>");
            return 1;
        }
    }

    /**
     * Validate command arguments.
     *
     * @param string $module
     * @param string $type
     * @param string $name
     * @throws InvalidArgumentException
     */
    private function validateArguments(string $module, string $type, string $name): void
    {
        if (empty($module)) {
            throw new InvalidArgumentException('Module argument must not be empty.');
        }

        if (empty($type)) {
            throw new InvalidArgumentException('Type argument must not be empty.');
        }

        if (empty($name)) {
            throw new InvalidArgumentException('Name argument must not be empty.');
        }
    }
}
