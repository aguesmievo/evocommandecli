<?php

namespace Evolutive\CommandeCli\Generator;

class FormHandlerMethodsGenerator
{
    /**
     * Generates the methods for the specified form handler.
     *
     * @param string $name The name of the form handler
     * @param string $namespace The namespace for the form handler
     * @return string The generated form handler class with methods
     */
    public function getMethods(string $name, string $namespace): string
    {
        return "<?php\n\nnamespace $namespace\\Form\\FormHandler;\n\n" .
            "class {$name}FormHandler\n{\n" .

            "    /**\n" .
            "     * Handles the form submission data\n" .
            "     *\n" .
            "     * @param array \$data The submitted form data\n" .
            "     * @return bool Returns true on success, false on failure\n" .
            "     */\n" .
            "    public function handle(array \$data): bool\n" .
            "    {\n" .
            "        // Logic for handling form data\n" .
            "        // For example, validate and process the data\n" .

            "        if (\$this->isValid(\$data)) {\n" .
            "            // Save data or perform desired action\n" .
            "            return true;\n" .
            "        }\n" .
            "        return false;\n" .
            "    }\n\n" .

            "    /**\n" .
            "     * Validates the submitted form data\n" .
            "     *\n" .
            "     * @param array \$data The data to validate\n" .
            "     * @return bool Returns true if valid, false otherwise\n" .
            "     */\n" .
            "    private function isValid(array \$data): bool\n" .
            "    {\n" .
            "        // Perform validation logic\n" .
            "        // Example: check if required fields are present\n" .
            "        return isset(\$data['requiredField']) && !empty(\$data['requiredField']);\n" .
            "    }\n\n" .

            "    /**\n" .
            "     * Returns error messages if the data is invalid\n" .
            "     *\n" .
            "     * @return array List of error messages\n" .
            "     */\n" .
            "    public function getErrors(): array\n" .
            "    {\n" .
            "        // Example: return an array of error messages\n" .
            "        return ['Invalid data submitted.'];\n" .
            "    }\n" .

            "}\n";
    }
}
