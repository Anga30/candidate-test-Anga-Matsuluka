<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BuildSugarModules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sugarcrm-modules:build';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates migrations using vardefs from existing';

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
        
        $supportedTypes = [
            'id' => 'id',
            'string' => 'string',
            'text' => 'text',
            'varchar' => 'string',
            'int' => 'integer',
            'integer' => 'integer',
            'bool' => 'boolean',
            'boolean' => 'boolean'
        ];
        $expectedFieldDefKeys = ['type', 'length', 'default', 'null'];
        sort($expectedFieldDefKeys);

        $migrations = [];
        foreach($moduleVardefs as $moduleName => $varDefs) {
            $moduleMigrationClassName = "Create" . str_replace(" ", "", ucwords(str_replace("_", " ", $moduleName))) . "Table";
            $fields = $varDefs['fields'];

            $migration = "<?php\n\nuse Illuminate\Database\Migrations\Migration;\nuse Illuminate\Database\Schema\Blueprint;\nuse Illuminate\Support\Facades\Schema;\n\n";
            $migration .= "class {$moduleMigrationClassName} extends Migration\n{\n\n    /**\n     * Run the migrations.\n     *\n     * @return void\n     */\n";
            $migration .= "    public function up()\n    {\n";
            $migration .= "        Schema::create('{$moduleName}', function (Blueprint \$table) {\n";

            $fields = array_merge($fields, [
                'name' => ['type'=>'string', 'length' => 255, 'default' => null, 'null' => true],
                'description' => ['type'=>'text', 'length' => 255, 'default' => null, 'null' => true]
            ]);

            foreach( $fields as $fieldName => $fieldDefs ) {
                $fieldDefKeys = array_keys($fieldDefs);
                sort($fieldDefKeys);

                if ( $fieldDefKeys === $expectedFieldDefKeys || $fieldName == "id" || $fieldName == "text" || $fieldName == "integer") {
                    $supportedTypesKeys = array_keys($supportedTypes);

                    if ( $fieldName == "id" ) {
                        $fieldDef = "            \$table->id()";
                    } else {

                        if ( !in_array($fieldDefs['type'], $supportedTypesKeys) ) {
                            $this->error("Build failed!");
                            $this->info("");
                            $this->error("Field `$fieldName` has invalid type");
                            $this->info("");
                            $this->error("Expected one of these: " . implode(",", $supportedTypesKeys) . "\nBut got : {$fieldDefs['type']}");
                            $this->info("");
                            return;
                        }

                        $fieldDef = "            \$table->";
                        if ( $fieldDefs['type'] == 'text' ) {
                            $fieldDef .= "text('{$fieldName}')";
                        } else if ( $fieldDefs['type'] == 'integer' ) {
                            $fieldDef .= "integer('{$fieldName}')";
                        } else {
                            $fieldDef .= $supportedTypes[$fieldDefs['type']] . "('{$fieldName}', {$fieldDefs['length']})";
                        }

                        if ( $fieldDefs['type'] == "boolean" ) {
                            if ( $fieldDefs['default'] === false ) {
                                $fieldDef .= "->default(false)";
                            } else if ( $fieldDefs['default'] === true ) {
                                $fieldDef .= "->default(true)";
                            } else if ( $fieldDefs['default'] === 0 || $fieldDefs['default'] == '0' ) {
                                $fieldDef .= "->default(0)";
                            } else if ( !empty($fieldDefs['default']) ) {
                                $this->info("");
                                $this->error("Invalid default value for field `{$fieldName}` in module `{$moduleName}`");
                                return;
                            }
                        } else if ( !empty($fieldDefs['default']) ) {
                            if ( !is_numeric($fieldDefs['default']) && ($fieldDefs['type'] == "integer" || $fieldDefs['type'] == "int") ) {
                                $this->info("");
                                $this->error("Invalid default value for field `{$fieldName}` in module `{$moduleName}`");
                                return;
                            }
                            $fieldDef .= "->default('{$fieldDefs['default']}')";
                        } 

                        if ( $fieldDefs['null'] === true ) {
                            $fieldDef .= "->nullable()";
                        }
                    }
                    $fieldDef .= ";\n";

                    $migration .= $fieldDef;
                } else {
                    $this->error("Build failed!\nField `$fieldName` is missing some definitions in module `{$moduleName}`\nExpected: " . implode(",", $expectedFieldDefKeys) . "\nBut got : " . implode(",", $fieldDefKeys));
                    return;
                }
            }

            $migration .= "            \$table->timestamps();\n";
            $migration .= "        });\n";
            $migration .= "    }\n\n\n    /**\n     * Reverse the migrations.\n     *\n     * @return void\n     */\n";

            $migration .= "    public function down()\n    {\n";
            $migration .= "        Schema::dropIfExists('{$moduleName}');\n";
            $migration .= "    }\n";
            $migration .= "}";

            $migrations[] = [
                'fileContents' => $migration,
                'filePath' => base_path("/database/migrations/" . date("Y_m_d_His") . "_create_{$moduleName}_table.php")
            ];
        }

        //Reset migration
        $this->call('migrate:reset');
        //Delete migration files
        array_map('unlink', array_filter((array) glob(base_path("/database/migrations/*"))));
        
        foreach( $migrations as $migration) {
            file_put_contents($migration['filePath'], $migration['fileContents']);
        }

        if ( count($migrations) ) {
            $this->info("Generated migrations from module vardefs successfully");
        } else {
            $this->info("Nothing to do here, there aint any modules it seems.");
        }

        return 0;
    }
}
