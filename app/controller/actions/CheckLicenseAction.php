<?php
namespace rosasurfer\bfx\controller\actions;

use rosasurfer\log\Logger;
use rosasurfer\ministruts\Action;
use rosasurfer\ministruts\ActionForward;
use rosasurfer\ministruts\Request;
use rosasurfer\ministruts\Response;


/**
 * CheckLicenseAction
 */
class CheckLicenseAction extends Action {


    /**
     * {@inheritdoc}
     */
    public function execute(Request $request, Response $response) {
        // HTTPS is optional
        if (false && !$request->isSecure()) {
            $url = $request->getUrl();
            $url = 'https'.strRight($url, -4);
            return new ActionForward('generic', $url, $redirect=true);
        }
        $config = $this->di()['config'];

        // request:  GET /Paypal/TFV/index.php?id=TSR&lic={encoded-license}&rn=9&mt4={account}&ec=1
        // response: {account}|{plain-license}|A|{expiration}|mt4tfv|ok
        //       or: ERROR: {error-msg}|no

        $knownAccount = false;
        $account = $request->getParameter('mt4');

        if (strIsDigits($account)) {
            $knownAccount = ($license = $config->get('bfx.accounts.'.$account, null));
            if (!$license)
                $license = $config->get('bfx.accounts.default');
            $expires = date('Ymd', time() + 1*MONTH);                       // extend license for 30 days
            $reply = $account.'|'.$license.'|A|'.$expires.'|mt4tfv|ok';
        }
        else {
            $reply = 'ERROR: Unknown or missing account number.|no';
        }
        if (!$knownAccount) Logger::log('reply: '.$reply, L_INFO);

        echo $reply;
        return null;
    }
}
