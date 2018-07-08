<?php
use rosasurfer\log\Logger;
use rosasurfer\ministruts\Action;
use rosasurfer\ministruts\ActionForward;
use rosasurfer\ministruts\Request;
use rosasurfer\ministruts\Response;




/**
 * BonkersAction
 */
class BonkersAction extends Action {


    /**
     * {@inheritdoc}
     */
    public function execute(Request $request, Response $response) {
        //if (!$request->isSecure()) {
        //    $url = $request->getUrl();                                    // HTTPS is not required
        //    $url = 'https'.strRight($url, -4);
        //    return new ActionForward('generic', $url, $redirect=true);
        //}

        // GET http://www.bankersfx.com/Paypal/TFV/index.php?id=TSR&lic={encoded-license}&rn=9&mt4={account}&ec=1
        // {account}|{license}|A|{expiration}|mt4tfv|ok

        $account = $request->getParameter('mt4') ?: '0';
        $license = '{license}';
        $expires = '{expiration}';
        $reply   = $account.'|'.$license.'|A|'.$expires.'|mt4tfv|ok';

        Logger::log('reply: '.$reply, L_INFO);
        echo $reply;
        return null;
    }
}
