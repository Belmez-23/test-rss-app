<?php

namespace App\Console\Commands;

use App\Console\Handlers\ImportFeedsHandler;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class ImportFeedsCommand extends Command
{
    const DEFAULT_XML = 'https://ria.ru/export/rss2/archive/index.xml';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-feeds {--xml='.self::DEFAULT_XML.'}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get news feeds from RSS';

    protected function getOptions(): array
    {
        return [
            ['xml', null, InputOption::VALUE_OPTIONAL, 'URL to XML content', self::DEFAULT_XML],
        ];
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $xml = $this->option('xml');

        if (! $xml) {
            $this->error('XML not found!');
        }

        $url = parse_url($xml);
        if (! $url) {
            $this->error('Incorrect URL!');
        }

        ImportFeedsHandler::execute($xml);
    }
}
