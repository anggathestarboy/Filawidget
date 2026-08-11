<?php

namespace App\Support;

use DOMDocument;
use DOMElement;

class Menu
{
    /**
     * Parse an HTML ordered/unordered list into menu items.
     *
     * @return array<int, array{label: string, url: ?string}>
     */
    public static function fromHtml(?string $html): array
    {
        $items = [];

        if (empty($html)) {
            return $items;
        }

        $dom = new DOMDocument();
        $previous = libxml_use_internal_errors(true);
        $dom->loadHTML('<?xml encoding="UTF-8">'.$html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        foreach ($dom->getElementsByTagName('li') as $li) {
            if (! $li instanceof DOMElement) {
                continue;
            }

            $anchor = $li->getElementsByTagName('a')->item(0);

            $items[] = [
                'label' => $anchor instanceof DOMElement
                    ? trim($anchor->textContent)
                    : trim($li->textContent),
                'url' => $anchor instanceof DOMElement && $anchor->hasAttribute('href')
                    ? $anchor->getAttribute('href')
                    : null,
            ];
        }

        return $items;
    }
}
