<?php
 
 namespace Atom\Exception;
 
class NotFoundHttpException extends \Exception
{
    /**
     * @param string|null     $message  The internal exception message
     * @param \Throwable|null $previous The previous exception
     * @param int             $code     The internal exception code
     */
    public function __construct( )
    {
        parent::__construct("Not Found Http");
    }
}
