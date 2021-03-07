<?php 

use Exception;

function canLoginEmailAccount($imapServer, $email, $password)
{
    try {
        $mbox = imap_open('{'.$imapServer.':993/imap/ssl}INBOX', "$email", "$password");
        if (!$mbox) {
            return false;
        }

        // Close IMAP connection if it was correctly opened
        imap_close($mbox);

        return true;
    } catch (Exception $e) {
        return false;
    }
}