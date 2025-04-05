<?php
declare(strict_types=1);

namespace rosasurfer\bfx\controller\actions;

use rosasurfer\ministruts\config\ConfigInterface as Config;
use rosasurfer\ministruts\log\Logger;
use rosasurfer\ministruts\struts\Action;
use rosasurfer\ministruts\struts\Request;
use rosasurfer\ministruts\struts\Response;

use function rosasurfer\ministruts\strIsDigits;

use const rosasurfer\ministruts\L_INFO;
use const rosasurfer\ministruts\MONTH;


/**
 * CheckLicenseAction
 */
class CheckLicenseAction extends Action {


    /**
     * {@inheritdoc}
     */
    public function execute(Request $request, Response $response) {
        /** @var Config $config */
        $config = $this->di()['config'];

        // request:  GET /Paypal/TFV/index.php?id=TSR&lic={encoded-license}&rn=9&mt4={account}&ec=1
        // response: {account}|{plain-license}|A|{expiration}|mt4tfv|ok
        //       or: ERROR: {error-msg}|no

        $knownAccount = false;
        $input = $request->input();
        $account = $input->get('mt4', '');

        if (strIsDigits($account)) {
            $license = $config->get('bfx.accounts.'.$account, null);
            $knownAccount = !is_null($license);
            $license = $license ?: $config->get('bfx.accounts.default');
            $expires = date('Ymd', time() + 1*MONTH);                       // extend license for 30 days
            $reply = $account.'|'.$license.'|A|'.$expires.'|mt4tfv|ok';
        }
        else {
            $reply = 'ERROR: '.($account=="" ? 'Missing':'Invalid').' account number.|no';
        }
        $knownAccount || Logger::log('reply: '.$reply, L_INFO);             // log requests for unknown accounts

        echo $reply;
        return null;
    }
}
