<?php

namespace Jlapp\Swaggervel;

use Config;
use File;
use Illuminate\Console\Command;

class SwaggervelGenerateCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'swaggervel:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan and generate the api docs';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $appDir = base_path().'/'.Config::get('swaggervel.app-dir');
        $docDir = Config::get('swaggervel.doc-dir');

        if (! File::isWritable($docDir)) {
            $this->error('Path '.$docDir.' is not writable.');

            return;
        }

        $filename = $docDir.'/api-docs.json';

        if (File::exists($docDir)) {
            // delete existing documentation
            File::delete($filename);
        }

        $defaultBasePath = Config::get('swaggervel.default-base-path');
        $defaultApiVersion = Config::get('swaggervel.default-api-version');
        $defaultSwaggerVersion = Config::get('swaggervel.default-swagger-version');
        $excludeDirs = Config::get('swaggervel.excludes');

        $swagger = \Swagger\scan($appDir, [
            'exclude' => $excludeDirs,
        ]);

        File::put($filename, $swagger);

        $this->info('Successfully generated api docs.');
    }
}
