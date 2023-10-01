<?php namespace App\Libraries\Ghivarra\Vuenized;

/**
 * Vuenized Library
 *
 * Created with love and proud by Ghivarra Senandika Rushdie
 *
 * @package Vuenized Library
 *
 * @var https://github.com/ghivarra
 * @var https://facebook.com/bcvgr
 * @var https://twitter.com/ghivarra
 *
**/

class Vuenized
{
    public static function getAssets(): array
    {
        $assets = [
            'js'  => [],
            'css' => []
        ];

        if ($_ENV['VITE_ENVIRONMENT'] === 'development')
        {
            // build main js url
            $mainJSUrl = "{$_ENV['VITE_ORIGIN']}/{$_ENV['VITE_RESOURCES_DIR']}/main.js";

            // we didn't used ssl verifications so we can use self signed ssl in localhost environment such as laragon etc.
            // make sure you only develop your app in localhost so MITM attack is not an issue
            $mainJS = file_get_contents($mainJSUrl, false, stream_context_create([
                'ssl' => [
                    'verify_peer'      => false,
                    'verify_peer_name' => false
                ]
            ]));

            if (empty($mainJS))
            {
                throw new \Exception('Make sure you run "npm run dev" command on your vue applications or check the environment such as origin, port, and host in your dotenv configuration');
            }

            // push main js url
            array_push($assets['js'], "<script type=\"module\" crossorigin src=\"{$mainJSUrl}\"></script>");

        } elseif ($_ENV['VITE_ENVIRONMENT'] === 'production' || $_ENV['VITE_ENVIRONMENT'] === 'testing') {

            $manifestPath = FCPATH . "{$_ENV['VITE_BUILD_DIR']}/manifest.json";

            if (is_file($manifestPath))
            {
                $manifest = json_encode(file_get_contents($manifestPath));

                foreach ($manifest as $asset):

                    // check file extension, css or js
                    $fileExtension = strrchr($asset->file, '.');

                    if ($fileExtension === '.js')
                    {
                        if ($asset->isEntry)
                        {
                            $assetUrl = base_url("{$_ENV['VITE_BUILD_DIR']}/{$asset->file}");
                            array_push($assets['js'], "<script type=\"module\" crossorigin src=\"{$assetUrl}\"></script>");
                        }

                    } elseif ($fileExtension === '.css') {

                        if ($asset->src === 'src/main.css')
                        {
                            $assetUrl = base_url("{$_ENV['VITE_BUILD_DIR']}/{$asset->file}");
                            array_push($assets['css'], "<link rel=\"stylesheet\" href=\"{$assetUrl}\">");
                        }
                    }

                endforeach;

            } else {

                throw new \Exception('Please run "npm run build" command on your vue applications');
            }
        }

        // return assets
        return $assets;
    }

    //========================================================================================

    public static function render(string $view, string $noscriptMessage = 'You need to enable javascript in your browser to access this page'): string
    {
        $assets = self::getAssets();
        $styles = '';

        // inject css into head
        foreach ($assets['css'] as $styles):

            $styles .= $styles . "\n";

        endforeach;

        $view = str_replace('</head>', $styles . '</head>', $view);

        // inject js into after body
        foreach ($assets['js'] as $scripts):

            $scripts .= $scripts . "\n";

        endforeach;

        $view = str_replace('</body>', $scripts . '</body>', $view);

        // return
        return $view;
    }

    //========================================================================================
}