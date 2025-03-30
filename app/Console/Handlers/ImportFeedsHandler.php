<?php

namespace App\Console\Handlers;

use App\Models\Feed;

class ImportFeedsHandler
{
    public static function execute(string $xml): void
    {
        // получаем xml объект по ссылке $xml
        $xml = simplexml_load_file($xml);

        // получаем все элементы в канале
        $items = $xml->channel->item;

        foreach ($items as $item) {
            // проверяем есть ли уже такой фид по ссылке
            $feed = Feed::where('url', $item->link?->__toString())?->first();
            if ($feed) {
                // если есть - пропускаем этот элемент
                continue;
            }

            // создаём новый фид на основе данных в элементе
            try {
                Feed::factory()->create([
                    'title' => $item->title?->__toString(),
                    'url' => $item->link?->__toString(),
                    'pub_at' => new \DateTime($item->pubDate),
                    'image' => $item->enclosure['url']?->__toString()
                ]);
            } catch (\Exception $exception) {
                continue;
            }

        }
    }
}
