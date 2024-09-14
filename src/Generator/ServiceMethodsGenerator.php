<?php 

namespace Evolutive\CommandeCli\Generator;

class ServiceMethodsGenerator
{
    /**
     * Generates methods for the specified service class.
     *
     * @param string $name The name of the service class
     * @param string $namespace The namespace for the service class
     * @return string The generated service class with methods
     */
    public function getMethods(string $name, string $namespace): string
    {
        return "<?php\n\nnamespace $namespace\\Service;\n\n" .
            "class {$name}Service\n{\n" .

            "    /**\n" .
            "     * Processes the given data.\n" .
            "     *\n" .
            "     * @param mixed \$data The data to process\n" .
            "     * @return mixed The result of the processing\n" .
            "     */\n" .
            "    public function process(\$data)\n    {\n" .
            "        // Service logic here\n" .
            "        return \$data; // Example processing\n" .
            "    }\n\n" .

            "    /**\n" .
            "     * Validates the provided data.\n" .
            "     *\n" .
            "     * @param mixed \$data The data to validate\n" .
            "     * @return bool True if valid, false otherwise\n" .
            "     */\n" .
            "    public function validate(\$data): bool\n    {\n" .
            "        // Implement validation logic here\n" .
            "        return true; // Example validation\n" .
            "    }\n\n" .

            "    /**\n" .
            "     * Performs additional processing on the data if required.\n" .
            "     *\n" .
            "     * @param mixed \$data The data to process\n" .
            "     * @return mixed The processed data\n" .
            "     */\n" .
            "    public function additionalProcessing(\$data)\n    {\n" .
            "        // Implement additional processing logic here\n" .
            "        return \$data; // Example additional processing\n" .
            "    }\n\n" .

            "    /**\n" .
            "     * Fetches data from an external source.\n" .
            "     *\n" .
            "     * @param string \$source The source from which to fetch data\n" .
            "     * @return mixed The fetched data\n" .
            "     */\n" .
            "    public function fetchData(string \$source)\n    {\n" .
            "        // Implement logic to fetch data from an external source\n" .
            "        return []; // Example return\n" .
            "    }\n" .

            "}\n";
    }
}
