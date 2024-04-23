<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RemoveSugarModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sugarcrm-modules:remove {name} {prefix=lt}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes sugar module';

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
        $moduleName = $this->argument('name');
        $prefix = $this->argument('prefix');
        $moduleNameWithPrefix = strtolower("{$prefix}_$moduleName");

        $folderName = base_path("../web/modules/{$moduleNameWithPrefix}");

        if ( file_exists($folderName) ) {
            $this->rrmdir($folderName);
        }

        $vardefPath = base_path("../core/general/module/vardefs.php");
        $moduleVardersRaw = file($vardefPath);

        foreach($moduleVardersRaw as $key => $value) {
            if ( strpos($value, "modules/{$moduleNameWithPrefix}/vardefs.php") ) {
                unset($moduleVardersRaw[$key]);
            }
        }

        $moduleVardersRaw = array_values($moduleVardersRaw);

        file_put_contents($vardefPath, implode("", $moduleVardersRaw));

        $this->info("Cleared all files related to `$moduleNameWithPrefix`");
        return true;
    }

    private function rrmdir($dir) { 
        if (is_dir($dir)) { 
          $objects = scandir($dir);
          foreach ($objects as $object) { 
            if ($object != "." && $object != "..") { 
              if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
                $this->rrmdir($dir. DIRECTORY_SEPARATOR .$object);
              else
                unlink($dir. DIRECTORY_SEPARATOR .$object); 
            } 
          }
          rmdir($dir); 
        } 
      }
}
