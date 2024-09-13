<?php

namespace Evo\CommandeCli\Service;

use Symfony\Component\Console\Output\OutputInterface;
use Evo\CommandeCli\Generator\PresenterMethodsGenerator;
use Evo\CommandeCli\Generator\ServiceMethodsGenerator;
use Evo\CommandeCli\Generator\ControllerMethodsGenerator;
use Evo\CommandeCli\Generator\EntityMethodsGenerator;
use Evo\CommandeCli\Generator\FormHandlerMethodsGenerator;
use Evo\CommandeCli\Generator\FormProviderMethodsGenerator;
use Evo\CommandeCli\Generator\FormTypeMethodsGenerator;
use Evo\CommandeCli\Generator\HelperMethodsGenerator;
use Evo\CommandeCli\Generator\RepositoryMethodsGenerator;
use Evo\CommandeCli\Service\FileManager;

class CodeGenerator
{
    private $presenterGenerator;
    private $serviceGenerator;
    private $controllerGenerator;
    private $entityGenerator;
    private $formHandlerGenerator;
    private $formProviderGenerator;
    private $formTypeGenerator;
    private $helperGenerator;
    private $repositoryGenerator;
    private $fileManager;


    public function __construct(
        PresenterMethodsGenerator $presenterGenerator,
        ServiceMethodsGenerator $serviceGenerator,
        ControllerMethodsGenerator $controllerGenerator,
        EntityMethodsGenerator $entityGenerator,
        FormHandlerMethodsGenerator $formHandlerGenerator,
        FormProviderMethodsGenerator $formProviderGenerator,
        FormTypeMethodsGenerator $formTypeGenerator,
        HelperMethodsGenerator $helperGenerator,
        RepositoryMethodsGenerator $repositoryGenerator,
        FileManager $fileManager
    ) {
        $this->presenterGenerator = $presenterGenerator;
        $this->serviceGenerator = $serviceGenerator;
        $this->controllerGenerator = $controllerGenerator;
        $this->entityGenerator = $entityGenerator;
        $this->formHandlerGenerator = $formHandlerGenerator;
        $this->formProviderGenerator = $formProviderGenerator;
        $this->formTypeGenerator = $formTypeGenerator;
        $this->helperGenerator = $helperGenerator;
        $this->repositoryGenerator = $repositoryGenerator;
        $this->fileManager = $fileManager;
    }

    public function generateFile(string $type, string $name, ?string $fields, string $basePath, string $namespace, OutputInterface $output): void
    {
        $methods = $this->getMethods($type, $name, $fields, $namespace);
        // dump($methods);die;
        if ($methods) {
            foreach ($methods as $method) {
                
                if (isset($method['filename']) && isset($method['content'])) {
                    $fullPath = "$basePath/{$method['filename']}";
                    $this->fileManager->createDirectory(dirname($fullPath));
                    file_put_contents($fullPath, $method['content']);
                    $output->writeln("Generated file: {$method['filename']}");
                } else {
                    $output->writeln('Error: Missing filename or content for method.');
                }
            }
        } else {
            $output->writeln('Invalid type specified.');
        }
    }

    private function getMethods(string $type, string $name, ?string $fields, string $namespace): ?array
    {
        switch ($type) {
            case 'Entity':
                return $this->createEntityMethods($name, $fields, $namespace);
            case 'Repository':
                return $this->createRepositoryMethods($name, $namespace);
            case 'Controller':
                return $this->createControllerMethods($name, $namespace);
            case 'Helper':
                return $this->createHelperMethods($name, $namespace);
            case 'Presenter':
                return $this->createPresenterMethods($name, $namespace);
            case 'Form':
                return $this->createFormMethods($name, $namespace);
            case 'Service':
                return $this->createServiceMethods($name, $namespace);
            case 'Command':
                return $this->createCommandMethods($name, $namespace);
            default:
                return null;
        }
    }

    private function createEntityMethods(string $name, ?string $fields, string $namespace): array
    {
        $content = $this->entityGenerator->getMethods($name, $fields, $namespace);
        return [['filename' => "{$name}.php", 'content' => $content]];
    }

    private function createRepositoryMethods(string $name, string $namespace): array
    {
        $content = $this->repositoryGenerator->getMethods($name, $namespace);
        return [['filename' => "{$name}Repository.php", 'content' => $content]];
    }

    private function createControllerMethods(string $name, string $namespace): array
    {
        $content = $this->controllerGenerator->getMethods($name, $namespace);
        return [['filename' => "Admin/{$name}Controller.php", 'content' => $content]];
    }

    private function createFormMethods(string $name, string $namespace): array
    {
        $formHandlerContent = $this->formHandlerGenerator->getMethods($name, $namespace);
        $formProviderContent = $this->formProviderGenerator->getMethods($name, $namespace);
        $formTypeContent =$this->formTypeGenerator->getMethods($name, $namespace);

        return [
            [
                'filename' => "FormHandler/{$name}DataHandler.php",
                'content' => $formHandlerContent
            ],
            [
                'filename' => "FormProvider/{$name}DataProvider.php",
                'content' => $formProviderContent
            ],
            [
                'filename' => "FormType/{$name}Type.php",
                'content' => $formTypeContent
            ],
        ];
    }

    private function createHelperMethods(string $name, string $namespace): array
    {
        $content = $this->helperGenerator->getMethods($name, $namespace);
        return [['filename' => "{$name}Helper.php", 'content' => $content]];
    }

    private function createPresenterMethods(string $name, string $namespace): array
    {
        $content = $this->presenterGenerator->getMethods($name, $namespace);
        return [['filename' => "{$name}Presenter.php", 'content' => $content]];
    }

    private function createServiceMethods(string $name, string $namespace): array
    {
        $content = $this->serviceGenerator->getMethods($name, $namespace);
        return [['filename' => "{$name}Service.php", 'content' => $content]];
    }

    private function createCommandMethods(string $name, string $namespace): array
    {
        $content = "<?php\n\nnamespace $namespace\\Command;\n\nuse Symfony\\Component\\Console\\Command\\Command;\n\nclass $name extends Command\n{\n    protected static \$defaultName = '{$name}';\n\n    protected function configure(): void { \$this->setDescription('{$name} command'); }\n\n    protected function execute(InputInterface \$input, OutputInterface \$output): int { return Command::SUCCESS; }\n}\n";
        return [['filename' => "{$name}Command.php", 'content' => $content]];
    }
}
