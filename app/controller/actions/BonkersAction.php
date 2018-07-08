<?php
namespace rosasurfer\bfx\controller\actions;

use rosasurfer\log\Logger;
use rosasurfer\ministruts\Action;
use rosasurfer\ministruts\ActionForward;
use rosasurfer\ministruts\Request;
use rosasurfer\ministruts\Response;
use rosasurfer\config\Config;


/**
 * BonkersAction
 */
class BonkersAction extends Action {


    /**
     * {@inheritdoc}
     */
    public function execute(Request $request, Response $response) {
        // the use of HTTPS is not required
        if (false && !$request->isSecure()) {
            $url = $request->getUrl();
            $url = 'https'.strRight($url, -4);
            return new ActionForward('generic', $url, $redirect=true);
        }
        $config = Config::getDefault();

        // request:  GET https://www.bankersfx.com/Paypal/TFV/index.php?id=TSR&lic={encoded-license}&rn=9&mt4={account}&ec=1
        // response: {account}|{license}|A|{expiration}|mt4tfv|ok
        // response: ERROR: Membership Inactive|no

        $account = $request->getParameter('mt4') ?: '0';
        $license = $config->get('bfx.accounts.'.$account, false);
        if ($license) {
            $expires = date('Ymd', time() + 1*MONTH);
            $reply   = $account.'|'.$license.'|A|'.$expires.'|mt4tfv|ok';
        }
        else {
            $reply = 'ERROR: Unknown account. Please go to http://bfx.rosasurfer.com/ to configure access for your account.|no';
        }

        Logger::log('reply: '.$reply, L_INFO);
        echo $reply;
        return null;
    }
}
