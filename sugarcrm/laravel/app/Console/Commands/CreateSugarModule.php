<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;

class CreateSugarModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sugarcrm-modules:make {name} {prefix=lt}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates model representation based on sugarcrm modules';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        global $moduleVardefs;

        $moduleName = strtolower($this->argument('name'));
        $prefix = strtolower($this->argument('prefix'));
        $moduleNameWithPrefix = "{$prefix}_$moduleName";
        $folderName = base_path("../web/modules/{$moduleNameWithPrefix}");

        if ( preg_match("/\W/", $moduleName) ) {
            $this->error("Invalid module name. Name must only have word character (equivalent to [^a-zA-Z0-9_])");
            return;
        }
        
        if ( isset($moduleVardefs[$moduleNameWithPrefix]) ) {
            $this->error("Config suggests this module `{$moduleNameWithPrefix}` already exists");
            return;
        }
        
        // Create the folder if it doesn't exist
        if (!file_exists($folderName)) {
            mkdir($folderName, 0755, true);
            mkdir($folderName . "/views", 0755, true);
        } else {
            $this->error("Folder with module name `{$moduleNameWithPrefix}` already exists");
            return;
        }


        $classContent = "<?php \n\n";
        $classContent .= "use App\Models\SugarBean;\n\n";
        $classContent .= "class $moduleNameWithPrefix extends SugarBean {\n\n";
        $classContent .= "    /**\n    * The name of the table this module represents\n    * @var string\n    */\n";
        $classContent .= "    protected \$table = '$moduleNameWithPrefix';\n";
        $classContent .= "}\n";

        $filePath = "$folderName/$moduleNameWithPrefix.php";
        file_put_contents($filePath, $classContent);
        
        $moduleCamelCaseName = ucfirst($moduleName);
        $moduleDetailViewClassName = "{$moduleCamelCaseName}DetailView";
        $moduleEditViewClassName = "{$moduleCamelCaseName}EditView";

        $vardefsContent = "<?php \n\n";
        $vardefsContent .= "//This file was generated for you with lots of love from teamgeek\n\n";
        $vardefsContent .= "\$moduleVardefs['{$moduleNameWithPrefix}'] = [\n\n";
        $vardefsContent .= "    'label' => '{$moduleCamelCaseName}',\n";
        $vardefsContent .= "    'detail_view_class' => '{$moduleDetailViewClassName}',\n";
        $vardefsContent .= "    'edit_view_class' => '{$moduleEditViewClassName}',\n";
        $vardefsContent .= "    'related_modules' => [],\n";
        $vardefsContent .= "    /* Add all the fields for your module/table below */\n";
        $vardefsContent .= "    'fields' => [\n";
        $vardefsContent .= "        /*Any definitions added to the `id` field will be ignored, leave it as an empty array*/\n";
        $vardefsContent .= "        'id' => [],\n";
        $vardefsContent .= "         //Add more fields here\n";
        $vardefsContent .= "    ],\n";
        $vardefsContent .= "    'detail_view_fields' => [\n";
        $vardefsContent .= "        ['name', 'description'],\n";
        $vardefsContent .= "    ],\n";
        $vardefsContent .= "    'edit_view_fields' => [\n";
        $vardefsContent .= "        ['name', 'description'],\n";
        $vardefsContent .= "    ],\n";
        $vardefsContent .= "    'list_view_fields' => ['name', 'description'],\n";
        $vardefsContent .= "];";
        
        $filePath = "$folderName/vardefs.php";
        file_put_contents($filePath, $vardefsContent);
        

        $viewClassContent = "<?php \n\n";
        $viewClassContent .= "use Module\Views\Detail;\n\n";
        $viewClassContent .= "class $moduleDetailViewClassName extends Detail {\n\n";
        $viewClassContent .= "    //\n";
        $viewClassContent .= "}\n";
        
        $filePath = "$folderName/views/view.detail.php";
        file_put_contents($filePath, $viewClassContent);

        $editClassContent = "<?php \n\n";
        $editClassContent .= "use Module\Views\Edit;\n\n";
        $editClassContent .= "class $moduleEditViewClassName extends Edit {\n\n";
        $editClassContent .= "    //\n";
        $editClassContent .= "}\n";
        
        $filePath = "$folderName/views/view.edit.php";
        file_put_contents($filePath, $editClassContent);

        $filePath = base_path("../core/general/module/vardefs.php");
        $moduleVardefsContent = file_get_contents($filePath);
        $moduleVardefsContent .= "\nrequire_once(__DIR__ . '/../../../web/modules/{$moduleNameWithPrefix}/vardefs.php');";
        file_put_contents($filePath, $moduleVardefsContent);

        $this->info("Module '$moduleNameWithPrefix' has been generated and placed in the '$folderName' folder.");

        return $moduleName;
    }
}
