<?php namespace ProcessWire;

/**
 * WireMail that sends through an SMTP server instead of PHP mail().
 *
 * Settings come from $config->smtp in site/config.php (never commit credentials):
 *   $config->smtp = ['user' => 'name@example.com', 'pass' => 'mailbox password'];
 * Optional keys: host (smtp.gmail.com), port (465), secure (true = implicit TLS),
 * starttls (true = upgrade the connection before authentication), fromName.
 *
 * Message headers/body are rendered by WireMail itself; only the transport differs.
 * ponytail: AUTH LOGIN only (no OAuth); use an OAuth-capable transport when password auth is retired.
 */
class SmtpMail extends WireMail {

    /** @var resource|null */
    protected $smtp = null;

    public function ___send() {
        $s = array_merge(['host' => 'smtp.gmail.com', 'port' => 465, 'secure' => true, 'starttls' => false, 'user' => '', 'pass' => ''], (array) $this->wire()->config->smtp);
        if (!strlen($this->from) && $s['user']) $this->from($s['user']);
        if (!strlen($this->fromName) && !empty($s['fromName'])) $this->fromName($s['fromName']);

        $this->multipartBoundary(true);
        $header = $this->renderMailHeader();
        $body = $this->renderMailBody();
        $subject = $this->encodeSubject($this->subject);
        $host = preg_replace('/:\d+$/', '', $this->wire()->config->httpHost ?: 'localhost');
        $numSent = 0;

        try {
            $this->smtp = @stream_socket_client(($s['secure'] ? 'ssl' : 'tcp') . "://$s[host]:$s[port]", $errno, $errstr, 15);
            if (!$this->smtp) throw new WireException("connect $s[host]:$s[port] failed: $errstr");
            stream_set_timeout($this->smtp, 15);
            $this->expect(220);
            $this->cmd("EHLO $host", 250);
            if ($s['starttls']) {
                $this->cmd('STARTTLS', 220);
                if (!stream_socket_enable_crypto($this->smtp, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
                    throw new WireException('STARTTLS negotiation failed');
                }
                $this->cmd("EHLO $host", 250);
            }
            if ($s['user'] !== '') {
                $this->cmd('AUTH LOGIN', 334);
                $this->cmd(base64_encode($s['user']), 334, 'AUTH user');
                $this->cmd(base64_encode($s['pass']), 235, 'AUTH (password hidden)');
            }
            foreach ($this->to as $to) {
                $toName = $this->mail['toName'][$to] ?? '';
                $this->cmd('MAIL FROM:<' . $this->from . '>', 250, 'MAIL FROM');
                $this->cmd("RCPT TO:<$to>", [250, 251], 'RCPT TO (address hidden)');
                $this->cmd('DATA', 354);
                $data = 'Date: ' . date('r') . "\r\n"
                    . 'Message-ID: <' . bin2hex(random_bytes(12)) . '@' . $host . ">\r\n"
                    . 'To: ' . ($toName ? $this->bundleEmailAndName($to, $toName) : $to) . "\r\n"
                    . "Subject: $subject\r\n$header\r\n\r\n$body";
                $data = preg_replace('/\r?\n/', "\r\n", $data);
                $data = preg_replace('/^\./m', '..', $data); // dot-stuffing (RFC 5321 4.5.2)
                $this->cmd("$data\r\n.", 250, 'message body');
                $numSent++;
            }
            $this->cmd('QUIT', 221);
        } catch (\Throwable $e) {
            $this->wire()->log->error('SmtpMail: ' . $e->getMessage());
        }
        if ($this->smtp) fclose($this->smtp);
        $this->smtp = null;
        return $numSent;
    }

    /** send a line and check the reply code; $label replaces the line in error messages */
    protected function cmd($line, $code, $label = null) {
        fwrite($this->smtp, "$line\r\n");
        return $this->expect($code, $label ?? $line);
    }

    /** read a (multi-line) reply and check its code */
    protected function expect($codes, $after = 'connect') {
        $reply = '';
        while (($l = fgets($this->smtp, 1024)) !== false) {
            $reply .= $l;
            if (!isset($l[3]) || $l[3] !== '-') break;
        }
        if (!in_array((int) substr($reply, 0, 3), (array) $codes, true)) {
            throw new WireException("after $after: " . trim($reply ?: 'no reply'));
        }
        return $reply;
    }
}
