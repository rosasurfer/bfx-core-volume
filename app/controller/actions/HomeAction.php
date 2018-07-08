<?php
use rosasurfer\ministruts\Action;
use rosasurfer\ministruts\Request;
use rosasurfer\ministruts\Response;


/**
 * HomeAction
 */
class HomeAction extends Action {


    /**
     * {@inheritdoc}
     */
    public function execute(Request $request, Response $response) {
        return 'home';
    }
}
