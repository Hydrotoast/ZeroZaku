<?php

class Comet {
    private static $ORIGIN        = 'http://x.chatforyoursite.com';
    private static $LIMIT         = 1700;
    private static $PUBLISH_KEY   = '';
    private static $SUBSCRIBE_KEY = '';

    function Comet( $publish_key, $subscribe_key ) {
        self::$PUBLISH_KEY   = $publish_key;
        self::$SUBSCRIBE_KEY = $subscribe_key;
    }

    function publish($args) {
        if (!(
            $args['channel'] &&
            $args['message']
        )) {
            echo('Missing Channel or Message');
            return false;
        }

        $channel = self::$SUBSCRIBE_KEY . '/' . $args['channel'];
        $message = json_encode($args['message']);

        if (strlen($message) > self::$LIMIT) {
            echo('Message TOO LONG (' . self::$LIMIT . ' LIMIT)');
            return false;
        }

        $response = $this->_request( self::$ORIGIN . '/comet-publish', array(
            'publish_key' => self::$PUBLISH_KEY,
            'channel'     => $channel,
            'message'     => $message
        ) );

        return $response;
    }

    function subscribe($args) {
        if (!$args['channel']) {
            echo("Missing Channel.\n");
            return false;
        }

        if (!$args['callback']) {
            echo("Missing Callback.\n");
            return false;
        }

        $channel   = self::$SUBSCRIBE_KEY . '/' . $args['channel'];
        $callback  = $args['callback'];
        $timetoken = isset($args['timetoken']) ? $args['timetoken'] : '0';
        $server    = isset($args['server'])    ? $args['server']    : false;
        $continue  = true;

        if (!$server) {
            $resp_for_server = $this->_request(
                self::$ORIGIN . '/comet-subscribe', array(
                    'channel' => $channel
                )
            );

            if (!isset($resp_for_server['server'])) {
                print_r($args);
                echo("Incorrect API Keys *OR* Out of Credits\n");
                return false;
            }

            $server = $resp_for_server['server'];
            $args['server'] = $server;
        }

        try {
            $response = $this->_request( 'http://' . $server . '/', array(
                'channel'   => $channel,
                'timetoken' => $timetoken
            ) );

            if (!isset($response['messages'][0])) {
                unset($args['server']);
                return $this->subscribe($args);
            }

            if ($response['messages'][0] == 'xdr.timeout') {
                $args['timetoken'] = $response['timetoken'];
                return $this->subscribe($args);
            }

            foreach ($response['messages'] as $message) {
                $continue = $continue && $callback($message);
            }

            if ($continue) {
                $args['timetoken'] = $response['timetoken'];
                return $this->subscribe($args);
            }
        }
        catch (Exception $error) {
            unset($args['server']);
            return $this->subscribe($args);
        }

        return true;
    }

    function history($args) {
        if (!$args['channel']) {
            echo('Missing Channel');
            return false;
        }

        $channel = self::$SUBSCRIBE_KEY . '/' . $args['channel'];
        $limit   = +$args['limit'] ? +$args['limit'] : 10;

        $response = $this->_request( self::$ORIGIN . '/comet-history', array(
            'channel' => $channel,
            'limit'   => $limit
        ) );

        return $response['messages'];
    }

    private function _request( $request, $args ) {
        $args['unique'] = time();

        $params = array();
        foreach ($args as $key => $val)
            $params[] = urlencode($key) .'='. urlencode($val);

        $request .= '?' . implode( '&', $params );

        $response = preg_replace(
            '|^[^\(]+\((.+?)\)$|', '$1',
            file_get_contents($request)
        );

        return json_decode( $response, true );
    }
}


?>
