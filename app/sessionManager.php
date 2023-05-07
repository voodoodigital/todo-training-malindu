<?php

class SessionManager
{

    // Change this to a unique value for your application
    private const SESSION_SECRET = 'my_app_secret';

    /**
     * Start a new session and configure it for secure usage
     */
    public static function startSession()
    {
        session_start();
        self::regenerateSessionId();
        self::setSessionCookieParams();
        self::setSessionSecurityHeaders();
    }

    /**
     * Regenerate the session ID to prevent session fixation attacks
     */
    public static function regenerateSessionId()
    {
        session_regenerate_id(true);
    }

    /**
     * Set the session cookie parameters to enhance security
     */
    public static function setSessionCookieParams()
    {
        $params = session_get_cookie_params();
        session_set_cookie_params(
            $params['lifetime'],
            $params['path'],
            $params['domain'],
            true, // secure flag
            true  // httpOnly flag
        );
    }

    /**
     * Set security headers to prevent cross-site scripting attacks
     */
    public static function setSessionSecurityHeaders()
    {
        header('X-Frame-Options: DENY');
        header('X-XSS-Protection: 1; mode=block');
        header('X-Content-Type-Options: nosniff');
        header('Content-Security-Policy: default-src \'self\';');
    }

    /**
     * Check if the current session is valid and authenticated
     * @return bool True if the session is valid and authenticated, false otherwise
     */
    public static function isSessionValid()
    {
        if (!isset($_SESSION['valid']) || $_SESSION['valid'] !== true) {
            return false;
        }
        if (!isset($_SESSION['fingerprint']) || $_SESSION['fingerprint'] !== self::getSessionFingerprint()) {
            return false;
        }
        if (self::getSessionExpirationTime() < time()) {
            return false;
        }
        return true;
    }

    /**
     * Authenticate the current session by storing the user's ID and setting a flag indicating validity
     * @param int $userId The ID of the authenticated user
     * @param int $sessionDuration The duration of the session in seconds (default 1 hour)
     */
    public static function authenticateSession($userId, $sessionDuration = 3600)
    {
        $_SESSION['userId'] = $userId;
        $_SESSION['valid'] = true;
        $_SESSION['expirationTime'] = time() + $sessionDuration;
        $_SESSION['fingerprint'] = self::getSessionFingerprint();
    }

    /**
     * Destroy the current session and unset all session variables
     */
    public static function destroySession()
    {
        session_unset();
        session_destroy();
    }

    /**
     * Get the fingerprint for the current session, based on various client-side data
     * @return string The session fingerprint
     */
    private static function getSessionFingerprint()
    {
        return sha1(
            $_SERVER['HTTP_USER_AGENT'] .
                $_SERVER['REMOTE_ADDR'] .
                self::SESSION_SECRET
        );
    }

    /**
     * Get the expiration time for the current session
     * @return int The expiration time in seconds since the Unix epoch
     */
    private static function getSessionExpirationTime()
    {
        if (!isset($_SESSION['expirationTime'])) {
            return 0;
        }
        return $_SESSION['expirationTime'];
    }
}
