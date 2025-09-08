<?php

namespace App\Helpers;

use Illuminate\Support\HtmlString;
use ParsedownExtra;

class ConverterText
{
    // text tobe convert
    private $in = [
        '#\[details=(.*)\](.*)\[/details\]#Usi',
        '#\[spoiler=(.*)\](.*)\[/spoiler\]#Usi',
    ];

    // converted to
    private $out = [
        '<details><summary class="text-danger">$1</summary>$2</details>',
        '<details><summary><span class="mr-2 btn-outline-primary btn btn-sm">spoiler</span> $1 </summary><p>$2</p></details>',
    ];

    /*
     * convert to html
     */
    public function text($text, $nl2br = true)
    {
        // Check if content is HTML instead of Markdown
        if ($this->isHtml($text)) {
            // For HTML content, sanitize and apply custom parsing
            // to avoid DOM errors in ParsedownExtra
            $sanitized = $this->sanitizeHtml($text);
            $out = $this->parse($sanitized);
            return new HtmlString($out);
        }

        // Process as Markdown using ParsedownExtra
        $markdowned = (new ParsedownExtra)
            ->setMarkupEscaped(false)
            ->setBreaksEnabled($nl2br)
            ->text($text);

        $out = $this->parse($markdowned);

        return new HtmlString($out);
    }

    /*
     * Check if text is HTML rather than Markdown
     */
    private function isHtml($text)
    {
        // Check for common HTML patterns
        if (
            preg_match('/<!DOCTYPE/i', $text)
            || preg_match('/<html.*>/i', $text)
            || preg_match('/<head.*>/i', $text)
            || preg_match('/<script.*>/i', $text)
            || preg_match('/<style.*>/i', $text)
            || preg_match('/<audio.*>/i', $text)
            || preg_match('/<video.*>/i', $text)
        ) {
            return true;
        }

        // Check for basic HTML tags
        $html_tags = ['<p>', '<div>', '<span>', '<h1>', '<h2>', '<h3>', '<h4>', '<h5>', '<h6>', '<table>', '<img', '<br>', '<hr>', '<input', '<form', '<textarea'];
        foreach ($html_tags as $tag) {
            if (strpos($text, $tag) !== false) {
                return true;
            }
        }

        return false;
    }

    /*
     * Sanitize HTML content to remove dangerous elements
     */
    private function sanitizeHtml($html)
    {
        // Remove script and style tags
        $html = preg_replace('/<script[^>]*>.*?<\/script>/is', '', $html);
        $html = preg_replace('/<style[^>]*>.*?<\/style>/is', '', $html);

        // Remove event handlers from tags (onclick, onload, etc.)
        $html = preg_replace('/\s+on\w+="[^"]*"/i', '', $html);
        $html = preg_replace('/\s+on\w+=\'[^\']*\'/i', '', $html);

        // Remove external links to potentially malicious sites
        // Allow only relative URLs and trusted domains
        $html = preg_replace('/href=["\'](https?:\/\/(?!toram-id\.com)[^"\']+)["\']/i', 'href="#" data-blocked="true"', $html);
        $html = preg_replace('/src=["\'](https?:\/\/(?!toram-id\.com)[^"\']+)["\']/i', 'src="#" data-blocked="true"', $html);

        // Remove potentially dangerous meta tags
        $html = preg_replace('/<meta[^>]*>/i', '', $html);

        // Remove audio and video tags (as they can be used for noise/annoyance)
        $html = preg_replace('/<audio[^>]*>.*?<\/audio>/is', '', $html);
        $html = preg_replace('/<video[^>]*>.*?<\/video>/is', '', $html);

        // Remove iframe tags
        $html = preg_replace('/<iframe[^>]*>.*?<\/iframe>/is', '', $html);

        // Remove object, embed, and applet tags
        $html = preg_replace('/<object[^>]*>.*?<\/object>/is', '', $html);
        $html = preg_replace('/<embed[^>]*>/i', '', $html);
        $html = preg_replace('/<applet[^>]*>.*?<\/applet>/is', '', $html);

        return $html;
    }

    private function parse($text)
    {
        $in = count($this->in) - 1;

        for ($i = 0; $i <= $in; $i++) {
            $text = preg_replace($this->in[$i], $this->out[$i], $text);
        }

        return $text;
    }
}
