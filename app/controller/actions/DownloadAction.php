<?php
namespace rosasurfer\bfx\controller\actions;

use rosasurfer\log\Logger;
use rosasurfer\ministruts\Action;
use rosasurfer\ministruts\Request;
use rosasurfer\ministruts\Response;
use rosasurfer\util\PHP;


/**
 * DownloadAction
 */
class DownloadAction extends Action {


    /**
     * {@inheritdoc}
     */
    public function execute(Request $request, Response $response) {
        $config = $this->di()['config'];
        $file   = $request->getParameter('file');

        $files = [
            0 => ['BankersFX Core Volume.ex4', $config['app.dir.root'].'/etc/mql/indicators/BankersFX CVI v1.20.0.ex4'],
            1 => ['BankersFX Lib.ex4',         $config['app.dir.root'].'/etc/mql/libraries/BankersFX Lib.ex4'         ],
        ];
        if (!isSet($files[$file])) {
            $request->setActionError('file', 'error: Unknown file identifier');
            return 'redirect.home';
        }
        list($simpleFilename, $fullFilename) = $files[$file];

        if (is_file($fullFilename)) {
            // prepare download
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.rawUrlDecode(baseName($simpleFilename)).'"');
            header('Content-Length: '.fileSize($fullFilename));

            // make the download non-cacheable
            header('Pragma: private');
            header('Cache-control: private');
            header('Expires: '.gmDate(DATE_RFC2822, time() - 1*YEAR));

            // erase an existing output buffer and work around an IE bug (Content-Disposition is ignored)
            ob_get_level() && ob_end_clean();
            ini_get_bool('zlib.output_compression') && PHP::ini_set('zlib.output_compression', false);

            // close the session to not block following requests
            (session_status()==PHP_SESSION_ACTIVE) && session_write_close();

            // serve the file
            $hFile = fOpen($fullFilename, 'rb');
            fPassThru($hFile);
            fclose($hFile);
            return null;
        }

        Logger::log('File "'.$fullFilename.'" not found', L_ERROR);
        $request->setActionError('file', 'error: The requested file was not found.');
        return 'redirect.home';
    }
}
