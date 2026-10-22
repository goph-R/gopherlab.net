<?php
/**
 * The words the theme says itself, in the language the site is configured for
 *
 * A dpress site serves one language (`translation.default` in `dpress.ini`), and the theme is
 * shared by gopherlab.net and gopherlab.hu - so the few labels the templates print, "Read more",
 * "Attachments", the account links, live here keyed by locale rather than typed into the
 * templates in one language. A locale this file does not know falls back to English, so a
 * third site is a new column here and nothing else.
 *
 * `require_once` it, then `gopherlab_text('read_more')`. A `%s` is filled with `sprintf`.
 */

use Dynart\Micro\Micro;
use Dynart\Micro\TranslationInterface;

if (!function_exists('gopherlab_text')) {
    function gopherlab_text(string $key, string ...$args): string {
        static $strings = [
            'en' => [
                'read_more'         => 'Read more',
                'nothing_published' => 'Nothing published yet.',
                'by_author'         => 'by %s',
                'draft'             => 'draft',
                'attachments'       => 'Attachments',
                'home'              => 'Home',
                'menu'              => 'Menu',
                'profile'           => 'Profile',
                'log_out'           => 'Log out',
                'log_in'            => 'Log in',
                'register'          => 'Register',
                'running_on'        => 'Running on %s',
                'show_under'        => 'Show what is under %s',
                'pages_of_article'  => 'Pages of this article',
                'previous_page'     => '&larr; Previous',
                'next_page'         => 'Next &rarr;',
            ],
            'hu' => [
                'read_more'         => 'Tovább',
                'nothing_published' => 'Még nincs közzétett bejegyzés.',
                'by_author'         => '%s',
                'draft'             => 'piszkozat',
                'attachments'       => 'Mellékletek',
                'home'              => 'Főoldal',
                'menu'              => 'Menü',
                'profile'           => 'Profil',
                'log_out'           => 'Kijelentkezés',
                'log_in'            => 'Bejelentkezés',
                'register'          => 'Regisztráció',
                'running_on'        => '%s hajtja',
                'show_under'        => '%s almenüjének megnyitása',
                'pages_of_article'  => 'A cikk oldalai',
                'previous_page'     => '&larr; Előző',
                'next_page'         => 'Következő &rarr;',
            ],
        ];
        $locale = gopherlab_locale();
        $text = $strings[$locale][$key] ?? $strings['en'][$key] ?? $key;
        return $args === [] ? $text : sprintf($text, ...$args);
    }

    /** The site's locale, for `lang=` as much as for the words: `en` when nothing says otherwise */
    function gopherlab_locale(): string {
        try {
            $locale = Micro::get(TranslationInterface::class)->locale();
        } catch (\Throwable) {
            $locale = '';
        }
        return $locale !== '' ? $locale : 'en';
    }
}
