<?php 

namespace Evo\CommandeCli\Generator;

class HelperMethodsGenerator
{
    /**
     * Generates methods for the specified helper class.
     *
     * @param string $name The name of the helper class
     * @param string $namespace The namespace for the helper class
     * @return string The generated helper class with methods
     */
    public function getMethods(string $name, string $namespace): string
    {
        return "<?php\n\nnamespace $namespace\\Helper;\n\n" .
            "class {$name}Helper\n{\n" .

            "    /**\n" .
            "     * Assists with a specific task.\n" .
            "     *\n" .
            "     * @param mixed \$data The data to assist with\n" .
            "     * @return mixed The processed result\n" .
            "     */\n" .
            "    public function assist(\$data)\n    {\n" .
            "        // Example logic to assist with the provided data\n" .
            "        // Perform processing and return result\n" .
            "        return \$data; // Modify as needed\n" .
            "    }\n\n" .

            "    /**\n" .
            "     * Utility method to validate data.\n" .
            "     *\n" .
            "     * @param mixed \$data The data to validate\n" .
            "     * @return bool True if valid, false otherwise\n" .
            "     */\n" .
            "    public function validate(\$data): bool\n    {\n" .
            "        // Validation logic goes here\n" .
            "        return !empty(\$data); // Example condition\n" .
            "    }\n\n" .

            "    /**\n" .
            "     * Formats data into a specific structure.\n" .
            "     *\n" .
            "     * @param mixed \$data The data to format\n" .
            "     * @return array The formatted data\n" .
            "     */\n" .
            "    public function formatData(\$data): array\n    {\n" .
            "        // Formatting logic goes here\n" .
            "        return ['formatted' => \$data]; // Example formatting\n" .
            "    }\n" .

            "}\n";
    }
}
