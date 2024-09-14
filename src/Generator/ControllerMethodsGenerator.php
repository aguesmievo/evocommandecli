<?php 

namespace Evolutive\CommandeCli\Generator;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ControllerMethodsGenerator
{
    /**
     * Generates the methods for the specified controller.
     *
     * @param string $name The name of the controller
     * @param string $namespace The namespace for the controller
     * @return string The generated controller class with methods
     */
    public function getMethods(string $name, string $namespace): string
    {
        return "<?php\n\nnamespace $namespace\\Controller;\n\n" .
            "use Symfony\\Bundle\\FrameworkBundle\\Controller\\AbstractController;\n" .
            "use Symfony\\Component\\HttpFoundation\\Response;\n" .
            "use Symfony\\Component\\HttpFoundation\\Request;\n" .
            "use Symfony\\Component\\Routing\\Annotation\\Route;\n\n" .

            "class {$name}Controller extends AbstractController\n{\n" .

            "    /**\n" .
            "     * @Route(\"/\")\n" .
            "     */\n" .
            "    public function index(): Response\n" .
            "    {\n" .
            "        // Default index action logic\n" .
            "        return new Response('Welcome to {$name} Controller');\n" .
            "    }\n\n" .

            "    /**\n" .
            "     * @Route(\"/show/{id}\", methods={\"GET\"})\n" .
            "     * Displays a specific resource by ID\n" .
            "     *\n" .
            "     * @param int \$id The ID of the resource\n" .
            "     * @return Response\n" .
            "     */\n" .
            "    public function show(int \$id): Response\n" .
            "    {\n" .
            "        // Logic to retrieve and display a resource\n" .
            "        return new Response('Showing resource with ID: ' . \$id);\n" .
            "    }\n\n" .

            "    /**\n" .
            "     * @Route(\"/create\", methods={\"POST\"})\n" .
            "     * Handles the creation of a new resource\n" .
            "     *\n" .
            "     * @param Request \$request The request object\n" .
            "     * @return Response\n" .
            "     */\n" .
            "    public function create(Request \$request): Response\n" .
            "    {\n" .
            "        // Logic to create a new resource\n" .
            "        // For example, save to the database\n" .
            "        return new Response('Resource created successfully.');\n" .
            "    }\n\n" .

            "    /**\n" .
            "     * @Route(\"/update/{id}\", methods={\"PUT\"})\n" .
            "     * Updates an existing resource by ID\n" .
            "     *\n" .
            "     * @param Request \$request The request object\n" .
            "     * @param int \$id The ID of the resource\n" .
            "     * @return Response\n" .
            "     */\n" .
            "    public function update(Request \$request, int \$id): Response\n" .
            "    {\n" .
            "        // Logic to update an existing resource\n" .
            "        return new Response('Resource with ID: ' . \$id . ' updated successfully.');\n" .
            "    }\n\n" .

            "    /**\n" .
            "     * @Route(\"/delete/{id}\", methods={\"DELETE\"})\n" .
            "     * Deletes a specific resource by ID\n" .
            "     *\n" .
            "     * @param int \$id The ID of the resource\n" .
            "     * @return Response\n" .
            "     */\n" .
            "    public function delete(int \$id): Response\n" .
            "    {\n" .
            "        // Logic to delete a resource\n" .
            "        return new Response('Resource with ID: ' . \$id . ' deleted successfully.');\n" .
            "    }\n" .

            "}\n";
    }
}
