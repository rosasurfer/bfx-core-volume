<?php
namespace rosasurfer\bfx\controller\actions;

use rosasurfer\log\Logger;
use rosasurfer\ministruts\Action;
use rosasurfer\ministruts\Request;
use rosasurfer\ministruts\Response;

use function rosasurfer\strIsDigits;

use const rosasurfer\L_INFO;
use const rosasurfer\MONTH;


/**
 * CheckLicenseAction
 */
class CheckLicenseAction extends Action {


    /**
     * {@inheritdoc}
     */
    public function execute(Request $request, Response $response) {
        $config = $this->di()['config'];

        // request:  GET /Paypal/TFV/index.php?id=TSR&lic={encoded-license}&rn=9&mt4={account}&ec=1
        // response: {account}|{plain-license}|A|{expiration}|mt4tfv|ok
        //       or: ERROR: {error-msg}|no

        $knownAccount = false;
        $account = $request->getParameter('mt4');

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
